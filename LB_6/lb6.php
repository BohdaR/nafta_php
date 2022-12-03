<?php
require_once '../LB_5/lb5.php';
$input_file = fopen("data/input.txt", "r") or die("Unable to open file!");
$output_file = fopen("data/output.txt", "w") or die("Unable to open file!");

while (!feof($input_file)) {
    $file_line = fgets($input_file);
    $param_array = explode(", data: ", $file_line);
    $data_array = json_decode('{"data": '.$param_array[1].'}', true)["data"];

    switch (strtolower($param_array[0])) {
        case 'sum':
            $new_operation = new Sum($data_array);
            fwrite($output_file, "Sum of the matrix elements equals to " . $new_operation->get_result());
            break;
        case 'average':
            $new_operation = new Average($data_array);
            fwrite($output_file, "Average of the matrix elements equals to " . $new_operation->get_result());
            break;
        case 'multiplication':
            $new_operation = new Multiplication($data_array);
            fwrite($output_file, "Product of matrix elements equals to " . $new_operation->get_result());
    }
    fwrite($output_file, "\n");
}
fclose($input_file);
fclose($output_file);
