<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Api;

interface ApiBaseInterface
{
  /**
   * Returns the API base url.
   *
   * @return string
   */
  function getBaseUrl();

  /**
   * Get HTTP Reguest
   *
   * @param string  $url
   * @param array  $parameters
   * @return array
   */
  public function getRequest($url = null, Array $params = []);

  /**
   * POST HTTP Reguest
   *
   * @param string  $url
   * @param array  $parameters
   * @return array
   */
  public function postRequest($url = null, Array $params = []);

  /**
   * PUT HTTP Reguest
   *
   * @param string  $url
   * @param array  $parameters
   * @return array
   */
  public function putRequest($url = null, Array $params = []);
}