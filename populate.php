<?php
$api_url = 'http://localhost:8080/api/create.php';

// cURL
$curl = curl_init($api_url);
$i = 0;
do{
    $data = array('value'=>rand(0, 36));
    $encoded = json_encode($data);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($curl);
    $i++;
}while($i < 100);
?>