<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function ProcessCredit()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\CreditApi($apiclient);
	$cliRefInfoArr = [
    "code" => "12345678"
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $amountDetailsArr = [
      "totalAmount" => "200",
      "currency" => "usd"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);
  $billtoArr = [
    "firstName" => "Test",
    "lastName" => "test",
    "address1" => "test",
    "locality" => "Ann Arbor",
    "administrativeArea" => "MI",
    "postalCode" => "48104-2201",
    "country" => "US",
    "email" => "test@cybs.com",
    "phoneNumber" => "9999999999"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);
  $orderInfoArry = [
    "amountDetails" => $amountDetInfo,
    "billTo" => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentCardInfo = [
    "number" => "4111111111111111",
    "expirationMonth" => "03",
    "expirationYear" => "2031",
    "type" => "001"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);
  $paymentInfoArr = [
      "card" => $card
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information,
    "orderInformation" => $order_information,
    "paymentInformation" => $payment_information
  ];

  $paymentRequest = new CyberSource\Model\CreateCreditRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->createCreditWithHttpInfo($paymentRequest);
		print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	ProcessCredit();

}

?>	
