<?php

class CustomerRepository extends BaseDao
{
    protected string $_tableName    = 'customer';
    protected string $_primaryKey   = 'id';

    public function selectByID(int $id) : ?Customer {
        $results = $this->fetch($id);

        if ($results === null) return null;

        $result = $results[0];

        return new customer(
            $result["id"],
            $result["name"],
            $result["email"]
        );
    }

    public function insertCustomer(Customer $customer): int {
        $keyedArray = array(
            "name"  => "'" . $customer->getName() . "'",
            "email" => "'" . $customer->getEmail() . "'"
        );

        return $this->insert($keyedArray);
    }

    public function updateCustomer(Customer $customer): void {
        $keyedArray = array(
            "id"    => $customer->getId(),
            "name"  => $customer->getName(),
            "email" => $customer->getEmail()
        );

        $this->update($keyedArray);
    }

	public function selectByEmail(string $email) : ?Customer {
        $query      = "SELECT * FROM {$this->_tableName} WHERE email = ?";
        $results    = $this->query($query, [$email]);

        if ($results === null) return null;

        $result = $results[0];

        return new Customer(
            $result["id"],
            $result["name"],
            $result["email"]
        );
    }
}