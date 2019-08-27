<?php

namespace Khwadj\Model;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Khwadj\Model\Builder;
use Khwadj\Model\Collection;
use Khwadj\Helpers\StringHelper;

/**
 * Class Model
 * @package Khwadj\Model
 */
class Model extends BaseModel
{
  use WithLocalCache;

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
   * Create a new Eloquent Collection instance.
   *
   * @param array $models
   * @return \Illuminate\Database\Eloquent\Collection|\Khwadj\Model\Collection
   */
  public function newCollection(array $models = [])
  {
    return new Collection($models);
  }

  /**
   * Create a new Eloquent query builder for the model.
   *
   * @param \Illuminate\Database\Query\Builder $query
   * @return \Khwadj\Model\Builder|\Illuminate\Database\Eloquent\Model
   */
  public function newEloquentBuilder($query)
  {
    return new Builder($query);
  }

  /**
   * Intercept with_khwadj_local_cache calls
   *
   * @param string $method
   * @param array  $args
   * @return mixed
   */
  /*
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

    return FALSE;

    // otherwise just call the real function
    return parent::__call($method, $args);
  }
  */

  /**
   * Intercept with_khwadj_local_cache calls
   *
   * @param string $method
   * @param array  $args
   * @return mixed
   */
  /*
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
  */

}
