<?php
require_once("database.php");
require_once("employee/employeeRepository.php");
require_once("employee/employee.php");
require_once("ticket/ticketRepository.php");
require_once("ticket/ticket.php");

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
