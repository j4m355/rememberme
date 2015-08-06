<?php

namespace Birke\Rememberme\Cookie;

/**
 * Wrapper around setcookie function and $_COOKIE global variable
 */
class PHPCookie implements CookieInterface
{

    /**
     * Name of the cookie
     * @var string
     */
    protected $name = "PHP_REMEMBERME";

    /**
     * Number of seconds in the future the cookie and storage will expire (defaults to 1 week)
     * @var int
     */
    protected $expireTime = 604800;

    /**
     * Path where the cookie is valid
     * @var string
     */
    protected $path = "";

    /**
     * Cookie domain
     * @var string
     */
    protected $domain = "";

    /**
     * @var bool
     */
    protected $secure = false;

    /**
     * @var bool
     */
    protected $httpOnly = true;

    function __construct($name="PHP_REMEMBERME", $expireTime=604800, $path="", $domain="", $secure=false, $httpOnly=true)
    {
        $this->name = $name;
        $this->expireTime = $expireTime;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function setValue($value)
    {
        $expire = time() + $this->expireTime;
        $_COOKIE[$this->name] = $value;
        return setcookie($this->name, $value, $expire, $this->path, $this->domain, $this->secure, $this->httpOnly);
    }

    public function getValue(){
        return isset($_COOKIE[$this->name]) ? $_COOKIE[$this->name] : "";
    }

    public function deleteCookie(){
        $expire = time() - $this->expireTime;
        unset($_COOKIE[$this->name]);
        return setcookie($this->name, "", $expire, $this->path, $this->domain, $this->secure, $this->httpOnly);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime($expireTime)
    {
        $this->expireTime = $expireTime;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return bool
     */
    public function getSecure()
    {
        return $this->secure;
    }

    /**
     * @param $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }

    /**
     * @return bool
     */
    public function getHttpOnly()
    {
        return $this->httpOnly;
    }

    /**
     * @param $httponly
     */
    public function setHttpOnly($httponly)
    {
        $this->httpOnly = $httponly;
    }
}
