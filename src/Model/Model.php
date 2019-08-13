<?php

namespace Khwadj\Model;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Khwadj\Helper\StringHelper;

/**
 * Class Model
 * @package Khwadj\Model
 */
class Model extends EloquentModel
{
  use WithLocalCacheKey;

  /** @var array Local cache */
  static protected $_local_cache = [];

  static protected $_local_cache_suffix = '_with_local_cache';

  /**
   * @return string
   */
  function getLocalCacheKey()
  {
    return $this->getKey();
  }

  /**
   * @return string
   */
  static function getStaticLocalCacheKey()
  {
    return static::class;
  }

  /**
   * Intercept _with_cache calls
   *
   * @param string $method
   * @param array  $args
   * @return mixed
   */
  function __call($method, $args)
  {
    // Intercept _with_local_cache calls
    if ( self::StringHelper($method, static::$_local_cache_suffix) )
    {
      $real_method = substr($method, 0, strpos($method, static::$_local_cache_suffix));
      $key = $this->getLocalCacheKey() . ':' . $real_method . ':';
      foreach ( $args as $arg )
      {
        if ( $arg instanceof self ) $key .= '-' . $arg->getLocalCacheKey();
        else $key .= '-' . (string)$arg;
      }
      if ( !array_key_exists($key, static::$_local_cache) )
      {
        static::$_local_cache[$key] = $this->$real_method(...$args);
      }

      return static::$_local_cache[$key];
    }

    // otherwise just call the real function
    return parent::__call($method, $args);
  }

  /**
   * Intercept _with_cache calls
   *
   * @param string $method
   * @param array  $args
   * @return mixed
   */
  static function __callStatic($method, $args)
  {
    // Intercept _with_local_cache calls
    if ( StringHelper::endsWith($method, static::$_local_cache_suffix) )
    {
      $real_method = substr($method, 0, strpos($method, static::$_local_cache_suffix));
      $key = static::getStaticLocalCacheKey() . ':' . $real_method . ':';
      foreach ( $args as $arg )
      {
        if ( $arg instanceof self ) $key .= '-' . $arg->getLocalCacheKey();
        else $key .= '-' . (string)$arg;
      }
      if ( !array_key_exists($key, static::$_local_cache) )
      {
        static::$_local_cache[$key] = static::$real_method(...$args);
      }

      return static::$_local_cache[$key];
    }

    // otherwise just call the real function
    return parent::__callStatic($method, $args);
  }

}
