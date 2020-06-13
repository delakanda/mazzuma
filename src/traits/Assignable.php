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
  private function assignToMembers($dataToAssign = [], $requiredParams = [])
  {
    $properties = [];
    $dataToAssignArr = [];
    foreach(get_object_vars($this) as $key => $var)
    {
      $properties[] = $key;
    }

    foreach($dataToAssign as $key => $var)
    {
      $dataToAssignArr[] = $key;
    }

    foreach($properties as $prop)
    {
      if(!in_array($prop, $dataToAssignArr) && in_array($prop, $requiredParams)) 
      {
        throw new MissingRequiredParameterException("The required parameter '$prop' is missing from ". get_class($this) . " instantiation");
      }
    }

    foreach($dataToAssign as $key => $data)
    {
      if(in_array($key, $properties)) 
      {
        $this->{$key} = new Parameter(trim($data), in_array($data, $requiredParams));
      }
    }
  }
}