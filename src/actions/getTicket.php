<?php
require_once("../bootstrap.php");

try {
    $database = new Database();
    $database->connect();

    $ticketRepository = new TicketRepository($database);
    $tickets = $ticketRepository->selectAllTickets();

    if ($tickets !== null) {
        $ticketId = isset($_POST['ticketId']) ? $_POST['ticketId'] : null;
        if ($ticketId !== null) {
            $ticket = $ticketRepository->selectByID($ticketId);
            if ($ticket !== null) {
				$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                $host = $_SERVER['HTTP_HOST'];
                $url = $scheme . $host . "/t?id=" . $ticket->getId();
                echo "<a href='" . htmlspecialchars($url) . "'>" . htmlspecialchars($url) . "</a>";
            } else {
                echo "No ticket entries in the database for the given ID.<br>";
            }
        } else {
            echo "Ticket ID not provided.";
        }
    } else {
        echo "No ticket entries in the database.";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
