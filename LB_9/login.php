<?php
require_once('../LB_7/db.php');
session_start();
if (isset($_SESSION['user'])) {
    header('Location: ../LB_7/view.php');
}
if (isset($_POST['login'])) {
    $query = "SELECT * FROM users WHERE login='".$_POST['login']."' AND password='".md5($_POST['password'])."'";
    $result = pg_query($CONNECTION, $query) or die('Query failed: ' . pg_last_error());
    $userdata = null;
    if (pg_affected_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            $userdata = $row;
            $_SESSION['user'] = $userdata;
        }
        echo "Success! Logged in as " . $_SESSION['user']['login'];
        header('Location: ../LB_7/view.php');
    } else {
        echo "Wrong login or password";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
</head>
<body>
<h1>Enter login data</h1>
<form method="POST" action="">
    <input type="text" name="login" required placeholder="Enter login"/></br>
    <input type="password" name="password" required placeholder="Enter password"/></br>
    <input type="submit" value="Login"/>
</form>
</body>
</html>
