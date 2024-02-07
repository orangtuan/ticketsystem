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

    // insert
    $customer = new Customer(null,"löschen","testmail");
    $customerId = $customerRepository->insertCustomer($customer);

    // delete
    $customerRepository->delete(9);

    // select by id
    $customer = $customerRepository->selectByID($customerId);
    if ($customer !== null) {
        echo "<pre>" . print_r($customer, true) . "</pre>";
    } else {
        echo "No customer entries in the database for the given ID.<br>";
    }

    // update
    $customer->setName("neuername");
    $customerRepository->updateCustomer($customer);


    // Employee
    $employeeRepository = new EmployeeRepository($database);

    //insert
    $employee = new Employee(null, "testname", "testpassword");
    $employeeId = $employeeRepository->insertEmployee($employee);

    // select by id
    $employee = $employeeRepository->selectByID($employeeId);
    if ($employee !== null) {
        echo "<pre>" . print_r($employee, true) . "</pre>";
    } else {
        echo "No employee entries in the database for the given ID.<br>";
    }

    // update
    $employee->setName("neuerName");
    $employeeRepository->updateEmployee($employee);

    // TicketState
    $ticketStateRepository = new TicketStateRepository($database);

    // insert
    $ticketState = new TicketState(null, "teststate");
    $ticketStateID = $ticketStateRepository->insertTicketState($ticketState);

    // select by id
    $ticketState= $ticketStateRepository->selectByID($ticketStateID);
    if ($ticketState !== null) {
        echo "<pre>" . print_r($ticketState, true) . "</pre>";
    } else {
        echo "No ticketState entries in the database for the given ID.<br>";
    }

    // update
    $ticketState->setState("neu");
    $ticketStateRepository->updateTicketState($ticketState);

    // Ticket
    $ticketRepository = new TicketRepository($database);

    //insert
    $ticket = new Ticket(null, $ticketState, $customer, $employee,"testtitel", "testdescription", new DateTime(), null);
    $ticketId = $ticketRepository->insertTicket($ticket);

    //select by id
    $ticket= $ticketRepository->selectByID($ticketId);
    if ($ticket !== null) {
        echo "<pre>" . print_r($ticket, true) . "</pre>";
    } else {
        echo "No $ticket entries in the database for the given ID.<br>";
    }

    // update
    $ticket->setTitle("neu");
    $ticketRepository->updateTicket($ticket);

    //select All
    $tickets = $ticketRepository->selectAllTickets();
    if ($tickets !== null && count($tickets) > 0) {
        echo "<pre>" . print_r($tickets, true) . "</pre>";
    } else {
        echo "No ticket entries in the database.<br>";
    }

} catch (Exception $e) {
    echo "An error occurred: " . htmlspecialchars($e->getMessage()) . "<br>";
}
