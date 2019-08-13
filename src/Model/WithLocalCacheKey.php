<?php

namespace Khwadj\Model;

/**
 * Trait WithLocalCacheKey
 * @package Khwadj\Model
 */
trait WithLocalCacheKey
{
  /**
   * @return string
   */
  abstract function getLocalCacheKey();

  /**
   * @return string
   */
  abstract static function getStaticLocalCacheKey();
}
