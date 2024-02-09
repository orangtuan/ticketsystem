<?php

require_once("../bootstrap.php");

try {
	$database = new Database();
	$database->connect();

	$ticketRepository = new TicketRepository($database);
	$tickets = $ticketRepository->selectAllTickets();

	if ($tickets !== null) {
		echo "Number of tickets in the database: " . count($tickets) . "\n\n";
		echo "Ticket IDs: ";

		foreach ($tickets as $ticket) {
            $scheme = (!empty($_SERVER['HTTPS'])
                && $_SERVER['HTTPS'] !== 'off'
                || $_SERVER['SERVER_PORT'] == 443)
                ? "https://" : "http://";

            $host   = $_SERVER['HTTP_HOST'];

            $url    = $scheme . $host . "/t?id=" . $ticket->getId();

			echo "<br>" . $ticket->getId() . " ";
            echo "<a href='" . htmlspecialchars($url) . "' target='_blank'>" . htmlspecialchars($url) . "</a>";
		}
	} else {
		echo "No ticket entries in the database.";
	}
} catch (Exception $e) {
	echo "An error occurred: " . $e->getMessage();
}
