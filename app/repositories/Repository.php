<?php

class Repository
{
    protected $connection;

    function __construct()
    {
        require __DIR__ . '/../config/dbConfig.php';

        try {
            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $message = '[' . date("F j, Y, g:i a e O") . ']' . $e->getMessage() . $e->getCode() . $e->getFile() . ' Line ' . $e->getLine() . PHP_EOL;
            error_log("Database connection failed: " . $message, 3, __DIR__ . "/../Errors/error.log");
            http_response_code(503);
            exit();
        }
    }
}
