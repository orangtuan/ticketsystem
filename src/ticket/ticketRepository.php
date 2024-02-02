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
        //TODO:ticketstate, customer,employee
        return new Ticket(
            TicketState::from($resultArray["state_id"]),
            Customer::$resultArray["customer_id"],
            Employee::$resultArray["employee_id"],
            $resultArray["id"],
            $resultArray["title"],
            $resultArray["description"],
            new DateTime($resultArray["creationDate"]),
            new DateTime($resultArray["closingDate"]),
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
        //TODO:ticketstate, customer,employee
        while ($resultArray = $result->fetch_assoc()) {
            $tickets[] = new Ticket(
                TicketState::from($resultArray["state_id"]),
                Customer::$resultArray["customer_id"],
                Employee::$resultArray["employee_id"],
                $resultArray["id"],
                $resultArray["title"],
                $resultArray["description"],
                new DateTime($resultArray["creationDate"]),
                new DateTime($resultArray["closingDate"]),
            );
        }
        $stmt->close();

        return $tickets;
    }

    public function insert( TicketState $ticketState, Customer $customer, Employee $employee, string $title, string $description, DateTime $creationDate, DateTime $closingDate): int {
		$stmt = $this->database->getMysqli()->prepare("INSERT INTO ticket (state_id, customer_id, employee_id, title, description, creationDate, closingDate) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$creationDateString = $creationDate->format('Y-m-d H:i:s');
		$closingDateString = $closingDate->format('Y-m-d H:i:s');
		$stateValue = $ticketState->value;//id holen
		$customerValue = $customer->value;//id holen
		$employeeValue = $employee->value;//id holen
	
		$stmt->bind_param("sssssss", $stateValue, $customerValue, $employeeValue, $title, $description, $creationDateString, $closingDateString);
		$result = $stmt->execute();
	
		if ($result === false) {
			$stmt->close();
			return -1;
		}
	
		$insertedId = $stmt->insert_id;
		$stmt->close();
		return $insertedId;
	}

  //TODO:ids
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