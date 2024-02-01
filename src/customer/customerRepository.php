<?php
class CustomerRepository
{
    private Database $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function select(int $id) : Customer|null
    {
        $result = $this->database->getMysqli()->execute_query("SELECT * FROM customer WHERE ID = " . $id);
        if ($result === false) return null;
        $resultArray = $result->fetch_assoc();

        $customer = new customer(
            $resultArray["id"],
            $resultArray["name"],
            $resultArray["email"]
        );

        return $customer;
    }
}