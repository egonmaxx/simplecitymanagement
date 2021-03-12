<?php

namespace Application\Services;

class CommanderService
{
    public static function commander($class, $method, $request)
    {
        $reflectionClass = new \ReflectionClass($class);
        $reflectionMethod = $reflectionClass->getMethod($method);
        $instanceFromReflection = $reflectionClass->newInstanceArgs(array($request));
        return $reflectionMethod->invoke($instanceFromReflection);
    }
}