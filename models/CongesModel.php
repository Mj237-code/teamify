<?php
class CongesModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM conge");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM conge WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmploye($employeId) {
        $stmt = $this->pdo->prepare("SELECT * FROM conge WHERE employe_id = ?");
        $stmt->execute([$employeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($employeId, $dateDebut, $dateFin, $motif) {
        $stmt = $this->pdo->prepare("INSERT INTO conge (employe_id, date_debut, date_fin, motif, statut) VALUES (?, ?, ?, ?, 'en attente')");
        return $stmt->execute([$employeId, $dateDebut, $dateFin, $motif]);
    }

    public function updateStatut($id, $statut) {
        $stmt = $this->pdo->prepare("UPDATE conge SET statut = ? WHERE id = ?");
        return $stmt->execute([$statut, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM conge WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function countByEmploye($employeId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM conge WHERE employe_id = ?");
        $stmt->execute([$employeId]);
        return $stmt->fetchColumn();
    }

    public static function countPending($pdo) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM conge WHERE statut = 'en attente'");
        return $stmt->fetchColumn();
    }

    public static function countPendingByManager($pdo, $managerId) {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM conge 
            WHERE statut = 'en attente'
              AND employe_id IN (
                SELECT id 
                FROM employe 
                WHERE departement_id = (
                    SELECT departement_id 
                    FROM employe 
                    WHERE id = ?
                )
            )
        ");
        $stmt->execute([$managerId]);
        return $stmt->fetchColumn();
    }
}
