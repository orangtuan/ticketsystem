<?php
class TicketStateRepository
{
    private Database $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function select(int $id) : TicketState|null
    {
        $result = $this->database->getMysqli()->execute_query("SELECT * FROM ticket_state WHERE ID = " . $id);
        if ($result === false) return null;
        $resultArray = $result->fetch_assoc();

        $ticket_state = new TicketState(
            $resultArray["id"],
            $resultArray["state"]
        );

        return $ticket_state;
    }
}