<?php

class TicketRepository  extends BaseDao
{
    protected string $_tableName = 'ticket';
    protected string $_primaryKey = 'id';

    /**
     * @throws Exception
     */
    public function selectByID(int $id): ?Ticket {
        $result = $this->fetch($id, 'id');
        if ($result === null) return null;
        return new Ticket(
            $result["id"],
            (new TicketStateRepository($this->database))->selectByID($result["state_id"]),
            (new CustomerRepository($this->database))->selectByID($result["customer_id"]),
            (new EmployeeRepository($this->database))->selectByID($result["employee_id"]),
            $result["title"],
            $result["description"],
            new DateTime($result["creationDate"]),
            new DateTime($result["closingDate"])
        );
    }

    /**
     * @throws Exception
     */
    public function selectAllTickets(): ?array {
        $result = $this->fetchAll();
        if ($result === null) return null;
        $tickets = [];
        foreach ($result as $value) {
                $tickets[] = new Ticket(
                    $value["id"],
                    (new TicketStateRepository($this->database))->selectByID($value["state_id"]),
                    (new CustomerRepository($this->database))->selectByID($value["customer_id"]),
                    (new EmployeeRepository($this->database))->selectByID($value["employee_id"]),
                    $value["title"],
                    $value["description"],
                    new DateTime($value["creationDate"]),
                    new DateTime($value["closingDate"])
                );
        }
        return $tickets;
    }
    public function insertTicket(Ticket $ticket): int {
        $keyedArray = array(
            "state_id"=>$ticket->getTicketState()->getId(),
            "customer_id"=>$ticket->getCustomer()->getId(),
            "employee_id"=>$ticket->getEmployee()->getId(),
            "title" => $ticket->getTitle(),
            "description" => $ticket->getDescription(),
            "creationDateString" => $ticket->getCreationDate()->format('Y-m-d H:i:s'),
            "closingDateString" => $ticket->getClosingDate()->format('Y-m-d H:i:s')
        );

        return $this->insert($keyedArray);
    }

	public function updateTicket(Ticket $ticket): void {
        $keyedArray = array("id"=>$ticket->getId(),
            "state_id"=>$ticket->getTicketState()->getId(),
            "customer_id"=>$ticket->getCustomer()->getId(),
            "employee_id"=>$ticket->getEmployee()->getId(),
            "title" => $ticket->getTitle(),
            "description" => $ticket->getDescription(),
            "creationDateString" => $ticket->getCreationDate()->format('Y-m-d H:i:s'),
            "closingDateString" => $ticket->getClosingDate()->format('Y-m-d H:i:s')
            );
        $this->update($keyedArray);
	}
}