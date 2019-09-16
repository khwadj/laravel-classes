<?php

namespace Khwadj\Eloquent;

/**
 * Trait WithLocalCacheKey
 * @package Khwadj\Eloquent
 */
//TODO: allow customizable cache engine, maybe use app's config
trait WithCache
{
    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function cacheSet($key, $value)
    {
        return Cache::set($key, $value);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public static function cacheGet($key)
    {
        return Cache::get($key);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function cacheHasKey($key)
    {
        return Cache::has($key);
    }
}
