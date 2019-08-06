<?php

namespace Khwadj;

use \Illuminate\View\View as IlluminateView;

class View extends IlluminateView
{

  public function gatherData()
  {
    $data = array_merge($this->factory->getShared(), $this->data);

    return $data;
  }

}