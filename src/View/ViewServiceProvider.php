<?php

namespace Khwadj\View;

use Illuminate\View\ViewServiceProvider as IlluminateViewServiceProvider;

/**
 * Class ViewServiceProvider
 * @package Khwadj\View
 */
class ViewServiceProvider extends IlluminateViewServiceProvider
{
    /**
     * Create a new Factory Instance.
     *
     * @param \Illuminate\View\Engines\EngineResolver $resolver
     * @param \Illuminate\View\ViewFinderInterface    $finder
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     * @return \Khwadj\View\Factory
     */
    protected function createFactory($resolver, $finder, $events)
    {
        return new Factory($resolver, $finder, $events);
    }
}
