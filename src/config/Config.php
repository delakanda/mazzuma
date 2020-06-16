<?php

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Config;

use Delakanda\Mazzuma\Exceptions\InvalidConfigurationException;

class Config implements ConfigInterface
{
  /**
   * The Mazzuma API key.
   *
   * @var string
   */
  protected $apiKey;

  /**
    * Constructor
    * @param  string  Mazzuma API Key
    */
  public function __construct($apiKey = null)
  {
    $this->setApiKey($apiKey ? $apiKey : self::getEnvVariable('MAZZUMA_API_KEY', ''));

    $configValidity = $this->isConfigValid();
    if(!$configValidity['valid'])
    {
      throw new InvalidConfigurationException("Configuration is missing : {$configValidity['missing_env']} in your .env or {$configValidity['missing_param']} parameter");
    }
  }

  public static function getEnvVariable($key) 
  {
    // For now, laravel's way of getting env variable
    // TODO - Check for other methods of getting env variables
    return getenv($key);
  }

  /**
   * Return Mazzuma api key
   *
   * @return string
   */
  public function getApiKey()
  {
    return $this->apiKey;
  }

  /**
   * Sets the Mazzuma API key.
   *
   * @param  string  $apiKey
   */
  public function setApiKey($apiKey)
  {
    $this->apiKey = $apiKey;
    return $this;
  }

  private function isConfigValid()
  {
    if(!$this->apiKey) return ['valid' => false, 'missing_param' => 'apiKey', 'missing_env' => 'MAZZUMA_API_KEY'];
    return [
      'valid' => true
    ];
  }
}