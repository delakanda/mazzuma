<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma;

use Delakanda\Mazzuma\Config\Config;
use Delakanda\Mazzuma\Config\ConfigInterface;

class Mazzuma
{
  /**
   * Instance of config
   */
  protected $config;

  /**
   * Constructor.
   *
   *  @param  string  $apiKey
   *  @param  string  $apiVersion
   *  @return void
   */
  public function __construct($apiKey = null)
  {
    $this->config = new Config($apiKey);
  }

  /**
   * Create a new Mazzuma instance.
   *
   *  @param string $apiKey
   *  @return Delakanda\Mazzuma\Mazzuma
   */
  public static function make($apiKey = null)
  {
    return new static($apiKey);
  }

  /**
   * Get config instance
   *
   *  @return Delakanda\Mazzuma\Config\ConfigInterface
   */
  public function getConfig()
  {
    return $this->config;
  }

  /**
   * Get config instance
   *  @param  string  $apiKey
   *  @return $this
   */
  public function setConfig(ConfigInterface $config)
  {
    $this->config = $config;
    return $this;
  }

  /**
   * Handle missing methods
   * @param string $method
   * @param array $parameters
   */
  public function __call($method, Array $parameters)
  {
    return $this->getApiInstance($method, ...$parameters);
  }

  /**
   * Gets the class instance for the specified method
   * @param string $method
   * @param array $parameters
   * @throws \BadMethodCallException
   */
  protected function getApiInstance($method, ...$parameters)
  {
    $class = '\\Delakanda\\Mazzuma\\Api\\Transactions\\' . ucwords($method);
    if (class_exists($class)) return (new $class(...$parameters))->setConfig($this->config);
    throw new \BadMethodCallException('The Method [ ' . $method . '] you tried to call does not exist.');
  }
}