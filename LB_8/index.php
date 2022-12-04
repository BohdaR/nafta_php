<?php
//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/LB_8/api.php');
// Execute
$result = curl_exec($ch);
// Closing
curl_close($ch);
$table_data = "";

foreach (json_decode($result) as &$row) {
    $table_data .= "
                    <tr>
                        <td>" . $row->id . "</td>
                        <td>" . $row->operation_name . "</td>
                        <td>" . $row->input_data . "</td>
                        <td>" . $row->output_data . "</td>
                        <td><a href='process.php?delete_id=" . $row->id . "'>Delete</a></td>
                    </tr>";
}
?>
<html>
<head>
    <title>View data</title>
</head>
<body>
<h1>View data</h1>
<a href="add.php">Add new data</a>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Operation</th>
        <th>Input data</th>
        <th>Result</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php echo $table_data; ?>
    </tbody>
</table>
</body>
</html>
