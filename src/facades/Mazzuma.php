<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Facades;

use Illuminate\Support\Facades\Facade;

class Mazzuma extends Facade 
{
  protected static function getFacadeAccessor()
  {
    return 'Mazzuma';
  }
}