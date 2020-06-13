<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;

class RequestClient implements RequestClientInterface
{
  protected $guzzleClient;

  public function _construct($baseUri)
  {
    $this->guzzleClient = new Client(
      [
        'base_uri' => $baseUrl
      ]
    );
  }

  public function executeRequest($method, $url, Array $params = [])
  {
    try 
    {
      $response = $this->guzzleClient->{$httpMethod}($url, [
        'json' => $params,
      ]);
    }
    catch(\GuzzleClientException $e)
    {
      //
    }
  }
}