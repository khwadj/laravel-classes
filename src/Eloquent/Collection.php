<?php


namespace Khwadj\Eloquent;

use Illuminate\Database\Eloquent\Collection as BaseCollection;

/**
 * Class Collection
 * @package Khwadj\Eloquent
 *
 * Basically an Eloquent Collection that indexes its items by key
 */
class Collection extends BaseCollection
{

    /**
     * Add an item to the collection.
     *
     * @param mixed $item
     * @param       $key
     *
     * @return Collection
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

    /**
     * Run a dictionary map over the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
     * @param callable $callback
     *
     * @return Collection
     */
    public function mapToDictionary(callable $callback)
    {
        $dictionary = [];

        foreach ( $this->items as $key => $item ) {
            $pair = $callback($item, $key);

            $key = key($pair);

            $value = reset($pair);

            if ( !isset($dictionary[$key]) ) {
                $dictionary[$key] = [];
            }

            if ( $item_key = $value instanceof Model ? $value->getKey() : NULL ) {
                $dictionary[$key][$item_key] = $value;
            }
            else {
                $dictionary[$key][] = $value;
            }

        }

        return new static($dictionary);
    }

}