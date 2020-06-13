<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Utils;

/**
 * This class stores more complex information about a parameter value
 **/

class Parameter
{
  public $value;
  public $required;
  
  public function __construct($value, $required = false)
  {
    $this->value = $value;
    $this->required = $required;
  }
}