<?php
class Database
{
    private string $serverAddress;
    private string $user;
    private string $password;
    private string $database;
    private int $port;
    private mysqli|null $mysqli = null;

    public function __construct()
    {
        $this->loadEnv();
    }

    private function loadEnv()
    {
        $envFile = __DIR__ . '/.env';
        $env = file_get_contents($envFile);
        $envLines = explode("\n", $env);

        foreach ($envLines as $line) {
            if (!empty($line) && strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }

        $this->serverAddress = $_ENV["DB_SERVER"];
        $this->user = $_ENV["DB_USER"];
        $this->password = $_ENV["DB_PASSWORD"];
        $this->database = $_ENV["DB_DATABASE"];
        $this->port = $_ENV["DB_PORT"];
    }

    public function connect()
    {
        if ($this->mysqli != null) return;

        var_dump($this);

        $this->mysqli = new mysqli(
            $this->serverAddress,
            $this->user,
            $this->password,
            $this->database,
            (int)$this->port
        );

        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
            die();
        }
    }

    public function disconnect()
    {
        if ($this->mysqli == null) return;

        $this->mysqli->close();
        $this->mysqli = null;
    }

    public function isConnected()
    {
        return $this->mysqli != null;
    }

    public function getMysqli(): ?mysqli
    {
        return $this->mysqli;
    }
}