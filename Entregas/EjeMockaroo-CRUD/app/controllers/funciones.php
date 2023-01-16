<?php

function getCountry($ip) {
    $url = "http://ip-api.com/json/$ip";
    $json_data = file_get_contents($url);
    $response_data = json_decode($json_data,true);

    return $response_data['countryCode'];
}

?>