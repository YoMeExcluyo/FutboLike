<?php
set_time_limit(0);

$url = "http://goldtv.lat:80/live/9C00D37FA671/D37FA6719C00/276332.ts";

header("Content-Type: video/mp2t");
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-cache");

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => false,
    CURLOPT_HEADER => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_BUFFERSIZE => 8192,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_USERAGENT => "Mozilla/5.0",
    CURLOPT_WRITEFUNCTION => function($ch, $data) {
        echo $data;
        ob_flush();
        flush();
        return strlen($data);
    }
]);

curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo curl_error($ch);
}

curl_close($ch);
?>
