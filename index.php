<?php
require_once("database.php");
require_once("Employee/employeeRepository.php");
require_once("Employee/employee.php");
require_once("Ticket/ticketRepository.php");
require_once("Ticket/ticket.php");

try {
    $database = new Database();
    $database->connect();

    // Employee
    $employeeRepository = new EmployeeRepository($database);
    $employee = $employeeRepository->select(1);
    if ($employee !== null) {
        echo "<pre>" . print_r($employee, true) . "</pre>";
    } else {
        echo "No employee entries in the database for the given ID.<br>";
    }

    // Ticket
    $ticketRepository = new TicketRepository($database);
    $tickets = $ticketRepository->selectAll();
    if ($tickets !== null && count($tickets) > 0) {
        echo "<pre>" . print_r($tickets, true) . "</pre>";
    } else {
        echo "No ticket entries in the database.<br>";
    }

} catch (Exception $e) {
    echo "An error occurred: " . htmlspecialchars($e->getMessage()) . "<br>";
}
