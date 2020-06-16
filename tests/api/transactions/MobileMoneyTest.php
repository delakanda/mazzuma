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
use Delakanda\Mazzuma\Exceptions\MissingRequiredParameterException;

class MobileMoneyTest extends TestCase
{
  private $price;

  private $network;

  private $recipient_number;

  private $sender;

  private $option;

  private $orderID;

  private $token;

  private $config;
  
  /**
  * Setup before tests are run
  * @return void
  **/
  protected function setUp(): void
  {
    $this->price = 250;
    $this->network = "MTN";
    $this->recipient_number = "0244000000";
    $this->sender = "0245000000";
    $this->option = "rmtm";
    $this->orderID = "100229030";
    $this->token = "000002111";

    $apiKey = "xxxxx";
    $this->config = new Config($apiKey);
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
  public function test_that_properties_are_set_by_chaining()
  {
    $mobileMoney = Mazzuma::make($this->config)->mobileMoney()
      ->price($this->price)
      ->network($this->network)
      ->sender($this->sender)
      ->option($this->option)
      ->orderId($this->orderID)
      ->token($this->token)
      ->recipientNumber($this->recipient_number);

    $this->assertEquals($mobileMoney->getPrice(), $this->price);
    $this->assertEquals($mobileMoney->getNetwork(), $this->network);
    $this->assertEquals($mobileMoney->getSender(), $this->sender);
    $this->assertEquals($mobileMoney->getOrderId(), $this->orderID);
    $this->assertEquals($mobileMoney->getToken(), $this->token);
    $this->assertEquals($mobileMoney->getRecipientNumber(), $this->recipient_number);
  }

  /** @test */
  public function test_that_exception_is_thrown_on_bad_method_call()
  {
    $this->expectException(\BadMethodCallException::class);

    $mobileMoney = Mazzuma::make($this->config)->mobileMoney()
      ->foo();
  }
}