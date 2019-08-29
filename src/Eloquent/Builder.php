<?php

namespace Khwadj\Eloquent;

use Illuminate\Database\Query\Builder as BaseBuilder;

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
}