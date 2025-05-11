<?php
class CandidatureModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($nom, $email, $poste, $cv) {
        $stmt = $this->pdo->prepare("
            INSERT INTO candidature (nom, email, poste, cv, statut, date_postulation)
            VALUES (?, ?, ?, ?, 'en attente', NOW())
        ");
        return $stmt->execute([$nom, $email, $poste, $cv]);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM candidature WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStatut($id, $statut) {
        $stmt = $this->pdo->prepare("UPDATE candidature SET statut = ? WHERE id = ?");
        return $stmt->execute([$statut, $id]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM candidature ORDER BY date_postulation DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
