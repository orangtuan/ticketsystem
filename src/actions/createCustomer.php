<?php

session_start();

include_once (dirname(__DIR__) . '/bootstrap.php');

$database = new Database();
$database->connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"], $_POST["email"])) {
        $name   = $_POST["name"];
        $email  = $_POST["email"];

        $stmt = $database->getMysqli()->prepare("INSERT INTO customer (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Name and email must be set";
    }
} else {
    echo "Invalid request method.";
}