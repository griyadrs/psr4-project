<?php

namespace App\Libraries;

class Database 
{
    private string
        $host     = 'localhost',
        $username = 'root',
        $password = '',
        $database = 'demo_intern';
    private \mysqli $connection;

    public function __construct() 
    {
        $connect = new \mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($connect->connect_error) {
            die("Koneksi gagal: {$connect->connect_error}");
        }

        $this->connection = $connect;
    }

    public function connection() 
    {
        return $this->connection;
    }
}