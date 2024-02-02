<?php
class TicketStateRepository extends BaseDao
{
    protected string $_tableName = 'ticket_state';
    protected string $_primaryKey = 'id';

    public function selectByID(int $id) : ?TicketState
    {
        $result = $this->fetch($id, 'id');
        if ($result === null) return null;
        return new TicketState(
            $result["id"],
            $result["state"]
        );
    }
    public function insertTicketState(TicketState $ticketState): int
    {
        $keyedArray = array(
            "state" => $ticketState->getState()
        );
        return $this->insert($keyedArray);
    }

    public function updateTicketState(TicketState $ticketState): void
    {
        $keyedArray = array(
            "id" => $ticketState->getId(),
            "state" => $ticketState->getState()
        );
        $this->update($keyedArray);
    }
}