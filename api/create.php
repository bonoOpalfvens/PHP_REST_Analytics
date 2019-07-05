<?php
require 'database.php';

$postdata = file_get_contents('php://input');

if(isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    // Allowed range [0, 36]
    if((int)$request->value < 0 || (int)$request->value > 36) return http_response_code(400);

    $value = mysqli_real_escape_string($con, (int)$request->value);

    $sql = "INSERT INTO `numbers` (`value`) VALUES ('{$value}')";

    if(mysqli_query($con, $sql)){
        http_response_code(201);

        // Set to timezone of database
        date_default_timezone_set('Europe/Brussels');

        $number = [
            'id' => mysqli_insert_id($con),
            'value' => $value,
            'dateAdded' => date('d-m-Y H:i:s')
        ];
        echo json_encode($number);
    } else {
        // Delete in deployment
        echo mysqli_error($con);
        http_response_code(422);
    }
}
?>