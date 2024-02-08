<?php

session_start();

class Database {
    private string  $serverAddress;
    private string  $user;
    private string  $password;
    private string  $database;
    private int     $port;
    private ?mysqli $mysqli = null;

    public function __construct() {
		$this->loadEnv();
	}

	private function loadEnv(): void {
        $this->serverAddress    = getenv("DB_SERVER")   ?: $_ENV["DB_SERVER"];
		$this->user             = getenv("DB_USER")     ?: $_ENV["DB_USER"];
		$this->password         = getenv("DB_PASSWORD") ?: $_ENV["DB_PASSWORD"];
		$this->database         = getenv("DB_DATABASE") ?: $_ENV["DB_DATABASE"];
		$this->port             = getenv("DB_PORT")     ?: $_ENV["DB_PORT"];
	}

    public function connect(): void {
        if ($this->mysqli != null) return;

        $this->mysqli = new mysqli(
            $this->serverAddress,
            $this->user,
            $this->password,
            $this->database,
            $this->port
        );

        if ($this->mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
            die();
        }
    }

    public function disconnect(): void {
        if ($this->mysqli == null) return;

        $this->mysqli->close();
        $this->mysqli = null;
    }

    public function isConnected(): bool {
        return $this->mysqli != null;
    }

    public function getMysqli(): ?mysqli {
        return $this->mysqli;
    }
}