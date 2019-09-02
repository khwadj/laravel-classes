<?php

namespace Khwadj\Eloquent;

use Illuminate\Database\Eloquent\Builder as BaseBuilder;
use Khwadj\Eloquent\Collection;

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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function hydrate(array $items)
    {
        $instance = $this->newModelInstance();

        // try and get an id
        $indexed = [];
        foreach ( $items as $item ) {
            /** @var \Khwadj\Eloquent\Model $i */
            $i = $instance->newFromBuilder($item);
            $indexed[$i->getKey()] = $i;
        }

        return $instance->newCollection($indexed);
    }

    /**
     * @param       $key
     * @param array $columns
     * @return Khwadj\Eloquent\Collection
     */
    public function get_and_remember_as($key, $columns = ['*'])
    {
        $result = $this->get($columns);
        Cache::set($key, $result);

        return $result;
    }
}