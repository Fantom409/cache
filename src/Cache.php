<?php

namespace Yiisoft\Cache;

use DateInterval;
use DateTime;
use Exception;
use Psr\SimpleCache\InvalidArgumentException;
use Yiisoft\Cache\Dependency\Dependency;
use Yiisoft\Cache\Exception\SetCacheException;

/**
 * Cache provides support for the data caching, including cache key composition and dependencies.
 * The actual data caching is performed via {@see Cache::$handler}, which should be configured
 * to be {@see \Psr\SimpleCache\CacheInterface} instance.
 *
 * A value can be stored in the cache by calling {@see CacheInterface::set()} and be retrieved back
 * later (in the same or different request) by {@see CacheInterface::get()}. In both operations,
 * a key identifying the value is required. An expiration time and/or a {@see Dependency}
 * can also be specified when calling {@see CacheInterface::set()}. If the value expires or the dependency
 * changes at the time of calling {@see CacheInterface::get()}, the cache will return no data.
 *
 * A typical usage pattern of cache is like the following:
 *
 * ```php
 * $key = 'demo';
 * $data = $cache->get($key);
 * if ($data === null) {
 *     // ...generate $data here...
 *     $cache->set($key, $data, $ttl, $dependency);
 * }
 * ```
 *
 * For more details and usage information on Cache, see
 * [PSR-16 specification](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-16-simple-cache.md).
 */
final class Cache implements CacheInterface
{
    /**
     * @var \Psr\SimpleCache\CacheInterface actual cache handler.
     */
    private $handler;

    /**
     * @var string a string prefixed to every cache key so that it is unique globally in the whole cache storage.
     * It is recommended that you set a unique cache key prefix for each application if the same cache
     * storage is being used by different applications.
     */
    private $keyPrefix = '';

    private $keyNormalization = true;

    /**
     * @var int|null default TTL for a cache entry. null meaning infinity, negative or zero results in cache key deletion.
     * This value is used by {@see set()} and {@see setMultiple()}, if the duration is not explicitly given.
     */
    private $defaultTtl;

    /**
     * @param \Psr\SimpleCache\CacheInterface cache handler.
     */
    public function __construct(\Psr\SimpleCache\CacheInterface $handler = null)
    {
        $this->handler = $handler;
    }

    /**
     * Builds a normalized cache key from a given key.
     *
     * If the given key is a string containing alphanumeric characters only and no more than 32 characters,
     * then the key will be returned back as it is. Otherwise, a normalized key is generated by serializing
     * the given key and applying MD5 hashing.
     *
     * @param mixed $key the key to be normalized
     * @return string the generated cache key
     */
    private function normalizeKey($key): string
    {
        if (!$this->keyNormalization) {
            $normalizedKey = $key;
        } elseif (\is_string($key)) {
            $normalizedKey = ctype_alnum($key) && mb_strlen($key, '8bit') <= 32 ? $key : md5($key);
        } else {
            $normalizedKey = $this->keyPrefix . md5(json_encode($key));
        }

        return $this->keyPrefix . $normalizedKey;
    }


    public function get($key, $default = null)
    {
        $key = $this->normalizeKey($key);
        $value = $this->handler->get($key, $default);

        if (\is_array($value) && isset($value[1]) && $value[1] instanceof Dependency) {
            if ($value[1]->isChanged($this)) {
                return $default;
            }
            $value = $value[0];
        }

        return $value;
    }


    public function has($key): bool
    {
        $key = $this->normalizeKey($key);
        return $this->handler->has($key);
    }

    /**
     * Retrieves multiple values from cache with the specified keys.
     * Some caches, such as memcached or apcu, allow retrieving multiple cached values at the same time,
     * which may improve the performance. In case a cache does not support this feature natively,
     * this method will try to simulate it.
     * @param string[] $keys list of string keys identifying the cached values
     * @param mixed $default Default value to return for keys that do not exist.
     * @return iterable list of cached values corresponding to the specified keys. The array
     * is returned in terms of (key, value) pairs.
     * If a value is not cached or expired, the corresponding array value will be false.
     * @throws InvalidArgumentException
     */
    public function getMultiple($keys, $default = null): iterable
    {
        $keyMap = [];
        foreach ($keys as $key) {
            $keyMap[$key] = $this->normalizeKey($key);
        }
        $values = $this->handler->getMultiple(array_values($keyMap), $default);
        $results = [];
        foreach ($keyMap as $key => $newKey) {
            $results[$key] = $default;
            if (array_key_exists($newKey, (array)$values)) {
                $value = $values[$newKey];
                if (\is_array($value) && isset($value[1]) && $value[1] instanceof Dependency) {
                    if ($value[1]->isChanged($this)) {
                        continue;
                    }

                    $value = $value[0];
                }
                $results[$key] = $value;
            }
        }

        return $results;
    }

