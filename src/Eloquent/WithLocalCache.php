<?php

namespace Khwadj\Eloquent;

/**
 * Trait WithLocalCacheKey
 * @package Khwadj\Eloquent
 */
trait WithLocalCache
{
    use WithLocalCacheKey;

    /** @var array Local cache */
    static protected $_local_cache = [];

    static protected $_local_cache_suffix = '_with_khwadj_local_cache';

    /**
     * @return array
     */
    public static function getLocalCacheContent()
    {
        return static::$_local_cache;
    }

    /**
     * @return string
     */
    public static function getLocalCacheSuffix()
    {
        return static::$_local_cache_suffix;
    }

    /**
     * @param $key
     * @param $value
     */
    public static function cacheSet($key, $value)
    {
        static::$_local_cache[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function cacheGet($key)
    {
        return array_key_exists($key, static::$_local_cache) ? static::$_local_cache[$key] : NULL;
    }

    /**
     * @param $key
     * @return bool
     */
    public static function hasKey($key)
    {
        return array_key_exists($key, static::$_local_cache);
    }
}
