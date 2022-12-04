<?php
include('db.php');

$query = "SELECT * FROM operations";
$result = pg_query($CONNECTION, $query) or die('Query failed: ' . pg_last_error());
$op_options = "";

while ($row = pg_fetch_assoc($result)) {
    $op_options .= "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>\n";
}
pg_close($CONNECTION);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add new data</title>
</head>
<body>
<h1>Add new data</h1>
<h3>Fill the form to add data</h3>
<form action="process.php" method="POST">
    <select name="operation_id" required>
        <?php echo $op_options; ?>
    </select>
    </br>
    <input name="input_data" placeholder="Input data" required type="text"/></br>
    <input type="submit" value="Add value"/>
</form>
</body>
</html>
