<?php

class messageRepository extends BaseDao {
    protected string $_tableName = 'message';
    protected string $_primaryKey = 'id';

    public function selectByID(int $id) : ?Message {
        $results = $this->fetch($id);

        if ($results === null) return null;

        $result = $results[0];

        return new message(
            $result["id"],
            $result["ticket_id"],
            $result["customer"],
            $result["employee"],
            $result["message"]
        );
    }

    public function insertMessage(Message $message): int {
        $keyedArray = array(
            "ticket"    => "'" . $message->getTicket()->getId() . "'",
            "customer"  => "'" . $message->getCustomer()->getId() . "'",
            "employee"  => "'" .$message->getEmployee()->getId() . "'",
            "message"   => "'" .$message->getMessage(). "'"
        );

        return $this->insert($keyedArray);
    }

    public function selectByTicketId(int $ticket_id) : ?array {
        $result = $this->fetch($ticket_id, "ticket_id");

        if ($result === null) return null;

        $messages = [];

        foreach ($result as $value) {

            $messages[] = new Message(
                $value["id"],
                $value["ticket_id"],
                $value["customer"],
                $value["employee"],
                $value["message"]

            );
        }

        return $messages;
    }
}