<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma;

use Delakanda\Mazzuma\Config\Config;
use Delakanda\Mazzuma\Config\ConfigInterface;
use Delakanda\Mazzuma\Exceptions\InvalidConfigurationException;

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
  public function __construct(ConfigInterface $config = null)
  {
    if($config) $this->config = $config;
    else $this->config = new Config();
  }

  /**
   * Create a new Mazzuma instance.
   *
   *  @param string $apiKey
   *  @return Delakanda\Mazzuma\Mazzuma
   */
  public static function make(ConfigInterface $config = null)
  {
    return new static($config);
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
    // Check to ensure config is set
    if(!$this->config) 
    {
      throw new InvalidConfigurationException("No configuration found, please add the appropriate values to your .env file or pass a config instance to the 'make' method");
    }

    $class = '\\Delakanda\\Mazzuma\\Api\\Transactions\\' . ucwords($method);
    if (class_exists($class)) return (new $class(...$parameters))->setConfig($this->config);
    throw new \BadMethodCallException('The Method [ ' . $method . '] you tried to call does not exist.');
  }
}