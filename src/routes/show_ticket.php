<?php

try {
    $database = new Database();
    $database->connect();

    $ticketRepository = new TicketRepository($database);

    $ticketId = isset($_GET['id']) ? $_GET['id'] : null;
    if ($ticketId !== null) {
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
        echo "Ticket ID not provided.";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