    /**
     * Stores a value identified by a key into cache.
     * If the cache already contains such a key, the existing value and
     * expiration time will be replaced with the new ones, respectively.
     *
     * @param mixed $key a key identifying the value to be cached. This can be a simple string or
     * a complex data structure consisting of factors representing the key.
     * @param mixed $value the value to be cached
     * @param null|int|\DateInterval $ttl the TTL of this value. If not set, default value is used.
     * @param Dependency $dependency dependency of the cached value. If the dependency changes,
     * the corresponding value in the cache will be invalidated when it is fetched via {@see CacheInterface::get()}.
     * @return bool whether the value is successfully stored into cache
     * @throws InvalidArgumentException
     */
    public function set($key, $value, $ttl = null, Dependency $dependency = null): bool
    {
        $ttl = $this->normalizeTtl($ttl);

        if ($dependency !== null) {
            $dependency->evaluateDependency($this);
            $value = [$value, $dependency];
        }
        $key = $this->normalizeKey($key);

        return $this->handler->set($key, $value, $ttl);
    }

    /**
     * Stores multiple values in cache. Each value contains a value identified by a key.
     * If the cache already contains such a key, the existing value and
     * expiration time will be replaced with the new ones, respectively.
     *
     * @param array $values the values to be cached, as key-value pairs.
     * @param null|int|\DateInterval $ttl the TTL value of this value. If not set, default value is used.
     * @param Dependency $dependency dependency of the cached values. If the dependency changes,
     * the corresponding values in the cache will be invalidated when it is fetched via {@see CacheInterface::get()}.
     * @return bool True on success and false on failure.
     * @throws InvalidArgumentException
     */
    public function setMultiple($values, $ttl = null, Dependency $dependency = null): bool
    {
        $data = $this->prepareDataForSetOrAddMultiple($values, $dependency);
        $ttl = $this->normalizeTtl($ttl);
        return $this->handler->setMultiple($data, $ttl);
    }

    public function deleteMultiple($keys): bool
    {
        $actualKeys = [];
        foreach ($keys as $key) {
            $actualKeys[] = $this->normalizeKey($key);
        }
        return $this->handler->deleteMultiple($actualKeys);
    }

    /**
     * Stores multiple values in cache. Each value contains a value identified by a key.
     * If the cache already contains such a key, the existing value and expiration time will be preserved.
     *
     * @param array $values the values to be cached, as key-value pairs.
     * @param null|int|\DateInterval $ttl the TTL value of this value. If not set, default value is used.
     * @param Dependency $dependency dependency of the cached values. If the dependency changes,
     * the corresponding values in the cache will be invalidated when it is fetched via {@see CacheInterface::get()}.
     * @return bool
     * @throws InvalidArgumentException
     */
    public function addMultiple(array $values, $ttl = null, Dependency $dependency = null): bool
    {
        $data = $this->prepareDataForSetOrAddMultiple($values, $dependency);
        $ttl = $this->normalizeTtl($ttl);
        $existingValues = $this->handler->getMultiple(array_keys($data));
        foreach ($existingValues as $key => $value) {
            if ($value !== null) {
                unset($data[$key]);
            }
        }
        return $this->handler->setMultiple($data, $ttl);
    }

    private function prepareDataForSetOrAddMultiple(iterable $values, ?Dependency $dependency): array
    {
        if ($dependency !== null) {
            $dependency->evaluateDependency($this);
        }

        $data = [];
        foreach ($values as $key => $value) {
            if ($dependency !== null) {
                $value = [$value, $dependency];
            }

            $key = $this->normalizeKey($key);
            $data[$key] = $value;
        }

        return $data;
    }

