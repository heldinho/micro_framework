<?php

namespace Core;

use PDO;

abstract class BaseModel {

    private $pdo;
    protected $table;
    protected $nome;
    protected $email;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function All() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function find($id) {
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

    public function Inserir($id, $nome, $email) {
        $query = "INSERT INTO {$this->table} (id, nome, email) VALUES ('{$id}', '{$nome}', '{$email}')";
        $stmt = $this->pdo->prepare($query);
        if ($stmt->execute()) {
            $result = true;
        } else {
            $result = false;
        }
        $stmt->closeCursor();
        return $result;
    }

}
