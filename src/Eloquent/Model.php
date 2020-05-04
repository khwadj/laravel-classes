<?php

namespace Khwadj\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Model
 * @package Khwadj\Eloquent
 *
 * Eloquent Models
 */
class Model extends BaseModel
{
    use WithMemoryRuntimeCache;

    /******************** Query Builder ************************* /
     *
     * /**
     * Create a new Eloquent Collection instance.
     *
     * @param array $models
     *
     * @return \Khwadj\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Khwadj\Eloquent\Builder
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

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
     *
     * @return string
     */
    static function getStaticLocalCacheKeyForId($id)
    {
        return static::getStaticLocalCacheKey().':'. $id;
    }

    /**
     * Find a model by its PK and remember it with a custom key
     *
     * @param $id
     * @param $key
     *
     * @return \Khwadj\Eloquent\Model|null
     */
    public static function find_and_remember_as($id, $key)
    {
        /** @var Model $result */
        $result = static::find($id);
        static::cacheSet($key, $result);

        return $result;
    }

    /**
     * Find a model by its PK and remember it by its unique key
     *
     * @param $id
     *
     * @return \Khwadj\Eloquent\Model|null
     */
    public static function find_and_remember($id)
    {
        return static::find_and_remember_as($id, static::getStaticLocalCacheKeyForId($id));
    }

    /**
     * Attemps to recall a model by its PK if it has been retrieved earlier
     *
     * @param $id
     *
     * @return \Khwadj\Eloquent\Model|mixed|null
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
