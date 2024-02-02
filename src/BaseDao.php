<?php

class BaseDao
{
    protected Database $database;
    protected string $_tableName;
    protected string $_primaryKey;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function fetch($value, $key = NULL): ?array
    {
        if (is_null($key)) $key = $this->_primaryKey;

        $sql = "SELECT * FROM {$this->_tableName} WHERE {$key}='{$value}'";
        $stmt = $this->database->getMysqli()->prepare($sql);
		$rows = array();
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            $stmt->close();
            return null;
        }
        while ($result->fetch_assoc()) {
            $rows[] = $result;
        }
        $stmt->close();
		return $rows;
	}

    public function fetchAll(): ?array{
        $sql = "SELECT * FROM {$this->_tableName}";
        $stmt = $this->database->getMysqli()->prepare($sql);
        $rows = array();
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            $stmt->close();
            return null;
        }
        while ($result->fetch_assoc()) {
            $rows[] = $result;
        }
        $stmt->close();
        return $rows;
    }
    public function update($keyedArray): void
    {
        $sql = "UPDATE {$this->_tableName} SET ";
        $updates = array();

        foreach ($keyedArray as $column=>$value) {
            $updates[] = "{$column}='{$value}'";
        }

        $sql .= implode(',', $updates);
        $sql .= " WHERE {$this->_primaryKey}='{$keyedArray[$this->_primaryKey]}'";
        $stmt = $this->database->getMysqli()->prepare($sql);
        $stmt->execute();
        $stmt->close();
    }

    public function insert($keyedArray): int
    {
        $sql = "INSERT INTO {$this->_tableName} (";
        $insert = array();
        $values = array();

        foreach ($keyedArray as $column=>$value) {
            $insert[]=$column;
            $values[] = $value;
        }

        $sql .= implode(',',  $insert);
        $sql .= ") VALUES (";
        $sql .= implode(',',  $values);
        $sql .= ") ";
        $stmt = $this->database->getMysqli()->prepare($sql);
        $stmt->execute();
        $insertedId = $stmt->insert_id;
        $stmt->close();
        return $insertedId;
    }
}