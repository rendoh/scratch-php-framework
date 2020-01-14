<?php

namespace core;

class Session
{
    const AUTHENTICATED_KEY = '_authenticated';

    protected static $sessionStarted = false;
    protected static $sessionIdRegenerated = false;

    public function __construct()
    {
        if (!self::$sessionStarted) {
            session_start();
            self::$sessionStarted = true;
        }
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get($name, $default = null)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }

        return $default;
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }

    public function clear()
    {
        $_SESSION = [];
    }

    public function regenerate($destroy = true)
    {
        if (!self::$sessionIdRegenerated) {
            session_regenerate_id();
            self::$sessionIdRegenerated = true;
        }
    }

    public function setAuthenticated($bool)
    {
        $this->set(self::AUTHENTICATED_KEY, (bool) $bool);
        $this->regenerate();
    }

    public function isAuthenticated()
    {
        return $this->get(self::AUTHENTICATED_KEY);
    }
}
