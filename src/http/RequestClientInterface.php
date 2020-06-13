<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Http;

interface RequestClientInterface
{
  function executeRequest($method, $url, Array $params = []);
}