<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Api;

use Delakanda\Mazzuma\Config\Config;
use Delakanda\Mazzuma\Config\ConfigInterface;
use Delakanda\Mazzuma\Http\RequestClient;
use Delakanda\Mazzuma\Http\RequestClientInterface;

abstract class ApiBase implements ApiBaseInterface
{
  /**
   * Constructor
   * @param  Delakanda\Mazzuma\Config\ConfigInterface $config
   * @return void
   */

  protected $apiClient;
  protected $config;

  public function __construct(ConfigInterface $config = null)
  {
    $this->config = $config;
    $this->apiClient = $this->getApiClient();
  }

  public function getBaseUrl()
  {
    // return 'https://client.teamcyst.com';
    return "localhost:3030";
  }

  public function setConfig(ConfigInterface $config = null)
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
  public function getRequest($url = null, Array $params = [])
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
  public function postRequest($url = null, Array $params = [])
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
  public function putRequest($url = null, Array $params = [])
  {
    return $this->apiClient->executeRequest('PUT', $url, $params);
  }

  /**
   * Send custom JSON Message
   *
   * @param array  $responseData
   * @param int  $statusCode
   */
  public function customResponse(Array $data = [], int $statusCode)
  {
    return $this->apiClient->customResponse($data, $statusCode);
  }

  /**
   * Get Client to use - in this case RequestClient
   * @return RequestClientInterface
   */
  private function getApiClient()
  {
    return new RequestClient($this->getBaseUrl());
  }
}