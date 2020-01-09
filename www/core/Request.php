<?php

namespace core;

class Request
{
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getGet($name, $default = null)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }

        return $default;
    }

    public function getPost($name, $default = null)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        return $default;
    }

    public function getHost()
    {
        if (!empty($_SERVER['HTTP_HOST'])) {
            return $_SERVER['HTTP_HOST'];
        }

        return $_SERVER['SERVER_NAME'];
    }

    public function isSsl()
    {
        return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    }

    public function getRequestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }
}
