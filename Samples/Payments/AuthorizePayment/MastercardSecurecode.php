<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function MastercardSecurecode()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\PaymentApi($apiclient);
	$cliRefInfoArr = [
		'code' => 'TC45561-10'
	];
	$client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $consumerAuthenticationInformationArr = [
    "cavv" => "EHuWW9PiBkWvqE5juRwDzAUFBAk=",
    "ucafCollectionIndicator" => "0",
    "eciRaw" => "02",
    "ucafAuthenticationData" => "lEmYpm61EduaVZjPG1/HsgkAAQc="
  ];
  $consumerAuthenticationInformation = new CyberSource\Model\V2paymentsConsumerAuthenticationInformation($consumerAuthenticationInformationArr);
  
  $processingInformationArr = [
    "commerceIndicator" => "spa"
  ];
  $processingInformation = new CyberSource\Model\V2paymentsProcessingInformation($processingInformationArr);

  $amountDetailsArr = [
    "totalAmount" => "2016.05",
    "currency" => "USD"
  ];
  $amountDetInfo = new CyberSource\Model\V2paymentsOrderInformationAmountDetails($amountDetailsArr);

  $billtoArr = [
    "country" => "SG",
    "lastName" => "VDP",
    "address2" => "test",
    "address1" => "201 S. Division St.",
    "postalCode" => "48104-2201",
    "locality" => "Ann Arbor",
    "administrativeArea" => "MI",
    "firstName" => "RTS",
    "phoneNumber" => "999999999",
    "district" => "MI",
    "buildingNumber" => "123",
    "company" => "Visa",
    "email" => "test@cybs.com"
  ];
  $billto = new CyberSource\Model\V2paymentsOrderInformationBillTo($billtoArr);

  $orderInfoArry = [
    'amountDetails' => $amountDetInfo,
    'billTo' => $billto
  ];

  $order_information = new CyberSource\Model\V2paymentsOrderInformation($orderInfoArry);
  $paymentCardInfo = [
    "expirationYear" => "2031",
    "number" => "5641821111166669",
    "securityCode" => "123",
    "expirationMonth" => "12",
    "type" => "024"
  ];
  $card = new CyberSource\Model\V2paymentsPaymentInformationCard($paymentCardInfo);

  $paymentInfoArr = [
      'card' => $card
      
  ];
  $payment_information = new CyberSource\Model\V2paymentsPaymentInformation($paymentInfoArr);

  $paymentRequestArr = [
    'clientReferenceInformation' => $client_reference_information,
    'consumerAuthenticationInformation' => $consumerAuthenticationInformation,
    'orderInformation' => $order_information,
    'paymentInformation' => $payment_information,
    'processingInformation' => $processingInformation
  ];

	$paymentRequest = new CyberSource\Model\CreatePaymentRequest($paymentRequestArr);
  //echo "<pre>";print_r($paymentRequest);die;
	$api_response = list($response,$statusCode,$httpHeader)=null;
	try {
		$api_response = $api_instance->createPayment($paymentRequest, $id);
		//echo "<pre>";print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	MastercardSecurecode();

}

?>	
