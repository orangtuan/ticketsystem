<?php
class CustomerRepository extends BaseDao
{
    protected string $_tableName = 'customer';
    protected string $_primaryKey = 'id';

    public function selectByID(int $id) : ?Customer
    {
        $result = $this->fetch($id, 'id');
        if ($result === null) return null;
        return new customer(
            $result["id"],
            $result["name"],
            $result["email"]
        );
    }
    public function insertCustomer(Customer $customer): int {
        $keyedArray = array(
            "name"=>$customer->getName(),
            "email"=>$customer->getEmail()
        );
        return $this->insert($keyedArray);
    }

    public function updateCustomer(Customer $customer): void {
        $keyedArray = array(
            "id"=>$customer->getId(),
            "name"=>$customer->getName(),
            "email"=>$customer->getEmail()
        );
        $this->update($keyedArray);
    }
}