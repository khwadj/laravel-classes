<?php


namespace Khwadj\Model;

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



    /**
     * Results array of items from Collection or Arrayable.
     *
     * @param mixed $items
     * @return array
     */
    //TODO: see if it's useful to redeclare
    /*
    protected function getArrayableItems($items)
    {
      if ( is_array($items) )
      {
        return $items;
      }
      else return parent::getArrayableItems($items);
    }
    */

}