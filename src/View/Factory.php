<?php

namespace Khwadj\View;

use Illuminate\View\Factory as IlluminateFactory;
use Khwadj\View\View;

/**
 * Class Factory
 * @package Khwadj\View
 */
class Factory extends IlluminateFactory
{
    /**
     * Create a new view instance from the given arguments.
     *
     * @param string                                        $view
     * @param string                                        $path
     * @param \Illuminate\Contracts\Support\Arrayable|array $data
     * @return \Illuminate\Contracts\View\View
     */
    protected function viewInstance($view, $path, $data)
    {
        return new View($this, $this->getEngineFromPath($path), $view, $path, $data);
    }
}