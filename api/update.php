<?php
require 'database.php';

$postdata = file_get_contents('php://input');

if(isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    if(
        // Valid ID
        (int)$request->id < 1 || 
        // Allowed Range [0, 36]
        (int)$request->value < 0 || (int)$request->value > 36
    ) return http_response_code(400);

    $id = mysqli_real_escape_string($con, (int)$request->id);
    $value = mysqli_real_escape_string($con, (int)$request->value);

    $sql = "UPDATE `numbers` SET `value`='$value' WHERE `id`='$id'";

    if(mysqli_query($con, $sql)) {
        if(mysqli_affected_rows($con) < 1) return http_response_code(404);

        http_response_code(200);

        // Set to timezone of database
        date_default_timezone_set('Europe/Brussels');

        $number = [
            'id' => $id,
            'value' => $value,
            'dateAdded' => date('d-m-Y H:i:s')
        ];
        echo json_encode($number);
    } else {
        return http_response_code(422);
    }
}
?>