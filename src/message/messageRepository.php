<?php

class messageRepository extends BaseDao
{
    protected string $_tableName = 'message';
    protected string $_primaryKey = 'id';

    public function selectByID(int $id) : ?Message
    {
        $results = $this->fetch($id);
        if ($results === null) return null;
        $result = $results[0];
        return new message(
            $result["id"],
            $result["customer"],
            $result["employee"],
            $result["message"]
        );
    }
    public function insertMessage(Message $message): int {
        $keyedArray = array(
            "customer"=>"'" . $message->getCustomer()->getId() . "'",
            "employee"=>"'" .$message->getEmployee()->getId() . "'",
            "message"=>"'" .$message->getMessage(). "'",
        );
        return $this->insert($keyedArray);
    }
}