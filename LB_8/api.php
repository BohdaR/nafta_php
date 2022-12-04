<?php
require_once('../LB_7/db.php');
header('Content-Type: application/json; charset=utf-8');

$query = "SELECT data.*, operations.name operation_name FROM data INNER JOIN operations ON operations.id=data.operation_id;";
$result = pg_query($CONNECTION, $query) or die('Query failed: ' . pg_last_error());

$data_array = array();
if (pg_affected_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        $data_array[] = $row;
    }
    echo json_encode($data_array);
}
