<?php
    declare(strict_types=1);
    require_once('../vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();

    $db_servername = $_ENV["HOST"];
    $db_username = $_ENV["DB_USER"];
    $db_password = $_ENV["DB_PASSWORD"];
    $db_name = $_ENV["DB_NAME"];
    $mailserver = $_ENV["EMAIL_HOST"];
    $maillogin = $_ENV["EMAIL_USERNAME"];
    $mailpassword = $_ENV["EMAIL_PASSWORD"];
