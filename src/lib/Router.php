<?php

namespace Rzhanau\Main;

class Router
{
    protected static string $className = "";

    public static function GetController(string $action): Controller
    {
        $className = "Rzhanau\\Main\\Controllers\\$action";

        if (!class_exists($className) || !is_subclass_of($className, Controller::class)) {
            throw new \UnexpectedValueException('Action value Unexpected');
        }

        self::$className = $className;

        return new $className();
    }

    public static function getLastClassName(): string
    {
        return self::$className;
    }
}