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
}
