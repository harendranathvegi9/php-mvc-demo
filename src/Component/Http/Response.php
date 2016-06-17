<?php

namespace Mvc\Component\Http;

class Response
{
    protected $content;
    protected $statusCode;

    public function __construct($content = '', $statusCode = 200)
    {
        $this->setContent($content);
        $this->setStatusCode($statusCode);
    }

    public function send()
    {
        http_response_code($this->statusCode);
        echo $this->content;
    }

    public function setContent($content)
    {
        $this->content = (string)$content;
        return $this;
    }

    public function setStatusCode($code)
    {
        $this->statusCode = (int)$code;
        return $this;
    }
}