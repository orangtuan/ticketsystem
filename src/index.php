<?php
require_once("database.php");
require_once("BaseDao.php");
require_once("customer/customerRepository.php");
require_once("customer/customer.php");
require_once("employee/employeeRepository.php");
require_once("employee/employee.php");
require_once("ticketState/ticketStateRepository.php");
require_once("ticketState/ticketState.php");
require_once("ticket/ticketRepository.php");
require_once("ticket/ticket.php");

try {
    $database = new Database();
    $database->connect();

    // Customer
    $customerRepository = new CustomerRepository($database);
    $customer = $customerRepository->selectByID(1);
    if ($customer !== null) {
        echo "<pre>" . print_r($customer, true) . "</pre>";
    } else {
        echo "No customer entries in the database for the given ID.<br>";
    }
    
    // Employee
    $employeeRepository = new EmployeeRepository($database);
    $employee = $employeeRepository->selectByID(1);
    if ($employee !== null) {
        echo "<pre>" . print_r($employee, true) . "</pre>";
    } else {
        echo "No employee entries in the database for the given ID.<br>";
    }

    // TicketState
    $ticketStateRepository = new TicketStateRepository($database);
    $ticketState= $ticketStateRepository->selectByID(1);
    if ($ticketState !== null) {
        echo "<pre>" . print_r($ticketState, true) . "</pre>";
    } else {
        echo "No ticketState entries in the database for the given ID.<br>";
        echo "No ticketState entries in the database for the given ID.<br>";
    }

    // Ticket
    $ticketRepository = new TicketRepository($database);
    $tickets = $ticketRepository->selectAllTickets();
    if ($tickets !== null && count($tickets) > 0) {
        echo "<pre>" . print_r($tickets, true) . "</pre>";
    } else {
        echo "No ticket entries in the database.<br>";
    }

} catch (Exception $e) {
    echo "An error occurred: " . htmlspecialchars($e->getMessage()) . "<br>";
}
