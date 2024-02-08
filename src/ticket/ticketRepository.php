<?php

class TicketRepository extends BaseDao {
    protected string $_tableName    = 'ticket';
    protected string $_primaryKey   = 'id';

    /**
     * @throws Exception
     */
    public function selectByID(int $id): ?Ticket {
        $results = $this->fetch($id);

        if ($results === null) return null;

        $result = $results[0];

        $creationDate   = $result["creationDate"]   ? new DateTime($result["creationDate"]) : null;
        $closingDate    = $result["closingDate"]    ? new DateTime($result["closingDate"])  : null;

        return new Ticket(
            $result["id"],
            (new TicketStateRepository($this->database))->selectByID($result["state_id"]),
            (new CustomerRepository($this->database))->selectByID($result["customer_id"]),
            (new EmployeeRepository($this->database))->selectByID($result["employee_id"]),
            $result["title"],
            $result["description"],
            $creationDate,
            $closingDate,
            $result["url"]
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
            $creationDate   = $value["creationDate"]    ? new DateTime($value["creationDate"])  : null;
            $closingDate    = $value["closingDate"]     ? new DateTime($value["closingDate"])   : null;

            $tickets[] = new Ticket(
                $value["id"],
                (new TicketStateRepository($this->database))->selectByID($value["state_id"]),
                (new CustomerRepository($this->database))->selectByID($value["customer_id"]),
                (new EmployeeRepository($this->database))->selectByID($value["employee_id"]),
                $value["title"],
                $value["description"],
                $creationDate,
                $closingDate,
                $value["url"]
            );
        }

        return $tickets;
    }

    public function insertTicket(Ticket $ticket): int {
        $keyedArray = array(
            "state_id"      => "'" . $ticket->getTicketState()->getId() . "'",
            "customer_id"   => "'" . $ticket->getCustomer()->getId() . "'",
            "employee_id"   => "'" . $ticket->getEmployee()->getId() . "'",
            "title"         => "'" . $ticket->getTitle() . "'",
            "description"   => "'" . $ticket->getDescription() . "'",
            "creationDate"  => "'" . $ticket->getCreationDate()->format('Y-m-d H:i:s') . "'",
            "closingDate"   => $ticket->getClosingDate()
                ? "'" . $ticket->getClosingDate()->format('Y-m-d H:i:s') . "'" : 'NULL',
            "url"           => "'" . $ticket->getUrl() . "'"
        );

        return $this->insert($keyedArray);
    }

    public function updateTicket(Ticket $ticket): void {
        $keyedArray = array(
            "id"            => $ticket->getId(),
            "state_id"      => $ticket->getTicketState()->getId(),
            "customer_id"   => $ticket->getCustomer()->getId(),
            "employee_id"   => $ticket->getEmployee()->getId(),
            "title"         => $ticket->getTitle(),
            "description"   => $ticket->getDescription(),
            "creationDate"  => $ticket->getCreationDate()->format('Y-m-d H:i:s'),
            "closingDate"   => $ticket->getClosingDate()?->format('Y-m-d H:i:s'),
            "url"           => $ticket->getUrl()
        );

        $this->update($keyedArray);
    }
}
