<?php namespace Omnipay\Swipehq\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * PaymentPage Authorize Request (from authorize & purchase methods)
 *
 * The objective is to obtain an identifier from SwipeHQ
 */

class PaymentPageAuthorizeRequest extends AbstractRequest
{
    protected $endpoint = 'https://api.swipehq.com/createTransactionIdentifier.php';

    // Merchant ID
    public function getMerchantId()
    {
        return $this->getParameter('merchant_id');
    }

    public function getMerchant_id()
    {
        return $this->getParameter('merchant_id');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchant_id', $value);
    }

    public function setMerchant_id($value)
    {
        return $this->setParameter('merchant_id', $value);
    }

    // API Key
    public function getApiKey()
    {
        return $this->getParameter('api_key');
    }

    public function getApi_key()
    {
        return $this->getParameter('api_key');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('api_key', $value);
    }

    public function setApi_key($value)
    {
        return $this->setParameter('api_key', $value);
    }

    public function getData()
    {
        $data = array();

        $this->validate('amount', 'returnUrl', 'notifyUrl');

        // for connecting to the API
        $data['api_key'] = $this->getApiKey();
        $data['merchant_id'] = $this->getMerchantId();

        // returning to the website following credit card transaction
        $data['td_callback_url'] = $this->getReturnUrl();

        // Live Payment Notifications
        $data['td_lpn_url'] = $this->getParameter('notifyUrl');

        $data['td_item'] = $this->getDescription();
        $data['td_amount'] = $this->getAmount();      // method in AbstractRequest class
        
        // Email plus address stored in the card
        $card = $this->getCard();
        $data['td_email'] = $card->getEmail();
        
        // Link back to transaction id in eCommerce system
        $data['td_reference'] = $this->getParameter('transactionId');

        return $data;
    }


    /**
     * Send request
     *
     * @return Omnipay\Swipehq\Message\PaymentPageAuthorizeResponse
     */
    public function send()
    {
        // Variables
        $headers = null;
        $data = $this->getData();

        // send request to payment gateway
        $httpResponse = $this->httpClient->post($this->endpoint, $headers, $data)->send();

        // passes data to the below function
        return $this->createResponse($httpResponse->json());
    }

    /**
     * Send request; data provided
     *
     * @return Omnipay\Swipehq\Message\PaymentPageAuthorizeResponse
     */
    public function sendData($data)
    {
        // Variables
        $headers = null;

        // send request to payment gateway
        $httpResponse = $this->httpClient->post($this->endpoint, $headers, $data)->send();

        // passes data to the below function
        return $this->createResponse($httpResponse->json());
    }
    
    /**
     * Create an authorize response
     *
     * @param  PaymentPageAuthorizeResponse $data
     * @return Omnipay\Swipehq\Message\PaymentPageAuthorizeResponse
     */
    protected function createResponse($data)
    {
        return $this->response = new PaymentPageAuthorizeResponse($this, $data);
    }
}
