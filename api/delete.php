<?php
require 'database.php';

$postdata = file_get_contents('php://input');

if(isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

    // Valid ID
    if((int)$request->id < 1) return http_response_code(400);

    $id = mysqli_real_escape_string($con, (int)$request->id);

    $sql = "DELETE FROM `numbers` WHERE `id`='$id'";

    if(mysqli_query($con, $sql)) {
        if(mysqli_affected_rows($con) < 1) return http_response_code(404);

        http_response_code(204);
    } else {
        return http_response_code(422);
    }
}
?>