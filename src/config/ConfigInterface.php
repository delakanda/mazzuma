<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Config;

interface ConfigInterface
{
  /**
   * Return Mazzuma api key
   *
   * @return string
   */
  public function getApiKey();

  /**
   * Sets the Mazzuma API key.
   *
   * @param  string  $apiKey
   */
  public function setApiKey($apiKey);
}