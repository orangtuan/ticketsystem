<?php
require_once("../bootstrap.php");

try {
	$database = new Database();
	$database->connect();

	$ticketRepository = new TicketRepository($database);
	$tickets = $ticketRepository->selectAllTickets();

	if ($tickets !== null) {
		$ticketId = isset($_POST['ticketId']) ? $_POST['ticketId'] : null;
		$ticket = $ticketRepository->selectByID($ticketId);
		if ($ticket !== null) {
			echo "<table>" .
				"<tr><th>Property</th><th>Value</th></tr>" .
				"<tr><td>Ticket ID</td><td>" . $ticket->getId() . "</td></tr>" .
				"<tr><td>Title</td><td>" . $ticket->getTitle() . "</td></tr>" .
				"<tr><td>Description</td><td>" . $ticket->getDescription() . "</td></tr>" .
				"</table>";
		} else {
			echo "No ticket entries in the database for the given ID.<br>";
		}
	} else {
		echo "No ticket entries in the database.";
	}
} catch (Exception $e) {
	echo "An error occurred: " . $e->getMessage();
}