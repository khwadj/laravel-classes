<?php

namespace Khwadj\Eloquent;

/**
 * Class Cache
 * @package Khwadj\Eloquent
 *
 * Eloquent Models
 */
class MemoryRuntimeCache
{
    protected static $_items = [];

    /**
     * Gets a key entry if it exists
     *
     * @param $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return array_key_exists($key, static::$_items) ? static::$_items[$key] : NULL;
    }

    /**
     * Set the entry for a key
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        return static::$_items[$key] = $value;
    }

    /**
     * Return whether there's an entry for this key
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return array_key_exists($key, static::$_items);
    }

    public static function empty(): void
    {
        self::$_items = [];
    }

    /**
     * Counts the cache items
     *
     * @return int
     */
    public static function count()
    {
        return count(self::$_items);
    }
}
