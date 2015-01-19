<?php

namespace Omnipay\Swipehq\Message;

use Omnipay\Common\Message\AbstractRequest;
use GuzzleHttp\Client;

/**
 * PaymentPage Authorize Request (step 1 - from Authorize method)
 */

class PaymentPageAuthorizeRequest extends AbstractRequest {

    protected $endpoint = 'https://api.swipehq.com/createTransactionIdentifier.php';

    // Merchant ID
    public function getMerchantId(){
        return $this->getParameter('merchant_id');
    }

    public function setMerchantId($value){
        return $this->setParameter('merchant_id', $value);
    }

    // API Key
    public function getApiKey(){
        return $this->getParameter('api_key');
    }

    public function setApiKey($value){
        return $this->setParameter('api_key', $value);
    }

    public function getDescription(){
        return $this->getParameter('description');
    }

    public function setDescription($value){
        return $this->setParameter('description', $value);
    }

    public function getTransactionId(){
        return $this->getParameter('transactionId');
    }

    public function setTransactionId($value){
        return $this->setParameter('transactionId', $value);
    }

    public function getTransactionReference(){
        return $this->getParameter('transactionReference');
    }

    public function setTransactionReference($value){
        return $this->setParameter('transactionReference', $value);
    }


    public function getData(){

        $data = array();

        $this->validate('amount', 'returnUrl', 'notifyUrl');

        //var_dump(get_class_methods($this));
        //var_dump($this->getResponse());
        //die();

        // for connecting to the API
        $data['api_key'] = $this->getApiKey();
        $data['merchant_id'] = $this->getMerchantId();

        // returning to the website
        $data['td_callback_url'] = $this->getReturnUrl();

        // Live Payment Notifications
        $data['td_lpn_url'] = $this->getParameter('notifyUrl');

        $data['td_item'] = $this->getDescription();  
        $data['td_amount'] = $this->getAmount();      // method in AbstractRequest class
        
        // Email plus address stored in the card
        $card = $this->getCard();
        $data['td_email'] = $card->getEmail();
        
        // Link back to transaction id in SS Shop
        $data['td_reference'] = $this->getParameter('transactionId');
        $data['td_user_data'] = $this->getParameter('transactionId');

        return $data;
    }


    // sending a message server to server
    public function send(){
        
        // Variables
        $headers = null;
        $data = $this->getData();

        // send request to payment gateway
        $httpResponse = $this->httpClient->post($this->endpoint, $headers, $data)->send();


        // sends data to the below function
        $create_response = $this->createResponse($httpResponse->json());
        return $create_response;
    }

    protected function createResponse($data){
        $this->response = new PaymentPageAuthorizeResponse($this, $data);
        return $this->response;
    }
}