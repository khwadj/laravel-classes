<?php

namespace Khwadj\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Khwadj\Eloquent\Builder;
use Khwadj\Eloquent\Collection;
use Khwadj\Eloquent\WithCache;
use Khwadj\Helpers\StringHelper;

/**
 * Class Model
 * @package Khwadj\Eloquent
 *
 * Eloquent Models
 */
class Model extends BaseModel
{
    use WithCache;

    /******************** CACHE *******************/

    /**
     * @return string
     */
    function getLocalCacheKey()
    {
        return static::getStaticLocalCacheKeyForId($this->getKey());
    }

    /**
     * @return string
     */
    static function getStaticLocalCacheKey()
    {
        return static::class;
    }

    /**
     * @param $id
     * @return string
     */
    static function getStaticLocalCacheKeyForId($id)
    {
        return static::getStaticLocalCacheKey().':'.$id;
    }


    /******************** Query Builder ************************* /

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array $models
     * @return \Illuminate\Database\Eloquent\Collection|\Khwadj\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return \Khwadj\Eloquent\Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    /**
     * @param $id
     * @param $key
     * @return Model
     */
    public static function find_and_remember_as($id, $key)
    {
        /** @var Model $result */
        $result = static::find($id);
        static::cacheSet($key, $result);

        return $result;
    }

    /**
     * @param $id
     * @return Model
     */
    public static function find_and_remember($id)
    {
        return static::find_and_remember_as($id, static::getStaticLocalCacheKeyForId($id));
    }

    /**
     * @param $id
     * @return Model|mixed|null
     */
    public static function find_or_recall($id)
    {
        $key = static::getStaticLocalCacheKeyForId($id);
        if (static::cacheHasKey($key)) {
            return static::cacheGet($key);
        }
        else {
            return static::find_and_remember($id);
        }
    }


    /******************** Call interception *******************/
    //TODO: see if useful or not, rewrite, etc

    /**
     * Intercept with__cache calls
     *
     * @param string $method
     * @param array  $args
     * @return mixed
     */
    /*
    function __call($method, $args)
    {
        // Intercept _with_local_cache calls
        if ( StringHelper::endsWith($method, static::$_local_cache_suffix) ) {
            $real_method = substr($method, 0, strpos($method, static::$_local_cache_suffix));
            $key = $this->getLocalCacheKey() . ':' . $real_method . ':';
            foreach ( $args as $arg ) {
                if ( $arg instanceof self ) $key .= '-' . $arg->getLocalCacheKey();
                else $key .= '-' . (string)$arg;
            }
            if ( !array_key_exists($key, static::$_local_cache) ) {
                static::$_local_cache[$key] = $this->$real_method(...$args);
            }

            return static::$_local_cache[$key];
        }

        // otherwise just call the real function
        return parent::__call($method, $args);
    }
    */

    /**
     * Intercept with_khwadj_local_cache calls
     *
     * @param string $method
     * @param array  $args
     * @return mixed
     */
    /*
    static function __callStatic($method, $args)
    {
        // Intercept _with_local_cache calls
        if ( StringHelper::endsWith($method, static::$_local_cache_suffix) ) {
            $real_method = substr($method, 0, strpos($method, static::$_local_cache_suffix));
            $key = static::getStaticLocalCacheKey() . ':' . $real_method . ':';
            foreach ( $args as $arg ) {
                if ( $arg instanceof self ) $key .= '-' . $arg->getLocalCacheKey();
                else $key .= '-' . (string)$arg;
            }
            if ( !array_key_exists($key, static::$_local_cache) ) {
                static::$_local_cache[$key] = static::$real_method(...$args);
            }

            return static::$_local_cache[$key];
        }

        // otherwise just call the real function
        return parent::__callStatic($method, $args);
    }
    */
}
