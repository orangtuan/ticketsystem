<?php

require_once("../bootstrap.php");

try {
    $database = new Database();
    $database->connect();

    $ticketRepository = new TicketRepository($database);
    $messageRepository = new MessageRepository($database);

    if (isset($_POST['ticketId']) && isset($_POST['message'])) {
        $ticketId = $_POST['ticketId'];
        $messageContent = $_POST['message'];

        $ticket = $ticketRepository->selectByID($ticketId);

        if ($ticket !== null) {
            $message = new Message(null, $ticket, $ticket->getCustomer(), $ticket->getEmployee(), $messageContent);

            $messageId = $messageRepository->insertMessage($message);

            echo "Message created with ID: " . htmlspecialchars($messageId) . "<br>";
			echo "<a href='/t?id=" . $ticketId . "' style='text-decoration:none;color:inherit;'>Click here to view the ticket</a>";
        } else {
            echo "No ticket found with ID: " . htmlspecialchars($ticketId) . "<br>";
        }
    } else {
        echo "Ticket ID or message not provided.<br>";
    }

} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
