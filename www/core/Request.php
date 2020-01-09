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

    public function getBaseUrl()
    {
        $script_name = $_SERVER['SCRIPT_NAME'];
        $request_uri = $this->getRequestUri();

        if (strpos($request_uri, $script_name) === 0) {
            return $script_name;
        } elseif (strpos($request_uri, dirname($script_name)) === 0) {
            return rtrim(dirname($script_name), '/');
        }

        return '';
    }

    public function getPathInfo()
    {
        $base_url = $this->getBaseUrl();
        $request_uri = $this->getRequestUri();

        $pos = strpos($request_uri, '?');
        if ($pos !== false) {
            $request_uri = substr($request_uri, 0, $pos);
        }

        $path_info = substr($request_uri, strlen($base_url));

        return $path_info;
    }
}
