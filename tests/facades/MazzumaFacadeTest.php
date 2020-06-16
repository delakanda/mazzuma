<?php

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Tests;

use ReflectionClass;
use PHPUnit\Framework\TestCase;

class MazzumaFacadeTest extends TestCase
{
  /** @test */
  public function test_that_it_is_a_facade()
  {
    $illuminateFacadeClass = new ReflectionClass('Illuminate\Support\Facades\Facade');
    $mazzumaFacadeClass = new ReflectionClass('Delakanda\Mazzuma\Facades\Mazzuma');
    $this->assertTrue($mazzumaFacadeClass->isSubclassOf($illuminateFacadeClass));
  }
}