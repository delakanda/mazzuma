<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use Delakanda\Mazzuma\Utils\Json;

class RequestClient implements RequestClientInterface
{
  protected $guzzleClient;

  public function __construct($baseUri)
  {
    $this->guzzleClient = new Client(
      [
        'base_uri' => $baseUri
      ]
    );
  }

  public function executeRequest($method, $url, Array $params = [])
  {
    try 
    {
      $response = $this->guzzleClient->{$method}($url, [
        'json' => $params,
        'headers' => ['Content-Type' => 'application/json']
      ]);
      return Json::sendResponse($response->getBody()->getContents(), $response->getStatusCode(), false);
    }
    catch(\Exception $e)
    {
      if ($e->hasResponse()) 
      {
        $exception = (string) $e->getResponse()->getBody();
        $exceptionJson = json_decode($exception);
        return Json::sendResponse($exceptionJson, $e->getCode());
      }
      else 
      {
        return Json::sendResponse($e->getMessage(), 503);
      }
    }
  }
}