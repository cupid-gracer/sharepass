<?php
include('Utils.php');

class DB
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "oncetime";
    private $con;

    function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function sqlRun($sql)
    {
        return $this->conn->query($sql);
    }
}
?>