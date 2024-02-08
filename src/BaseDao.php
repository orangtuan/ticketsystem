<?php

class BaseDao
{
    protected Database  $database;
    protected string    $_tableName;
    protected string    $_primaryKey;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function fetch($value, $key = NULL): ?array {
        if (is_null($key)) $key = $this->_primaryKey;

        $sql    = "SELECT * FROM {$this->_tableName} WHERE {$key}={$value}";
        $stmt   = $this->database->getMysqli()->prepare($sql);

        if ($stmt === false) return null;

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            $stmt->close();
            return null;
        }

        $rows = array();

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $stmt->close();

		return $rows;
	}

    public function fetchAll(): ?array {
        $sql = "SELECT * FROM {$this->_tableName}";

        $stmt = $this->database->getMysqli()->prepare($sql);

        if ($stmt === false) return null;

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            $stmt->close();
            return null;
        }

        $rows = array();

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $stmt->close();

        return $rows;
    }

    public function update($keyedArray): void {
        $primaryKeyValue = $keyedArray[$this->_primaryKey];
        unset($keyedArray[$this->_primaryKey]);

        $sql = "UPDATE {$this->_tableName} SET ";

        $updates = array();

        foreach ($keyedArray as $column=>$value) {
            $updates[] = "{$column}='{$value}'";
        }

        $sql .= implode(',', $updates);
        $sql .= " WHERE {$this->_primaryKey}='{$primaryKeyValue}'";
        echo $sql;

        $stmt = $this->database->getMysqli()->prepare($sql);
        $stmt->execute();
        $stmt->close();
    }

    public function insert($keyedArray): int {
        $sql    = "INSERT INTO {$this->_tableName} (";
        $insert = array();
        $values = array();

        foreach ($keyedArray as $column=>$value) {
            $insert[]   = $column;
            $values[]   = $value;
        }

        $sql .= implode(', ',  $insert);
        $sql .= ") VALUES (";
        $sql .= implode(', ',  $values);
        $sql .= ") ";

        $stmt = $this->database->getMysqli()->prepare($sql);
        $stmt->execute();
        $insertedId = $stmt->insert_id;
        $stmt->close();

        return $insertedId;
    }

    public function delete($id): void {
        $sql = "DELETE FROM {$this->_tableName} WHERE {$this->_primaryKey} = " . $id;

        $stmt = $this->database->getMysqli()->prepare($sql);
        $stmt->execute();
        $stmt->close();
    }

    public function query(string $query, array $params = []): ?array {
        $stmt = $this->database->getMysqli()->prepare($query);

        if ($stmt === false) return null;

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result === false || $result->num_rows === 0) {
            $stmt->close();
            return null;
        }

        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $stmt->close();

        return $rows;
    }
}