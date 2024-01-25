<?php
class Database
{
    private string $serverAddress;
    private string $user;
    private string $password;
    private string $database;
    private mysqli|null $mysqli;

    function __construct()
    {
        $this->serverAddress = $_ENV["DB_SERVER"];
        $this->user = $_ENV["DB_USER"];
        $this->password = $_ENV["DB_PASSWORD"];
        $this->database = $_ENV["DB_DATABASE"];
    }

    function connect()
    {
        if ($this->mysqli != null) return;

        $this->mysqli = new mysqli($this->serverAddress, $this->user, $this->password, $this->database);

        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
            die();
        }
    }

    function disconnect()
    {
        if ($this->mysqli == null) return;

        $this->mysqli->close();
        $this->mysqli = null;
    }

    function isConnected()
    {
        return $this->mysqli != null;
    }

    public function getMysqli(): ?mysqli
    {
        return $this->mysqli;
    }

}