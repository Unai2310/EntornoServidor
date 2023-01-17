<?php

function getCountry($ip) {
    $url = "http://ip-api.com/json/$ip";
    $json_data = file_get_contents($url);
    $response_data = json_decode($json_data,true);

    return $response_data['countryCode'];
}

function regexIp($ip) {
    return preg_match("/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/",$ip);
}

?>