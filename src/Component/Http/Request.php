<?php

namespace Mvc\Component\Http;

class Request
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_OPTIONS = 'OPTIONS';

    /** @var array */
    public $query;
    /** @var array */
    public $post;
    /** @var array */
    public $cookies;
    /** @var array */
    public $files;
    /** @var array */
    public $server;
    /** @var string */
    public $content;

    public function __construct($query = null, $post = null, $cookies = null, $files = null, $server = null, $content = null)
    {
        $this->query = $query ?: $_GET;
        $this->post = $post ?: $_POST;
        $this->cookies = $cookies ?: $_COOKIE;
        $this->files = $files ?: $_FILES;
        $this->server = $server ?: $_SERVER;

        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return strtoupper($this->server['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
    }
}