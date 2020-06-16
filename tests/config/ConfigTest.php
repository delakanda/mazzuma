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

class ConfigTest extends TestCase
{
  /**
  * Setup before tests are run
  * @return void
  **/
  protected function setUp(): void
  {
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
  public function test_that_api_key_is_set_from_env_var_if_empty_constructor_arguments()
  {
    if(getenv("MAZZUMA_API_KEY"))
    {
      $apiKey = "xxxxx";

      $config = new Config();
      $this->assertEquals($config->getApiKey(), $apiKey);
    }
  }

  /** @test */
  public function test_that_api_key_is_set_from_passing_api_key_in_constructor_arguments()
  {
    $apiKey = "xxxxx";

    $config = new Config($apiKey);
    $this->assertEquals($config->getApiKey(), $apiKey);
  }

  /** @test */
  public function test_that_changing_api_key_works()
  {
    $apiKey = "xxxxx";

    $config = new Config($apiKey);
  
    $newApiKey = "yyyyy";
    $config->setApiKey($newApiKey);

    $this->assertEquals($newApiKey, $config->getApiKey());
  }
}