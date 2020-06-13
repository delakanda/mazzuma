<?php

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Config;

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
  }

  public static function getEnvVariable($key) 
  {
    // For now, laravel's way of getting env variable
    // TODO - Check for other methods of getting env variables
    return getenv($key);
  }
}