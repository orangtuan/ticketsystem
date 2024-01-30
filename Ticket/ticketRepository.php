<?php

class TicketRepository
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function selectByID(int $id): ?Ticket {
        $stmt = $this->database->getMysqli()->prepare("SELECT * FROM ticket WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            $stmt->close();
            return null;
        }

        $resultArray = $result->fetch_assoc();
        $stmt->close();

        return new Ticket(
            $resultArray["id"],
            $resultArray["title"],
            $resultArray["description"],
            new DateTime($resultArray["creationDate"]),
            new DateTime($resultArray["closingDate"]),
            TicketState::from($resultArray["state"]),
            $resultArray["mail"],
            $resultArray["name"]
        );
    }

    public function selectAll(): array {
        $stmt = $this->database->getMysqli()->prepare("SELECT * FROM ticket");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            $stmt->close();
            return [];
        }

        $tickets = [];
        while ($resultArray = $result->fetch_assoc()) {
            $tickets[] = new Ticket(
                $resultArray["id"],
                $resultArray["title"],
                $resultArray["description"],
                new DateTime($resultArray["creationDate"]),
                new DateTime($resultArray["closingDate"]),
                TicketState::from($resultArray["state"]),
                $resultArray["mail"],
                $resultArray["name"]
            );
        }
        $stmt->close();

        return $tickets;
    }

    public function insert(string $title, string $description, DateTime $creationDate, DateTime $closingDate, TicketState $state, string $mail, string $name): int {
		$stmt = $this->database->getMysqli()->prepare("INSERT INTO ticket (title, description, creationDate, closingDate, state, mail, name) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$creationDateString = $creationDate->format('Y-m-d H:i:s');
		$closingDateString = $closingDate->format('Y-m-d H:i:s');
		$stateValue = $state->value;
	
		$stmt->bind_param("sssssss", $title, $description, $creationDateString, $closingDateString, $stateValue, $mail, $name);
		$result = $stmt->execute();
	
		if ($result === false) {
			$stmt->close();
			return -1;
		}
	
		$insertedId = $stmt->insert_id;
		$stmt->close();
		return $insertedId;
	}

	public function update(Ticket $ticket): void {
		$stmt = $this->database->getMysqli()->prepare("UPDATE ticket SET title = ?, description = ?, creationDate = ?, closingDate = ?, state = ?, mail = ?, name = ? WHERE id = ?");
		$creationDateString = $ticket->getCreationDate()->format('Y-m-d H:i:s');
		$closingDateString = $ticket->getClosingDate()->format('Y-m-d H:i:s');
		$stateValue = $ticket->getState()->value;
	
		$stmt->bind_param("sssssssi", $ticket->getTitle(), $ticket->getDescription(), $creationDateString, $closingDateString, $stateValue, $ticket->getMail(), $ticket->getName(), $ticket->getId());
		$stmt->execute();
		$stmt->close();
	}
}