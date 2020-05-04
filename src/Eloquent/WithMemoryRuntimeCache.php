<?php

namespace Khwadj\Eloquent;

/**
 * Trait WithLocalCacheKey
 * @package Khwadj\Eloquent
 */
trait WithMemoryRuntimeCache
{
    /**
     * Sets an entry for a key
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function cacheSet($key, $value)
    {
        return MemoryRuntimeCache::set($key, $value);
    }

    /**
     * Get the entry for a key if it's present
     *
     * @param $key
     * @return mixed|null
     */
    public static function cacheGet($key)
    {
        return MemoryRuntimeCache::get($key);
    }

    /**
     * Returns whether the given key is present
     *
     * @param $key
     * @return bool
     */
    public static function cacheHasKey($key)
    {
        return MemoryRuntimeCache::has($key);
    }
}
