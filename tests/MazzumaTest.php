<?php

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Tests;

use Mockery;
use Delakanda\Mazzuma\Mazzuma;
use Delakanda\Mazzuma\Config\Config;
use PHPUnit\Framework\TestCase;
use Delakanda\Mazzuma\Exceptions\InvalidConfigurationException;

class MazzumaTest extends TestCase
{
  protected $mazzuma;

  /**
  * Setup before tests are run
  * @return void
  **/
  protected function setUp(): void
  {
    $apiKey = 'xxxxx';
    $config = new Config($apiKey);
    $this->mazzuma = new Mazzuma($config);
  }

  /**
  * Teardown after tests are run
  * @return void
  **/
  protected function tearDown(): void
  {
    Mockery::close();
  }

  /** @test */
  public function test_that_a_new_instance_can_be_created_with_make_method()
  {
    $apiKey = 'xxxxx';
    $config = new Config($apiKey);
    $mazzuma = Mazzuma::make($config);

    $this->assertEquals(get_class($this->mazzuma), get_class($mazzuma));
    $this->assertEquals($this->mazzuma->getConfig(), $mazzuma->getConfig());
  }

  /** @test */
  public function test_that_a_new_instance_can_be_created_with_environment_variable()
  {
    $mazzuma = Mazzuma::make();

    $this->assertEquals($this->mazzuma->getConfig()->getApiKey(), $mazzuma->getConfig()->getApiKey());
  }

  /** @test */
  public function test_that_instance_throws_an_error_with_unknown_method()
  {
    $this->expectException(\BadMethodCallException::class);

    $mazzuma = Mazzuma::make();
    $mazzuma->bar();
  }

  /** @test */
  // public function test_that_a_new_instance_without_config_throws_exception_if_env_var_missing()
  // {
  //   $apiKey = getenv("MAZZUMA_API_KEY");

  //   // force empty environment variable

  //   $this->expectException(InvalidConfigurationException::class);

  //   $mazzuma = Mazzuma::make();
  // }
}