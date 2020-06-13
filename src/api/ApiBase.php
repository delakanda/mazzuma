<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Api;

use Delakanda\Mazzuma\Http\RequestClient;
use Delakanda\Mazzuma\Config\Config;
use Delakanda\Mazzuma\Config\ConfigInterface;

abstract class ApiBase implements ApiBaseInterface
{
  /**
   * Constructor
   * @param  Delakanda\Mazzuma\Config\ConfigInterface $config
   * @return void
   */

  protected $apiClient;
  protected $config;

  public function __construct(ConfigInterface $config)
  {
    $this->config = $config;
    $this->apiClient = getApiClient();
  }

  public function getBaseUrl()
  {
    return 'https://client.teamcyst.com';
  }

  public function setConfig(ConfigInterface $config)
  {
    $this->config = $config;
    return $this;
  }

  /**
   * Get HTTP Reguest
   *
   * @param string  $url
   * @param array  $parameters
   * @return array
   */
  public function getHttp($url = null, Array $params = [])
  {
    return $this->apiClient->executeRequest('GET', $url, $params);
  }

  /**
   * POST HTTP Reguest
   *
   * @param string  $url
   * @param array  $parameters
   * @return array
   */
  public function postHttp($url = null, Array $params = [])
  {
    return $this->apiClient->executeRequest('POST', $url, $params);
  }

  /**
   * PUT HTTP Reguest
   *
   * @param string  $url
   * @param array  $parameters
   * @return array
   */
  public function putHttp($url = null, Array $params = [])
  {
    return $this->apiClient->executeRequest('PUT', $url, $params);
  }

  /**
   * Get Client to use - in this case RequestClient
   * @return RequestClient
   */
  public function getApiClient()
  {
    return new RequestClient(getBaseUrl());
  }
}