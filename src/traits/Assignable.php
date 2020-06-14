<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Traits;

use Delakanda\Mazzuma\Utils\Parameter;
use Delakanda\Mazzuma\Exceptions\MissingRequiredParameterException;

trait Assignable
{
  private function setMemberVariables($allParams, $requiredParameters)
  {
    foreach($allParams as $key => $param)
    {
      $isRequired = in_array($param, $requiredParameters);
      $this->{$param} = new Parameter(null, $isRequired);
    }
  }
}