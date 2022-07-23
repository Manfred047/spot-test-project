<?php
/**
 * @copyright 2018 Manfred047
 * @author Emanuel Chablé Concepción <manfred@manfred047.com>
 * @version 1.0.0
 * @website: https://manfred047.com
 * @github https://github.com/Manfred047
 */

namespace App\Utils;

class Utils
{
    use PureTrait;

    protected static ?Utils $_instance = null;

    /**
     * Prevent direct object creation
     */
    final private function  __construct() { }

    /**
     * Prevent object cloning
     */
    private function  __clone() { }

    /**
     * Returns new or existing Singleton instance
     * @return Utils|null
     */
    final public static function getInstance(): ?Utils
    {
        if (null !== static::$_instance) {
            return static::$_instance;
        }
        static::$_instance = new static();
        return static::$_instance;
    }

    public static function hasDebug()
    {
        return env('APP_DEBUG', false);
    }
}
