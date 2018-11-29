<?php
use \SMSGatewayMe\Client\ApiClient;
use \SMSGatewayMe\Client\Configuration;
use \SMSGatewayMe\Client\Api\MessageApi;
use \SMSGatewayMe\Client\Model\SendMessageRequest;

function sendTextMessage($phone, $message)
{
    // Configure API key authorization: Authorization
    $config = Configuration::getDefaultConfiguration()->setApiKey('Authorization', SMS_GATEWAY_API_KEY);
    // Uncomment below to setup prefix (e.g. BEARER) for API key, if needed
    // SMSGatewayMe\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'BEARER');
    $apiClient = new ApiClient($config);
    $messageClient = new MessageApi($apiClient);
	$messages = new SendMessageRequest([
    'phoneNumber' => $phone,
    'message' => $message,
    'deviceId' => SMS_GATEWAY_DEVICE_ID]);
    try
    {
        $result = $messageClient->sendMessages([$messages]);
        print_r($result);
    }
    catch (Exception $exception)
    {
        echo 'Exception when calling MessageApi->sendMessages: ', $exception->getMessage(), "\n";
    }
}


function sendTextMessage2($number, $message)
{
    //$id = array("z10" => 75821, "techno" => 75823, "blu" => "85174");
    //$page = 1;
    $smsGateway = new SmsGateway(SMS_GATEWAY_EMAIL, SMS_GATEWAY_PASSWORD);
    $deviceID = SMS_GATEWAY_DEVICE_ID;
    $number = SMS_GATEWAY_DEVICE_PHONE_NUM;
    $options = [
      'send_at' => strtotime('+1 minutes'), // Send the message in 10 minutes
      'expires_at' => strtotime('+1 hour'), // Cancel the message in 1 hour if the message is not yet sent
    ];
    $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID, $options);
    if ($result['status'] == 200) {
        if (!$result['response']['success']) {
            throw new Exception("SMS sending failed!", 1);
        } else if (count($result['response']['result']['success']) <= 0) {
            throw new Exception("SMS sending failed!", 1);
        }
    } else {
        throw new Exception("SMS sending failed!", 1);
    }
    return true;
}


?>