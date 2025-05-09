<?php
class DepartementModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM departement ORDER BY nom ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM departements WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom) {
        $stmt = $this->pdo->prepare("INSERT INTO departement (nom) VALUES (?)");
        return $stmt->execute([$nom]);
    }

    public function update($id, $nom) {
        $stmt = $this->pdo->prepare("UPDATE departement SET nom = ? WHERE id = ?");
        return $stmt->execute([$nom, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM departement WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function count($pdo) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM departement");
        return $stmt->fetchColumn();
    }
}
