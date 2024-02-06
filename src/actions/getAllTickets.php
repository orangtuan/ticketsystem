<?php
require_once("../bootstrap.php");

try {
	$database = new Database();
	$database->connect();

	$ticketRepository = new TicketRepository($database);
	$tickets = $ticketRepository->selectAllTickets();

	if ($tickets !== null) {
		echo "Number of tickets in the database: " . count($tickets);
	} else {
		echo "No ticket entries in the database.";
	}
} catch (Exception $e) {
	echo "An error occurred: " . $e->getMessage();
}
