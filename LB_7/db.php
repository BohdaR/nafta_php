<?php

declare(strict_types=1);
require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

$connection_string = "host=" . $_ENV['HOST'] . " port=5432 dbname=" . $_ENV['DB_NAME'] . " user=" . $_ENV['DB_USER'] . " password=" . $_ENV['DB_PASSWORD'];
$CONNECTION = pg_connect($connection_string) or die("Could not connect");
