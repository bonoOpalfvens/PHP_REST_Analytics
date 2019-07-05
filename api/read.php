<?php
// Returns all the saved records

require 'database.php';
$numbers = [];
$sql = 'SELECT id, value, dateAdded FROM numbers';

if($result = mysqli_query($con, $sql)) {
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
        $numbers[$i]['id'] = $row['id'];
        $numbers[$i]['value'] = $row['value'];
        $numbers[$i]['dateAdded'] = $row['dateAdded'];

        $i++;
    }

    echo json_encode($numbers);
} else {
    http_response_code(404);
}
?>