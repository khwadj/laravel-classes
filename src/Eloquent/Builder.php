<?php

namespace Khwadj\Eloquent;

use Illuminate\Database\Eloquent\Builder as BaseBuilder;

/**
 * Class Builder
 * @package Khwadj\Eloquent
 *
 * Overrides Eloquent Builder to allow Eloquent Request to Provide key indexed collections as results
 */
class Builder extends BaseBuilder
{
    /**
     * Create a collection of models from plain arrays.
     *
     * @param array $items
     *
     * @return Collection
     */
    public function hydrate(array $items)
    {
        $instance = $this->newModelInstance();

        // try and get an id
        $indexed = [];
        foreach ( $items as $item ) {
            /** @var Model $i */
            $i = $instance->newFromBuilder($item);
            $indexed[$i->getKey()] = $i;
        }

        return $instance->newCollection($indexed);
    }

    /**
     * @param       $key
     * @param array $columns
     *
     * @return Collection
     */
    public function get_and_remember_as($key, $columns = ['*'])
    {
        $result = $this->get($columns);
        MemoryRuntimeCache::set($key, $result);

        return $result;
    }

    /**
     * @param       $key
     * @param array $columns
     *
     * @return Model|Builder|Collection|null
     */
    public function first_and_remember_as($key, $columns = ['*'])
    {
        $result = $this->first($columns);
        MemoryRuntimeCache::set($key, $result);

        return $result;
    }

    /**
     * @param array $columns
     *
     * @return Model|Builder|Collection|null
     */
    public function first_and_remember($columns = ['*'])
    {
        if ( $result = $this->first($columns) ) {
            $id = $result->getKey();
            $key = forward_static_call_array([get_class($result), 'getStaticLocalCacheKeyForId'], [$id]);
            MemoryRuntimeCache::set($key, $result);
        }

        return $result;
    }
}