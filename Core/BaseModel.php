<?php

namespace Core;

use PDO;

abstract class BaseModel
{

    protected $table;
    protected $nome;
    protected $email;
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function All()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function inserir(array $data)
    {
        $data = $this->prepareDataInsert($data);
        $query = "INSERT INTO {$this->table} ({$data[0]}) VALUES ({$data[1]})";
        $stmt = $this->pdo->prepare($query);
        for ($i = 0; $i < count($data[2]); $i++) {
            $stmt->bindValue("{$data[2][$i]}", $data[3][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    private function prepareDataInsert(array $data)
    {
        $strKeys = "";
        $strBinds = "";
        $binds = [];
        $values = [];

        foreach ($data as $key => $value) {
            $strKeys = "{$strKeys},{$key}";
            $strBinds = "{$strBinds},:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeys = substr($strKeys, 1);
        $strBinds = substr($strBinds, 1);
        return [$strKeys, $strBinds, $binds, $values];
    }

    public function update(array $data, array $id)
    {
        $data = $this->prepareDataUpdate($data, $id);
        $query = "UPDATE {$this->table} SET {$data[0]} WHERE {$data[3]}";
        $stmt = $this->pdo->prepare($query);
        for ($i = 0; $i < count($data[4]); $i++) {
            $stmt->bindValue("{$data[4][$i]}", $data[5][$i]);
        }
        //$stmt->bindValue(":id", $id);
        for ($i = 0; $i < count($data[1]); $i++) {
            $stmt->bindValue("{$data[1][$i]}", $data[2][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    private function prepareDataUpdate(array $data, array $id)
    {
        $strKeysBinds = "";
        $strKeysBindsWhere = "";
        $bindsWhere = [];
        $valuesWhere = [];
        $binds = [];
        $values = [];

        foreach ($id as $key => $value) {
            $strKeysBindsWhere = "{$key}=:{$key}";
            $bindsWhere[] = ":{$key}";
            $valuesWhere[] = $value;
        }

        foreach ($data as $key => $value) {
            $strKeysBinds = "{$strKeysBinds}, {$key}=:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeysBinds = substr($strKeysBinds, 1);
        return [$strKeysBinds, $binds, $values, $strKeysBindsWhere, $bindsWhere, $valuesWhere];
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

}
