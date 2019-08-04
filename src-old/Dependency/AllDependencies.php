<?php
namespace Yiisoft\CacheOld\DependencyOld;

use Yiisoft\CacheOld\CacheInterface;

/**
 * AllDependencies represents a dependency which is composed of a list of other dependencies.
 *
 * The dependency is reported as changed if all sub-dependencies are changed.
 */
class AllDependencies extends Dependency
{
    /**
     * @var Dependency[]
     */
    private $dependencies;

    /**
     * @param Dependency[] $dependencies list of dependencies that this dependency is composed of.
     * Each array element must be a dependency object.
     */
    public function __construct(array $dependencies = [])
    {
        $this->dependencies = $dependencies;
    }

    public function evaluateDependency(CacheInterface $cache): void
    {
        foreach ($this->dependencies as $dependency) {
            $dependency->evaluateDependency($cache);
        }
    }

    protected function generateDependencyData(CacheInterface $cache)
    {
        return null;
    }

    public function isChanged(CacheInterface $cache): bool
    {
        foreach ($this->dependencies as $dependency) {
            if (!$dependency->isChanged($cache)) {
                return false;
            }
        }

        return true;
    }
}
