<?php

require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $title          = $_POST["title"]       ?? "";
        $description    = $_POST["description"] ?? "";

        if (empty($title) || empty($description)) {
            echo "Please fill out all fields.";
            exit;
        }

        $database = new Database();
        $database->connect();

        $ticketStateRepository  = new TicketStateRepository($database);
        $defaultState           = $ticketStateRepository->selectByState("Open");

        if ($defaultState === null) {
            echo "Default state not found.";
            exit;
        }

        $stateId = $defaultState->getId();

        $ticketRepository   = new TicketRepository($database);
        $customerRepository = new CustomerRepository($database);
        $employeeRepository = new EmployeeRepository($database);

        $existingCustomer = $customerRepository->selectByEmail("default_email");

        if ($existingCustomer === null) {
            $customer   = new Customer(null, "default_name", "default_email");
            $customerId = $customerRepository->insertCustomer($customer);
        } else {
            $customerId = $existingCustomer->getId();
        }

        $existingEmployee = $employeeRepository->selectByName("default_name");

        if ($existingEmployee === null) {
            $employee   = new Employee(null, "default_name", "default_password");
            $employeeId = $employeeRepository->insertEmployee($employee);
        } else {
            $employeeId = $existingEmployee->getId();
        }

        $ticket     = new Ticket(null, $defaultState, $existingCustomer
            ?? new Customer(null, "default_name", "default_email"), $existingEmployee
            ?? new Employee(null, "default_name", "default_password"),
            $title, $description, new DateTime(), null);
        $ticketId   = $ticketRepository->insertTicket($ticket);

        if ($ticketId !== null) {
            echo "Ticket created successfully with ID: " . $ticketId;
        } else {
            echo "Failed to create ticket.";
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}