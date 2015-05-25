<?php
/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * http://code.google.com/p/android-market-license-verification/source/browse/trunk/LICENSE
 */

set_include_path(get_include_path() . PATH_SEPARATOR . 'library');

require_once 'AndroidMarket/Licensing/ResponseData.php';
require_once 'AndroidMarket/Licensing/ResponseValidator.php';

define('PUBLIC_KEY', 'Your_App_Billing_Key');
define('PACKAGE_NAME', 'com.my.app');

//The | delimited response data from the licensing server
// in-app response data
//$responseData = '{"orderId":"12000763169054705758.1366289361937647","packageName":"com.my.app","productId":"inapp_product_id","purchaseTime":1432353623063,"purchaseState":0,"purchaseToken":"khakflo...dSMhLF9b"}';

// sus response data
$data = Array("packageName"=>"com.my.app",
	"productId"=>"subs_id",
	"purchaseTime"=>1432095465481,
	"purchaseState"=>0,
	"purchaseToken"=>"pdiggkj...sI0VwnZ_",
	"autoRenewing"=>false
	);
$responseData = json_encode($data);
//The signature provided with the response data (Base64)
$signature = "RNnIFl...==";
//if you wish to inspect or use the response data, you can create
//a response object and pass it as the first argument to the Validator's verify method
//$response = new AndroidMarket_Licensing_ResponseData($responseData);
//$valid = $validator->verify($response, $signature);

$validator = new AndroidMarket_Licensing_ResponseValidator(PUBLIC_KEY, PACKAGE_NAME);
$valid = $validator->verify($responseData, $signature);
if ($valid){
	echo 'valid';
}else{
	echo 'invalid';
}
