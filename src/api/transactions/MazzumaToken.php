<?php 

/**
 * @package delakanda/mazzuma
 * @author  Delali Kanda <delakanda@gmail.com>
 * @license MIT
 **/

namespace Delakanda\Mazzuma\Api\Transactions;

use Delakanda\Mazzuma\Api\ApiBase;
use Delakanda\Mazzuma\Traits\Validatable;
use Delakanda\Mazzuma\Traits\Assignable;
use Delakanda\Mazzuma\Utils\Parameter;

class MazzumaToken extends ApiBase
{
  use Assignable;
  use Validatable;

  /**
   * The amount to be sent
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  protected $price;

  /**
   * This is the unique username of the recipient of the transaction.
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  protected $recipient;

  /**
   * This is the unique username of the sender of the transaction.
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  protected $sender;

  /**
   * The option for this request should be set_callback_url
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  protected $option;

  /**
   * Your callback URL
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  protected $callback_url;

  /**
   * The account username you wish to validate
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  protected $username;

  /**
   * The hash for the transaction
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  protected $transaction_hash;

  /**
   * List of required Parameters
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  private $requiredParams = [];

  /**
   * List of optional Parameters
   * @var \Delakanda\Mazzuma\Utils\Parameter
   **/
  private $optionalParams = [
    "price","sender","option", "recipient", "callback_url", "username", "transaction_hash"
  ];

  public function __construct()
  {
    parent::__construct();
    $this->setMemberVariables(array_merge($this->requiredParams, $this->optionalParams), $this->requiredParams);
  }

  /**
   * Initiate send mazzuma token transaction
   * @return string JSON with an http status code
   **/
  public function sendToken()
  {
    $this->validateParameters(["price","sender",'recipient']);

    $paymentData = [
      'price' =>  $this->price->value,
      'recipient' => $this->recipient->value,
      'sender' => $this->sender->value,
      'apiKey' => $this->config->getApiKey()
    ];

    $uri = "phase3/mazexchange-api.php";
    $response = $this->postRequest($uri, $paymentData);
    return $response;
  }

  /**
   * Initiate receive mazzuma token transaction
   * @return string JSON with an http status code
   **/
  public function receiveToken()
  {
    $this->validateParameters(['sender','callback_url']);

    $paymentData = [
      'callback_url' =>  $this->callback_url->value,
      'option' => 'set_callback_url',
      'sender' => $this->sender->value,
      'apiKey' => $this->config->getApiKey()
    ];

    $uri = "phase3/mazexchange-api.php";
    $response = $this->postRequest($uri, $paymentData);
    return $response;
  }

  /**
   * Get account balance
   * @return string JSON with an http status code
   **/
  public function getAccountBalance()
  {
    $paymentData = [
      'option' =>  "get_balance",
      'apiKey' => $this->config->getApiKey()
    ];

    $uri = "phase3/mazexchange-api.php";
    $response = $this->postRequest($uri, $paymentData);
    return $response;
  }

  /**
   * Validate account based on supplied username
   * @return string JSON with an http status code
   **/
  public function validateAccount()
  {
    $this->validateParameters(['username']);

    $paymentData = [
      'username' => $this->username->value,
      'option' =>  "validate_account",
      'apiKey' => $this->config->getApiKey()
    ];

    $uri = "phase3/mazexchange-api.php";
    $response = $this->postRequest($uri, $paymentData);
    return $response;
  }

  /**
   * Checking transaction status
   * @return string JSON with an http status code
   **/
  public function checkTransactionStatus()
  {
    $this->validateParameters(['transaction_hash']);

    $uri = "checktransaction.php?hash={$this->transaction_hash->value}";
    $response = $this->getRequest($uri);
    return $response;
  }

  #region Methods that match class properties allows chaining to set value of properties

  public function price(float $amount)
  {
    $this->price = new Parameter($amount, true);
    return $this;
  }

  public function recipient(string $recipient)
  {
    $this->recipient = new Parameter($recipient, true);
    return $this;
  }

  public function sender(string $sender)
  {
    $this->sender = new Parameter($sender, true);
    return $this;
  }

  public function option(string $option)
  {
    $this->option = new Parameter($option, true);
    return $this;
  }
    
  public function callbackUrl(string $callback_url)
  {
    $this->callback_url = new Parameter($callback_url, true);
    return $this;
  }

  public function username(string $username)
  {
    $this->username = new Parameter($username, true);
    return $this;
  }

  public function transactionHash(string $transaction_hash)
  {
    $this->transaction_hash = new Parameter($transaction_hash, true);
    return $this;
  }

  #endregion

  /**
   * Magic method => triggered whenever method that is inaccessible is called on this instance
   * Throws BadMethodCallException.
   * @param string $name Name of invoked method.
   * @param array $args Additional arguments.
   */
  public function __call(string $name, array $args) {
    throw new \BadMethodCallException("Instance method ".__CLASS__."->$name() doesn't exist");
  }

  /**
   * Magic method => triggered whenever method that is inaccessible is called on this instance
   * Throws BadMethodCallException.
   * @param string $name Name of invoked method.
   * @param array $args Additional arguments.
   */
  public static function __callstatic(string $name, array $args) {
    throw new \BadMethodCallException("Static method ".__CLASS__."::$name() doesn't exist");
  }
}