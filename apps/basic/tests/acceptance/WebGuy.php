<?php
// This class was automatically generated by build task
// You can change it manually, but it will be overwritten on next build
// @codingStandardsIgnoreFile

use Codeception\Maybe;
use Codeception\Module\PhpBrowser;
use Codeception\Module\WebHelper;

/**
 * Inherited methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void amTesting($method)
 * @method void amTestingMethod($method)
 * @method void testMethod($signature)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($role)
*/

class WebGuy extends \Codeception\AbstractGuy
{
    
    /**
     * Submits a form located on page.
     * Specify the form by it's css or xpath selector.
     * Fill the form fields values as array.
     *
     * Skipped fields will be filled by their values from page.
     * You don't need to click the 'Submit' button afterwards.
     * This command itself triggers the request to form's action.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * $I->submitForm('#login', array('login' => 'davert', 'password' => '123456'));
     *
     * ```
     *
     * For sample Sign Up form:
     *
     * ``` html
     * <form action="/sign_up">
     *     Login: <input type="text" name="user[login]" /><br/>
     *     Password: <input type="password" name="user[password]" /><br/>
     *     Do you agree to out terms? <input type="checkbox" name="user[agree]" /><br/>
     *     Select pricing plan <select name="plan"><option value="1">Free</option><option value="2" selected="selected">Paid</option></select>
     *     <input type="submit" value="Submit" />
     * </form>
     * ```
     * I can write this:
     *
     * ``` php
     * <?php
     * $I->submitForm('#userForm', array('user' => array('login' => 'Davert', 'password' => '123456', 'agree' => true)));
     *
     * ```
     * Note, that pricing plan will be set to Paid, as it's selected on page.
     *
     * @param $selector
     * @param $params
     * @see PhpBrowser::submitForm()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function submitForm($selector, $params) {
        $this->scenario->action('submitForm', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * If your page triggers an ajax request, you can perform it manually.
     * This action sends a POST ajax request with specified params.
     * Additional params can be passed as array.
     *
     * Example:
     *
     * Imagine that by clicking checkbox you trigger ajax request which updates user settings.
     * We emulate that click by running this ajax request manually.
     *
     * ``` php
     * <?php
     * $I->sendAjaxPostRequest('/updateSettings', array('notifications' => true); // POST
     * $I->sendAjaxGetRequest('/updateSettings', array('notifications' => true); // GET
     *
     * ```
     *
     * @param $uri
     * @param $params
     * @see PhpBrowser::sendAjaxPostRequest()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function sendAjaxPostRequest($uri, $params = null) {
        $this->scenario->action('sendAjaxPostRequest', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * If your page triggers an ajax request, you can perform it manually.
     * This action sends a GET ajax request with specified params.
     *
     * See ->sendAjaxPostRequest for examples.
     *
     * @param $uri
     * @param $params
     * @see PhpBrowser::sendAjaxGetRequest()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function sendAjaxGetRequest($uri, $params = null) {
        $this->scenario->action('sendAjaxGetRequest', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Asserts that current page has 404 response status code.
     * @see PhpBrowser::seePageNotFound()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seePageNotFound() {
        $this->scenario->assertion('seePageNotFound', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that response code is equal to value provided.
     *
     * @param $code
     * @return mixed
     * @see PhpBrowser::seeResponseCodeIs()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeResponseCodeIs($code) {
        $this->scenario->assertion('seeResponseCodeIs', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Adds HTTP authentication via username/password.
     *
     * @param $username
     * @param $password
     * @see PhpBrowser::amHttpAuthenticated()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function amHttpAuthenticated($username, $password) {
        $this->scenario->condition('amHttpAuthenticated', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Low-level API method.
     * If Codeception commands are not enough, use [Guzzle HTTP Client](http://guzzlephp.org/) methods directly
     *
     * Example:
     *
     * ``` php
     * <?php
     * // from the official Guzzle manual
     * $I->amGoingTo('Sign all requests with OAuth');
     * $I->executeInGuzzle(function (\Guzzle\Http\Client $client) {
     *      $client->addSubscriber(new Guzzle\Plugin\Oauth\OauthPlugin(array(
     *                  'consumer_key'    => '***',
     *                  'consumer_secret' => '***',
     *                  'token'           => '***',
     *                  'token_secret'    => '***'
     *      )));
     * });
     * ?>
     * ```
     *
     * Not recommended this command too be used on regular basis.
     * If Codeception lacks important Guzzle Client methods implement then and submit patches.
     *
     * @param callable $function
     * @see PhpBrowser::executeInGuzzle()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function executeInGuzzle($function) {
        $this->scenario->action('executeInGuzzle', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Opens the page.
     *
     * @param $page
     * @see PhpBrowser::amOnPage()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function amOnPage($page) {
        $this->scenario->condition('amOnPage', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Sets 'url' configuration parameter to hosts subdomain.
     * It does not open a page on subdomain. Use `amOnPage` for that
     *
     * ``` php
     * <?php
     * // If config is: 'http://mysite.com'
     * // or config is: 'http://www.mysite.com'
     * // or config is: 'http://company.mysite.com'
     *
     * $I->amOnSubdomain('user');
     * $I->amOnPage('/');
     * // moves to http://user.mysite.com/
     * ?>
     * ```
     * @param $subdomain
     * @return mixed
     * @see PhpBrowser::amOnSubdomain()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function amOnSubdomain($subdomain) {
        $this->scenario->condition('amOnSubdomain', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Check if current page doesn't contain the text specified.
     * Specify the css selector to match only specific region.
     *
     * Examples:
     *
     * ```php
     * <?php
     * $I->dontSee('Login'); // I can suppose user is already logged in
     * $I->dontSee('Sign Up','h1'); // I can suppose it's not a signup page
     * $I->dontSee('Sign Up','//body/h1'); // with XPath
     * ```
     *
     * @param $text
     * @param null $selector
     * @see PhpBrowser::dontSee()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSee($text, $selector = null) {
        $this->scenario->action('dontSee', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Check if current page contains the text specified.
     * Specify the css selector to match only specific region.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * $I->see('Logout'); // I can suppose user is logged in
     * $I->see('Sign Up','h1'); // I can suppose it's a signup page
     * $I->see('Sign Up','//body/h1'); // with XPath
     *
     * ```
     *
     * @param $text
     * @param null $selector
     * @see PhpBrowser::see()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function see($text, $selector = null) {
        $this->scenario->assertion('see', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks if there is a link with text specified.
     * Specify url to match link with exact this url.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * $I->seeLink('Logout'); // matches <a href="#">Logout</a>
     * $I->seeLink('Logout','/logout'); // matches <a href="/logout">Logout</a>
     *
     * ```
     *
     * @param $text
     * @param null $url
     * @see PhpBrowser::seeLink()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeLink($text, $url = null) {
        $this->scenario->assertion('seeLink', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks if page doesn't contain the link with text specified.
     * Specify url to narrow the results.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * $I->dontSeeLink('Logout'); // I suppose user is not logged in
     *
     * ```
     *
     * @param $text
     * @param null $url
     * @see PhpBrowser::dontSeeLink()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeLink($text, $url = null) {
        $this->scenario->action('dontSeeLink', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Perform a click on link or button.
     * Link or button are found by their names or CSS selector.
     * Submits a form if button is a submit type.
     *
     * If link is an image it's found by alt attribute value of image.
     * If button is image button is found by it's value
     * If link or button can't be found by name they are searched by CSS selector.
     *
     * The second parameter is a context: CSS or XPath locator to narrow the search.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * // simple link
     * $I->click('Logout');
     * // button of form
     * $I->click('Submit');
     * // CSS button
     * $I->click('#form input[type=submit]');
     * // XPath
     * $I->click('//form/*[@type=submit]')
     * // link in context
     * $I->click('Logout', '#nav');
     * ?>
     * ```
     * @param $link
     * @param $context
     * @see PhpBrowser::click()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function click($link, $context = null) {
        $this->scenario->action('click', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks if element exists on a page, matching it by CSS or XPath
     *
     * ``` php
     * <?php
     * $I->seeElement('.error');
     * $I->seeElement(//form/input[1]);
     * ?>
     * ```
     * @param $selector
     * @see PhpBrowser::seeElement()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeElement($selector) {
        $this->scenario->assertion('seeElement', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks if element does not exist (or is visible) on a page, matching it by CSS or XPath
     *
     * ``` php
     * <?php
     * $I->dontSeeElement('.error');
     * $I->dontSeeElement(//form/input[1]);
     * ?>
     * ```
     * @param $selector
     * @see PhpBrowser::dontSeeElement()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeElement($selector) {
        $this->scenario->action('dontSeeElement', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Reloads current page
     * @see PhpBrowser::reloadPage()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function reloadPage() {
        $this->scenario->action('reloadPage', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Moves back in history
     * @see PhpBrowser::moveBack()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function moveBack() {
        $this->scenario->action('moveBack', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Moves forward in history
     * @see PhpBrowser::moveForward()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function moveForward() {
        $this->scenario->action('moveForward', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Fills a text field or textarea with value.
     *
     * @param $field
     * @param $value
     * @see PhpBrowser::fillField()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function fillField($field, $value) {
        $this->scenario->action('fillField', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Selects an option in select tag or in radio button group.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->selectOption('form select[name=account]', 'Premium');
     * $I->selectOption('form input[name=payment]', 'Monthly');
     * $I->selectOption('//form/select[@name=account]', 'Monthly');
     * ?>
     * ```
     *
     * @param $select
     * @param $option
     * @see PhpBrowser::selectOption()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function selectOption($select, $option) {
        $this->scenario->action('selectOption', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Ticks a checkbox.
     * For radio buttons use `selectOption` method.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->checkOption('#agree');
     * ?>
     * ```
     *
     * @param $option
     * @see PhpBrowser::checkOption()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function checkOption($option) {
        $this->scenario->action('checkOption', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Unticks a checkbox.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->uncheckOption('#notify');
     * ?>
     * ```
     *
     * @param $option
     * @see PhpBrowser::uncheckOption()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function uncheckOption($option) {
        $this->scenario->action('uncheckOption', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that current uri contains a value
     *
     * ``` php
     * <?php
     * // to match: /home/dashboard
     * $I->seeInCurrentUrl('home');
     * // to match: /users/1
     * $I->seeInCurrentUrl('/users/');
     * ?>
     * ```
     *
     * @param $uri
     * @see PhpBrowser::seeInCurrentUrl()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeInCurrentUrl($uri) {
        $this->scenario->assertion('seeInCurrentUrl', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that current uri does not contain a value
     *
     * ``` php
     * <?php
     * $I->dontSeeInCurrentUrl('/users/');
     * ?>
     * ```
     *
     * @param $uri
     * @see PhpBrowser::dontSeeInCurrentUrl()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeInCurrentUrl($uri) {
        $this->scenario->action('dontSeeInCurrentUrl', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that current url is equal to value.
     * Unlike `seeInCurrentUrl` performs a strict check.
     *
     * <?php
     * // to match root url
     * $I->seeCurrentUrlEquals('/');
     * ?>
     *
     * @param $uri
     * @see PhpBrowser::seeCurrentUrlEquals()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeCurrentUrlEquals($uri) {
        $this->scenario->assertion('seeCurrentUrlEquals', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that current url is not equal to value.
     * Unlike `dontSeeInCurrentUrl` performs a strict check.
     *
     * <?php
     * // current url is not root
     * $I->dontSeeCurrentUrlEquals('/');
     * ?>
     *
     * @param $uri
     * @see PhpBrowser::dontSeeCurrentUrlEquals()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeCurrentUrlEquals($uri) {
        $this->scenario->action('dontSeeCurrentUrlEquals', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that current url is matches a RegEx value
     *
     * <?php
     * // to match root url
     * $I->seeCurrentUrlMatches('~$/users/(\d+)~');
     * ?>
     *
     * @param $uri
     * @see PhpBrowser::seeCurrentUrlMatches()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeCurrentUrlMatches($uri) {
        $this->scenario->assertion('seeCurrentUrlMatches', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that current url does not match a RegEx value
     *
     * <?php
     * // to match root url
     * $I->dontSeeCurrentUrlMatches('~$/users/(\d+)~');
     * ?>
     *
     * @param $uri
     * @see PhpBrowser::dontSeeCurrentUrlMatches()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeCurrentUrlMatches($uri) {
        $this->scenario->action('dontSeeCurrentUrlMatches', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     *
     * @see PhpBrowser::seeCookie()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeCookie($cookie) {
        $this->scenario->assertion('seeCookie', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     *
     * @see PhpBrowser::dontSeeCookie()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeCookie($cookie) {
        $this->scenario->action('dontSeeCookie', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     *
     * @see PhpBrowser::setCookie()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function setCookie($cookie, $value) {
        $this->scenario->action('setCookie', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     *
     * @see PhpBrowser::resetCookie()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function resetCookie($cookie) {
        $this->scenario->action('resetCookie', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     *
     * @see PhpBrowser::grabCookie()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function grabCookie($cookie) {
        $this->scenario->action('grabCookie', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Takes a parameters from current URI by RegEx.
     * If no url provided returns full URI.
     *
     * ``` php
     * <?php
     * $user_id = $I->grabFromCurrentUrl('~$/user/(\d+)/~');
     * $uri = $I->grabFromCurrentUrl();
     * ?>
     * ```
     *
     * @param null $uri
     * @internal param $url
     * @return mixed
     * @see PhpBrowser::grabFromCurrentUrl()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function grabFromCurrentUrl($uri = null) {
        $this->scenario->action('grabFromCurrentUrl', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Attaches file from Codeception data directory to upload field.
     *
     * Example:
     *
     * ``` php
     * <?php
     * // file is stored in 'tests/data/tests.xls'
     * $I->attachFile('prices.xls');
     * ?>
     * ```
     *
     * @param $field
     * @param $filename
     * @see PhpBrowser::attachFile()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function attachFile($field, $filename) {
        $this->scenario->action('attachFile', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks if option is selected in select field.
     *
     * ``` php
     * <?php
     * $I->seeOptionIsSelected('#form input[name=payment]', 'Visa');
     * ?>
     * ```
     *
     * @param $selector
     * @param $optionText
     * @return mixed
     * @see PhpBrowser::seeOptionIsSelected()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeOptionIsSelected($select, $text) {
        $this->scenario->assertion('seeOptionIsSelected', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks if option is not selected in select field.
     *
     * ``` php
     * <?php
     * $I->dontSeeOptionIsSelected('#form input[name=payment]', 'Visa');
     * ?>
     * ```
     *
     * @param $selector
     * @param $optionText
     * @return mixed
     * @see PhpBrowser::dontSeeOptionIsSelected()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeOptionIsSelected($select, $text) {
        $this->scenario->action('dontSeeOptionIsSelected', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Assert if the specified checkbox is checked.
     * Use css selector or xpath to match.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->seeCheckboxIsChecked('#agree'); // I suppose user agreed to terms
     * $I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user agreed to terms, If there is only one checkbox in form.
     * $I->seeCheckboxIsChecked('//form/input[@type=checkbox and @name=agree]');
     *
     * ```
     *
     * @param $checkbox
     * @see PhpBrowser::seeCheckboxIsChecked()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeCheckboxIsChecked($checkbox) {
        $this->scenario->assertion('seeCheckboxIsChecked', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Assert if the specified checkbox is unchecked.
     * Use css selector or xpath to match.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->dontSeeCheckboxIsChecked('#agree'); // I suppose user didn't agree to terms
     * $I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user didn't check the first checkbox in form.
     *
     * ```
     *
     * @param $checkbox
     * @see PhpBrowser::dontSeeCheckboxIsChecked()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeCheckboxIsChecked($checkbox) {
        $this->scenario->action('dontSeeCheckboxIsChecked', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that an input field or textarea contains value.
     * Field is matched either by label or CSS or Xpath
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->seeInField('Body','Type your comment here');
     * $I->seeInField('form textarea[name=body]','Type your comment here');
     * $I->seeInField('form input[type=hidden]','hidden_value');
     * $I->seeInField('#searchform input','Search');
     * $I->seeInField('//form/*[@name=search]','Search');
     * ?>
     * ```
     *
     * @param $field
     * @param $value
     * @see PhpBrowser::seeInField()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function seeInField($field, $value) {
        $this->scenario->assertion('seeInField', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Checks that an input field or textarea doesn't contain value.
     * Field is matched either by label or CSS or Xpath
     * Example:
     *
     * ``` php
     * <?php
     * $I->dontSeeInField('Body','Type your comment here');
     * $I->dontSeeInField('form textarea[name=body]','Type your comment here');
     * $I->dontSeeInField('form input[type=hidden]','hidden_value');
     * $I->dontSeeInField('#searchform input','Search');
     * $I->dontSeeInField('//form/*[@name=search]','Search');
     * ?>
     * ```
     *
     * @param $field
     * @param $value
     * @see PhpBrowser::dontSeeInField()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function dontSeeInField($field, $value) {
        $this->scenario->action('dontSeeInField', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Finds and returns text contents of element.
     * Element is searched by CSS selector, XPath or matcher by regex.
     *
     * Example:
     *
     * ``` php
     * <?php
     * $heading = $I->grabTextFrom('h1');
     * $heading = $I->grabTextFrom('descendant-or-self::h1');
     * $value = $I->grabTextFrom('~<input value=(.*?)]~sgi');
     * ?>
     * ```
     *
     * @param $cssOrXPathOrRegex
     * @return mixed
     * @see PhpBrowser::grabTextFrom()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function grabTextFrom($cssOrXPathOrRegex) {
        $this->scenario->action('grabTextFrom', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     * Finds and returns field and returns it's value.
     * Searches by field name, then by CSS, then by XPath
     *
     * Example:
     *
     * ``` php
     * <?php
     * $name = $I->grabValueFrom('Name');
     * $name = $I->grabValueFrom('input[name=username]');
     * $name = $I->grabValueFrom('descendant-or-self::form/descendant::input[@name = 'username']');
     * ?>
     * ```
     *
     * @param $field
     * @return mixed
     * @see PhpBrowser::grabValueFrom()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function grabValueFrom($field) {
        $this->scenario->action('grabValueFrom', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }

 
    /**
     *
     * @see PhpBrowser::grabAttribute()
     * @return \Codeception\Maybe
     * ! This method is generated. DO NOT EDIT. !
     * ! Documentation taken from corresponding module !
     */
    public function grabAttribute() {
        $this->scenario->action('grabAttribute', func_get_args());
        if ($this->scenario->running()) {
            $result = $this->scenario->runStep();
            return new Maybe($result);
        }
        return new Maybe();
    }
}

