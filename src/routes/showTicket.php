<?php

try {
    $database = new Database();
    $database->connect();

    $ticketRepository = new TicketRepository($database);

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

            <div class="container">
                <form id="newMessage"">
                    <div>
                        <label>
                            <textarea class="description-field"
                                      name="message" placeholder="Message" required></textarea>
                        </label>
                    </div>

                    <br>

                    <div class="button-row">
                        <button type="submit">Send Message</button>
                    </div>
                </form>
            </div>


            <link href="../css/style.css" rel="stylesheet">
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
