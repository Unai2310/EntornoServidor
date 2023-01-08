<?php

function getCountry($ip) {
    $access_key = '5474240b572f2a7530b639f6ff3fd08d';
    $url = "http://api.ipapi.com/$ip?access_key=$access_key";
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        echo $error_msg;
    }
    $arr_result = json_decode($response, true);
    return $arr_result['country_code'];
}

?>