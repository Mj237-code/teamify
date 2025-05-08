<?php
class DocumentModel {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM document ORDER BY date_upload DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByEmploye($employe_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM document WHERE employe_id = ? ORDER BY date_upload DESC");
        $stmt->execute([$employe_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function upload($nom, $type, $fichier, $employe_id) {
        $stmt = $this->pdo->prepare("INSERT INTO document (nom, type, fichier, employe_id, date_upload) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([$nom, $type, $fichier, $employe_id]);
    }
}