    /**
     * Stores a value identified by a key into cache if the cache does not contain this key.
     * Nothing will be done if the cache already contains the key.
     * @param mixed $key a key identifying the value to be cached. This can be a simple string or
     * a complex data structure consisting of factors representing the key.
     * @param mixed $value the value to be cached
     * @param null|int|\DateInterval $ttl the TTL value of this value. If not set, default value is used.
     * @param Dependency $dependency dependency of the cached value. If the dependency changes,
     * the corresponding value in the cache will be invalidated when it is fetched via {@see CacheInterface::get()}.
     * @return bool whether the value is successfully stored into cache
     * @throws InvalidArgumentException
     */
    public function add($key, $value, $ttl = null, Dependency $dependency = null): bool
    {
        if ($dependency !== null) {
            $dependency->evaluateDependency($this);
            $value = [$value, $dependency];
        }

        $key = $this->normalizeKey($key);

        if ($this->handler->has($key)) {
            return false;
        }

        $ttl = $this->normalizeTtl($ttl);

        return $this->handler->set($key, $value, $ttl);
    }

    /**
     * Deletes a value with the specified key from cache.
     * @param mixed $key a key identifying the value to be deleted from cache. This can be a simple string or
     * a complex data structure consisting of factors representing the key.
     * @return bool if no error happens during deletion
     * @throws InvalidArgumentException
     */
    public function delete($key): bool
    {
        $key = $this->normalizeKey($key);

        return $this->handler->delete($key);
    }

    /**
     * Deletes all values from cache.
     * Be careful of performing this operation if the cache is shared among multiple applications.
     * @return bool whether the flush operation was successful.
     */
    public function clear(): bool
    {
        return $this->handler->clear();
    }

    /**
     * Method combines both {@see CacheInterface::set()} and {@see CacheInterface::get()} methods to retrieve
     * value identified by a $key, or to store the result of $callable execution if there is no cache available
     * for the $key.
     *
     * Usage example:
     *
     * ```php
     * public function getTopProducts($count = 10) {
     *     $cache = $this->cache;
     *     return $cache->getOrSet(['top-n-products', 'n' => $count], function ($cache) use ($count) {
     *         return $this->getTopNProductsFromDatabase($count);
     *     }, 1000);
     * }
     * ```
     *
     * @param mixed $key a key identifying the value to be cached. This can be a simple string or
     * a complex data structure consisting of factors representing the key.
     * @param callable|\Closure $callable the callable or closure that will be used to generate a value to be cached.
     * In case $callable returns `false`, the value will not be cached.
     * @param null|int|\DateInterval $ttl the TTL value of this value. If not set, default value is used.
     * @param Dependency $dependency dependency of the cached value. If the dependency changes,
     * the corresponding value in the cache will be invalidated when it is fetched via {@see CacheInterface::get()}.
     * @return mixed result of $callable execution
     * @throws SetCacheException
     * @throws InvalidArgumentException
     */
    public function getOrSet($key, callable $callable, $ttl = null, Dependency $dependency = null)
    {
        if (($value = $this->get($key)) !== null) {
            return $value;
        }

        $value = $callable($this);
        $ttl = $this->normalizeTtl($ttl);
        if (!$this->set($key, $value, $ttl, $dependency)) {
            throw new SetCacheException($key, $value, $this);
        }

        return $value;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->handler, $name], $arguments);
    }

    public function enableKeyNormalization(): void
    {
        $this->keyNormalization = true;
    }

    public function disableKeyNormalization(): void
    {
        $this->keyNormalization = false;
    }

    /**
     * @param string $keyPrefix a string prefixed to every cache key so that it is unique globally in the whole cache storage.
     * It is recommended that you set a unique cache key prefix for each application if the same cache
     * storage is being used by different applications.
     */
    public function setKeyPrefix(string $keyPrefix): void
    {
        if ($keyPrefix != '' && !ctype_alnum($keyPrefix)) {
            throw new Exception\InvalidArgumentException('Cache key prefix should be alphanumeric');
        }
        $this->keyPrefix = $keyPrefix;
    }

    /**
     * @return int|null
     */
    public function getDefaultTtl(): ?int
    {
        return $this->defaultTtl;
    }

    /**
     * @param int|DateInterval|null $defaultTtl
     */
    public function setDefaultTtl($defaultTtl): void
    {
        $this->defaultTtl = $this->normalizeTtl($defaultTtl);
    }

    /**
     * Normalizes cache TTL handling `null` value and {@see DateInterval} objects.
     * @param int|DateInterval|null $ttl raw TTL.
     * @return int|null TTL value as UNIX timestamp or null meaning infinity
     */
    protected function normalizeTtl($ttl): ?int
    {
        if ($ttl === null) {
            return $this->defaultTtl;
        }

        if ($ttl instanceof DateInterval) {
            try {
                return (new DateTime('@0'))->add($ttl)->getTimestamp();
            } catch (Exception $e) {
                return $this->defaultTtl;
            }
        }

        return $ttl;
    }
}
