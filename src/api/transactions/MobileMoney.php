<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Api\Transactions;

use Delakanda\Mazzuma\Api\ApiBase;
use Delakanda\Mazzuma\Traits\Assignable;

/**
 * This class Manages Mazzuma mobile money operations
 **/

class MobileMoney extends ApiBase
{
  use Assignable;

  protected $price;
  protected $network;
  protected $recipient_number;
  protected $sender;
  protected $option;
  protected $orderID;
  protected $token;

  private $requiredParams = [
    'price',
    'network',
    'recipient_number',
    'sender',
    'option'
  ];

  public function __construct($data=[])
  {
    $this->assignToMembers($data, $this->requiredParams);
  }

  public function initiatePayment()
  {
    $paymentData = [
      'price' =>  $this->price->value,
      'network' => $this->network->value,
      'recipient_number' => $this->recipient_number->value,
      'sender' => $this->sender->value,
      'option' => $this->option->value,
      'option' => $this->option->value,
      'apiKey' => $this->config->getApiKey(),
      'orderID' => $this->orderID ? $this->orderID->value : null,
      'token' => $this->token->value
    ];

    dD($paymentData);
  }
}