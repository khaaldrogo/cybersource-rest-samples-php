<?php
//echo "Inside php functionality"
error_reporting(E_ALL);

require_once('../CybersourceRestclientPHP/autoload.php');
require_once('../CybersourceRestclientPHP/ExternalConfig.php');

function VoidPayment()
{
	$commonElement = new CyberSource\ExternalConfig();
	$config = $commonElement->ConnectionHost();
	$apiclient = new CyberSource\ApiClient($config);
	$api_instance = new CyberSource\Api\VoidApi($apiclient);
  $id = '5341640025656635503527';
	$cliRefInfoArr = [
    'code' => 'test_void'
  ];
  $client_reference_information = new CyberSource\Model\V2paymentsClientReferenceInformation($cliRefInfoArr);

  $paymentRequestArr = [
    "clientReferenceInformation" => $client_reference_information
  ];

  $paymentRequest = new CyberSource\Model\VoidPaymentRequest($paymentRequestArr);
  $api_response = list($response,$statusCode,$httpHeader)=null;
  try {
    $api_response = $api_instance->voidPayment($paymentRequest, $id);
		echo "<pre>";print_r($api_response);

	} catch (Exception $e) {
		print_r($e->getresponseBody());
    print_r($e->getmessage());
	}
}    

// Call Sample Code
if(!defined('DO NOT RUN SAMPLE')){
    echo "Samplecode is Running..";
	VoidPayment();

}

?>	
