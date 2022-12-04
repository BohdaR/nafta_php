<?php
    $connection_string = "host=localhost port=5432 dbname=postgres user=postgres password=nafta#08752";
    $CONNECTION = pg_connect($connection_string) or die("Could not connect");
