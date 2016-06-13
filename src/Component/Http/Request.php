<?php

namespace Mvc\Component\Http;

class Request
{
    public $query;
    public $post;
    public $cookies;
    public $files;
    public $server;
    public $content;

    public function __construct($query = [], $post = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        $this->query = $query;
        $this->post = $post;
        $this->cookies = $cookies;
        $this->files = $files;
        $this->server = $server;

        $this->content = $content;
    }

    public static function createFromGlobals()
    {
        return static::create($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    public static function create($query = [], $post = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        return new static($query, $post, $cookies, $files, $server, $content);
    }
}