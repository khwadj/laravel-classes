<?php

namespace Khwadj\View;

use \Illuminate\View\View as IlluminateView;

/**
 * Class View
 * @package Khwadj\View
 */
class View extends IlluminateView
{

  /**
   * Get the data bound to the view instance.
   *
   * Pro : Improvement from parent class: Avoid parsing data as Renderable
   * Con : prohibits sending Renderable data
   *
   * @return array
   */
  public function gatherData()
  {
    $data = array_merge($this->factory->getShared(), $this->data);

    return $data;
  }

}