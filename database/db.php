<?php

class Database {
    private $servername='localhost';
    private $username='root';
    private $password='';
    private $dbname='getwork';
    private $conn;


    public function getConnection() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }


    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
            echo "Connection closed";
        }
    }
}


?>