<?php
class PaieModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT p.*, e.nom FROM paie p JOIN employe e ON p.employe_id = e.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmploye($employe_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM paie WHERE employe_id = ? ORDER BY mois DESC");
        $stmt->execute([$employe_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($employe_id, $mois, $salaire, $fichier_pdf) {
        $stmt = $this->pdo->prepare("INSERT INTO paie (employe_id, mois, salaire, fichier_pdf) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$employe_id, $mois, $salaire, $fichier_pdf]);
    }

    public function getPDFPath($id) {
        $stmt = $this->pdo->prepare("SELECT fichier_pdf FROM paie WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }
}
