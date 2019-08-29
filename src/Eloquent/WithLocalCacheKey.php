<?php

namespace Khwadj\Eloquent;

/**
 * Trait WithLocalCacheKey
 * @package Khwadj\Model
 */
trait WithLocalCacheKey
{
    /**
     * @return string
     */
    abstract public function getLocalCacheKey();

    /**
     * @return string
     */
    abstract public static function getStaticLocalCacheKey();
}
