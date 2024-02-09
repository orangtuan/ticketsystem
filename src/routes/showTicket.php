<?php

try {
    $database = new Database();
    $database->connect();

    $ticketRepository = new TicketRepository($database);
	$messageRepository = new MessageRepository($database);

    $ticketId = $_GET['id'] ?? null;
    if ($ticketId !== null) {
        $ticket = $ticketRepository->selectByID($ticketId);
        if ($ticket !== null) {

?>
            <div class="button-row">
                <button id="home" onclick="window.location.href='/index.php'">Home</button>
            </div>

            <div class="container">
                <div class="title-row">
                    <?php echo $ticket->getTitle() ?>
                </div>

                <div class="description-row">
                    <?php echo $ticket->getDescription() ?>
                </div>
            </div>

			<div class="message-container">
                <?php
                $messages = $messageRepository->selectByTicketId($ticketId);
                if ($messages) {
                    foreach ($messages as $message) {
                        echo "<div class='message'>";
                        echo "<p><strong>Message:</strong> " . htmlspecialchars($message->getMessage()) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No messages for this ticket.</p>";
                }
                ?>
            </div>

            <div class="container">
			<form id="newMessage" action="../actions/createMessage.php" method="post">
			<input type="hidden" name="ticketId" value="<?php echo htmlspecialchars($ticketId); ?>">
				<div>
					<label>
						<textarea class="description-field"
								name="message" id="message" placeholder="Message" required></textarea>
					</label>
				</div>

				<br>

				<div class="button-row">
					<button type="submit">Send Message</button>
				</div>
                </form>
            </div>


            <link href="../css/style.css" rel="stylesheet">
			<script src="../js/script.js"></script>
            <div id="result"></div>
<?php
        } else {
            echo "No ticket entries in the database for the given ID.<br>";
        }
    } else {
        echo "Ticket ID not provided.";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
