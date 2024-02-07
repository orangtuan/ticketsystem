<?php
class TicketStateRepository extends BaseDao
{
    protected string $_tableName = 'ticket_state';
    protected string $_primaryKey = 'id';

    public function selectByID(int $id) : ?TicketState
    {
        $results = $this->fetch($id);
        if ($results === null) return null;
        $result = $results[0];
        return new TicketState(
            $result["id"],
            $result["state"]
        );
    }
    public function insertTicketState(TicketState $ticketState): int
    {
        $keyedArray = array(
            "state" => "'" . $ticketState->getState() . "'"
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

	public function selectByState(string $state): ?TicketState
    {
        $sql = "SELECT * FROM {$this->_tableName} WHERE state = ?";
        $stmt = $this->database->getMysqli()->prepare($sql);
        $stmt->bind_param("s", $state);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            return null;
        }

        $row = $result->fetch_assoc();
        $stmt->close();
        
        return new TicketState($row["id"], $row["state"]);
    }
}