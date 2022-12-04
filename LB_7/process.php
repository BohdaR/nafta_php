<?php
require_once('../LB_5/lb5.php');
require_once('db.php');


if (isset($_POST['operation_id'])) {
    $data_array = json_decode('{"data": '.$_POST['input_data'].'}', true)["data"];
    $new_operation = null;
    switch ($_POST['operation_id']) {
        case 1:
            $new_operation = new Sum($data_array);
            break;
        case 2:
            $new_operation = new Average($data_array);
            break;
        case 3:
            $new_operation = new Multiplication($data_array);
    }
    $query = "INSERT INTO data VALUES (DEFAULT," . $_POST['operation_id'] . ",'" . $_POST['input_data'] . "','" . $new_operation->get_result() . "')";
    $result = pg_query($CONNECTION, $query) or die('Query failed: ' . pg_last_error());

}
if (isset($_GET['delete_id'])) {
    $query = "DELETE from data WHERE id=" . $_GET['delete_id'];
    $result = pg_query($CONNECTION, $query) or die('Query failed: ' . pg_last_error());
}
header("Location: view.php");
