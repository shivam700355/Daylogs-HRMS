<?php

$authkeyUrl = "https://api.authkey.io/request?";
$paramArray = Array(
    'authkey' => '388fe95d3f9567af',
    'mobile' => '7007381844',
    'country_code' => '91',
    'sms' => 'Hello this is a test message',
    'sender' => 'SENDERID'
    );

$parameters = http_build_query($paramArray);
$url = $authkeyUrl . $parameters;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}

?>
