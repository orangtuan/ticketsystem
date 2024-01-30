<?php
require_once ("database.php");
require_once ("Employee/employeeRepository.php");
require_once ("Employee/employee.php");
require_once ("Ticket/ticketRepository.php");
require_once ("Ticket/ticket.php");

$database = new Database();
$database->connect();

// Employee
$employeeRepository = new EmployeeRepository($database);
$employee = $employeeRepository->select(1);
var_dump($employee);

// Ticket
$ticketRepository = new TicketRepository($database);
$tickets = $ticketRepository->selectAll();
var_dump($tickets);