<?php
class EmployeeRepository extends BaseDao
{
    protected string $_tableName = 'employee';
    protected string $_primaryKey = 'id';

    public function selectByID(int $id): ?Employee
    {
        $result = $this->fetch($id, 'id');
        if ($result === null) return null;

        return new Employee(
            $result["id"],
            $result["name"],
            $result["password"]
        );
    }

    public function insertEmployee(Employee $employee): int
    {
        $keyedArray = array(
            "name" => $employee->getName(),
            "password" => $employee->getPassword()
        );
        return $this->insert($keyedArray);
    }

    public function updateEmployee(Employee $employee): void
    {
        $keyedArray = array(
            "id" => $employee->getId(),
            "name" => $employee->getName(),
            "password" => $employee->getPassword()
        );
        $this->update($keyedArray);
    }
}
