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
            $result["customer_id"],
            $result["employee_id"],
            $result["message"]
        );
    }

    public function insertMessage(Message $message): int {
        $keyedArray = array(
			"ticket_id"    => $message->getTicket()->getId(),
            "customer_id"  => "'" . $message->getCustomer()->getId() . "'",
            "employee_id"  => "'" .$message->getEmployee()->getId() . "'",
            "message"   => "'" .$message->getMessage(). "'"
        );

        return $this->insert($keyedArray);
    }

    public function selectByTicketId(int $ticket_id) : ?array {
		$result = $this->fetch($ticket_id, "ticket_id");
	
		if ($result === null) return null;
	
		$messages = [];
		$ticketRepository = new TicketRepository($this->database);
		$customerRepository = new CustomerRepository($this->database);
		$employeeRepository = new EmployeeRepository($this->database);
	
		foreach ($result as $value) {
			$ticket = $ticketRepository->selectByID($value["ticket_id"]);
	
			$customer = null;
			if ($value["customer_id"]) {
				$customer = $customerRepository->selectByID($value["customer_id"]);
			}
	
			$employee = null;
			if ($value["employee_id"]) {
				$employee = $employeeRepository->selectByID($value["employee_id"]);
			}
	
			$messages[] = new Message(
				$value["id"],
				$ticket,
				$customer,
				$employee,
				$value["message"]
			);
		}
	
		return $messages;
	}
	
}