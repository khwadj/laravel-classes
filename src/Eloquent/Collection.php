<?php


namespace Khwadj\Eloquent;

use Illuminate\Database\Eloquent\Collection as BaseCollection;
use Illuminate\Database\Eloquent\Model;

class Collection extends BaseCollection
{


    /**
     * Add an item to the collection.
     *
     * @param mixed $item
     * @param       $key
     * @return \Khwadj\Collection
     */
    public function add($item, $key = NULL)
    {
        // We try and guess a key
        if ( $key === NULL ) {
            if ( $item instanceof Model ) $key = $item->getKey();
        }

        if ( $key ) $this->items[$key] = $item;
        else $this->items[] = $item;

        return $this;
    }

}