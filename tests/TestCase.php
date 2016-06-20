<?php

namespace Mvc\Tests;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function callMethod($obj, $name, $args = [])
    {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs(null, $args);
    }

    protected function getPropertyValue($obj, $name)
    {
        $property = new \ReflectionProperty($obj, $name);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}