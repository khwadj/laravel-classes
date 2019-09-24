<?php

namespace Khwadj\Eloquent;

/**
 * Class Cache
 * @package Khwadj\Eloquent
 *
 * Eloquent Models
 */
class Cache
{
    protected static $_items = [];

    /**
     * @param $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return array_key_exists($key, static::$_items) ? static::$_items[$key] : NULL;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        return static::$_items[$key] = $value;
    }

    /**
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return array_key_exists($key, static::$_items);
    }

    public static function empty()
    {
        self::$_items = [];
    }

    /**
     * @return int
     */
    public static function count()
    {
        return count(self::$_items);
    }
}
