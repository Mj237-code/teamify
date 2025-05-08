<?php
class RecrutementModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT * FROM recrutement
            ORDER BY date_publication DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM recrutements WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($poste, $description, $statut = 'ouvert') {
        $stmt = $this->pdo->prepare("
            INSERT INTO recrutement (poste, description, statut, date_publication)
            VALUES (?, ?, ?, NOW())
        ");
        return $stmt->execute([$poste, $description, $statut]);
    }

    public function update($id, $poste, $description, $statut) {
        $stmt = $this->pdo->prepare("
            UPDATE recrutement 
            SET poste = ?, description = ?, statut = ?
            WHERE id = ?
        ");
        return $stmt->execute([$poste, $description, $statut, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM recrutement WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function countOpen($pdo) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM recrutement WHERE statut = 'ouvert'");
        return $stmt->fetchColumn();
    }

    public static function count($pdo) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM recrutement");
        return $stmt->fetchColumn();
    }
}
