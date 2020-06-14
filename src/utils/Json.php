<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Utils;

class Json
{
  public static function sendResponse($data=null, $statusCode=200, $encode=true)
  {
    http_response_code($statusCode);

    if($encode) return json_encode($data);

    return $data;
  }
}