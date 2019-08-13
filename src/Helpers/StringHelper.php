<?php

namespace Khwadj\Helper;

class StringHelper
{
  /**
   * @param $haystack
   * @param $needle
   * @return bool
   */
  static function endsWith($haystack, $needle)
  {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
  }
}