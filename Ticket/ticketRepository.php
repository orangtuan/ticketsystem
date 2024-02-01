<?php

class TicketRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
/** TODO: */
    public function selectByID(int $id): Ticket|null
    {
        $result = $this->database->getMysqli()->execute_query("SELECT * FROM ticket WHERE ID = " . $id);
        if ($result === false) return null;
        $resultArray = $result->fetch_assoc();

        $ticket = new Ticket(
            $resultArray["id"],
           // $resultArray["ticketState"],
            //$resultArray["customer"],
            //$resultArray["employe"]
            $resultArray["title"],
            $resultArray["description"],
            $resultArray["creationDate"],
            $resultArray["closingDate"]
        );

        return $ticket;
    }

    public function selectAll(): array
    {
        $result = $this->database->getMysqli()->execute_query("SELECT * FROM ticket");
        if ($result === false) return [];

        $tickets[] = [];
        while ($resultArray = $result->fetch_assoc()) {
            $tickets[] = new Ticket(
                $resultArray["id"],
                $resultArray["title"],
                $resultArray["description"],
                $resultArray["creationDate"],
                $resultArray["closingDate"],
                $resultArray["state"],
                $resultArray["mail"],
                $resultArray["name"]
            );
        }

        return $tickets;
    }

    public function insert(string $title, string $description, DateTime $creationDate, DateTime $closingDate, TicketState $state, string $mail, string $name): int
    {
        $result = $this->database->getMysqli()->execute_query("INSERT INTO ticket VALUES ('" .
            $title . "' , '" .
            $description . "' , '" .
            $creationDate . "' , '" .
            $closingDate . "' , '" .
            $state . "' , '" .
            $mail . "' , '" .
            $name . "')");

        if ($result === false) return -1;
        $resultArray = $result->fetch_array();

        return $resultArray[0];
    }

    public function update(Ticket $ticket): void
    {
        $this->database->getMysqli()->execute_query("UPDATE ticket SET (title = '" . $ticket->getTitle() . "' , description = '" . $ticket->getDescription() . "' , creationDate = '" . $ticket->getCreationDate() . "' , closingDate = '" . $ticket->getClosingDate() . "' , state = '" . $ticket->getState() . "' , mail = '" . $ticket->getMail() . "' , name = '" . $ticket->getName());
    }
}