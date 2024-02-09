<?php

class Employee
{
    private ?int    $id;
    private string  $name;
    private string  $password;

    public function __construct(
        ?int    $id,
        string  $name,
        string  $password
    ) {
        $this->id       = $id;
        $this->name     = $name;
        $this->password = $password;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function login(Database $database): bool {
        $query  = "SELECT * FROM employee WHERE name = ? AND password = ?";
        $stmt   = $database->getMysqli()->prepare($query);

        $stmt->bind_param("ss", $this->name, $this->password);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            $_SESSION["name"]   = $user['name'];

            return true;
        } else {
            return false;
        }
    }

    public function loggedIn(): bool {
        return isset($_SESSION["name"]);
    }
}