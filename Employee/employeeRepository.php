<?php
class EmployeeRepository
{
    private Database $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

	public function select(int $id): ?Employee {
        $stmt = $this->database->getMysqli()->prepare("SELECT * FROM employee WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            $stmt->close();
            return null;
        }

        $resultArray = $result->fetch_assoc();
        $stmt->close();

        return new Employee(
            $resultArray["id"],
            $resultArray["name"],
            $resultArray["password"]
        );
    }
}