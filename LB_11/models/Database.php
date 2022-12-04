<?php

class Database
{
    private string $host;
    private string $login;
    private string $password;
    private string $dbname;
    private false|PgSql\Connection $connection;

    public function __construct($host, $login, $password, $db_name)
    {
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
        $this->dbname = $db_name;
        $this->connection = pg_connect("host=" . $host . " port=5432 dbname=" . $db_name . " user=" . $login . " password=" . $password) or die("Could not connect");
    }

    public function add_data($operation_id, $input_data, $output_data): void
    {
        $query = "INSERT INTO data (operation_id, input_data, output_data) VALUES (" . $operation_id . ",'" . $input_data . "','" . $output_data . "')";
        pg_query($this->connection, $query) or die('Query failed: ' . pg_last_error());
    }

    public function get_all_data()
    {
        $query = "SELECT data.*, operations.name operation_name FROM data INNER JOIN operations ON operations.id=data.operation_id;";
        $result = pg_query($this->connection, $query) or die('Query failed: ' . pg_last_error());

        $data_array = array();
        if (pg_affected_rows($result) > 0) {
            // output data of each row
            while ($row = pg_fetch_assoc($result)) {
                $data_array[] = $row;
            }
            return $data_array;
        } else {
            return false;
        }
    }

    public function get_all_operations()
    {
        $query = "SELECT * FROM operations";
        $result = pg_query($this->connection, $query) or die('Query failed: ' . pg_last_error());

        $data_array = array();
        if (pg_affected_rows($result) > 0) {
            while ($row = pg_fetch_assoc($result)) {
                $data_array[] = $row;
            }
            return $data_array;
        } else {
            return false;
        }
    }

    public function delete_data_by_id($id)
    {
        $query = "DELETE from data WHERE id=" . $id;
        pg_query($this->connection, $query) or die('Query failed: ' . pg_last_error());
    }

    public function login($login, $password)
    {
        $query = "SELECT * FROM users WHERE login='" . $login . "' AND password='" . md5($password) . "'";
        $result = pg_query($this->connection, $query) or die('Query failed: ' . pg_last_error());
        if (pg_affected_rows($result) > 0) {
            while ($row = pg_fetch_assoc($result)) {
                return $row;
            }
            echo "Success! Logged in as " . $_SESSION['user']['login'];
            header('Location: ../LB_7/view.php');
        } else {
            return false;
        }
    }
}
    