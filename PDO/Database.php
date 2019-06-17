<?php


namespace PDO;


use PDO;
use PDOException;

class Database {
    private $host;
    private $dbName;
    private $username;
    private $password;
    public $conn;

    public function __constructor ($dbConfig){
        $this -> host = $dbConfig['host'];
        $this -> dbName = $dbConfig['dbname'];
        $this -> username = $dbConfig['username'];
        $this -> password = $dbConfig['password'];
    }

    public function getConnection(){
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

