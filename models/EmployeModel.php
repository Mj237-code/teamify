<?php
class EmployeModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT e.*, d.nom AS departement_nom
            FROM employe e
            JOIN departement d ON e.departement_id = d.id
            ORDER BY e.nom ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("
            SELECT e.*, d.nom AS departement_nom
            FROM employe e
            JOIN departement d ON e.departement_id = d.id
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom, $email, $departement_id) {
        $stmt = $this->pdo->prepare("INSERT INTO employe (nom, email, departement_id) VALUES (?, ?, ?)");
        return $stmt->execute([$nom, $email, $departement_id]);
    }

    public function update($id, $nom, $email, $departement_id) {
        $stmt = $this->pdo->prepare("UPDATE employe SET nom = ?, email = ?, departement_id = ? WHERE id = ?");
        return $stmt->execute([$nom, $email, $departement_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM employe WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByDepartement($departement_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM employe WHERE departement_id = ?");
        $stmt->execute([$departement_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function count($pdo) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM employe");
        return $stmt->fetchColumn();
    }

    public static function countByDepartement($pdo, $departementId) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM employe WHERE departement_id = ?");
        $stmt->execute([$departementId]);
        return $stmt->fetchColumn();
    }
}
