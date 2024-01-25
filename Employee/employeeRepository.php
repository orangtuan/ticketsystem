<?php
class EmployeeRepository
{
    private Database $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    function select(int $id) : Employee|null
    {
        $result = $this->database->getMysqli()->execute_query("SELECT * FROM employee WHERE ID = " . $id);
        if ($result === false) return null;
        $resultArray = $result->fetch_assoc();

        $employee = new Employee(
            $resultArray["id"],
            $resultArray["user"],
            $resultArray["password"]
        );

        return $employee;
    }
}