<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Traits;

use Delakanda\Mazzuma\Utils\Parameter;
use Delakanda\Mazzuma\Exceptions\MissingRequiredParameterException;

trait Validatable
{
  private function validateParameters()
  {
    $properties = [];
    $dataToAssignArr = [];
    foreach(get_object_vars($this) as $key => $var)
    {
      if(gettype($var) === "object")
      {
        $classPath = explode('\\', get_class($var));
        $className = array_pop($classPath);
        
        if($className === "Parameter") 
        {
          $properties[] = [
            'prop_name' => $key,
            'prop_details' => $var
          ];
        }
      }
    }

    foreach($properties as $prop)
    {
      if($prop['prop_details']->required && !$prop['prop_details']->value) 
      {
        throw new MissingRequiredParameterException("The required parameter '".$prop['prop_name']."' is missing");
      }
    }
  }
}