<?php
require_once('db.php');
$query = "SELECT data.*, operations.name operation_name FROM data INNER JOIN operations ON operations.id=data.operation_id;";
$result = pg_query($CONNECTION, $query) or die('Query failed: ' . pg_last_error());
$table_data = "";

while ($row = pg_fetch_assoc($result)) {
    $table_data .= "
                    <tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["operation_name"] . "</td>
                        <td>" . $row["input_data"] . "</td>
                        <td>" . $row["output_data"] . "</td>
                        <td><a href='process.php?delete_id=" . $row["id"] . "'>Delete</a></td>
                    </tr>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
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
