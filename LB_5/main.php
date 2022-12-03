<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LB_5</title>
</head>
<body>
<?php
require_once('lb5.php');

$data_array = array(
    array(31, 54, -47,),
    array(77, -3, 68,),
    array(0, 5, -50),
);

$first_operation = new Sum($data_array);
echo 'Sum = '.$first_operation->get_result().'</br>';

$second_operation = new Multiplication($data_array);
echo 'Multiplication = '.$second_operation->get_result().'</br>';

$third_operation = new Average($data_array);
echo 'Average = '.$third_operation->get_result().'</br>';

?>
</body>
</html>
