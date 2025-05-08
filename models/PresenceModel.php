<?php
class PresenceModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function pointer($employe_id, $date, $heure) {
        $stmt = $this->pdo->prepare("INSERT INTO presence (employe_id, date_pointage, heure_pointage) VALUES (?, ?, ?)");
        return $stmt->execute([$employe_id, $date, $heure]);
    }

    public function getByEmploye($employe_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM presence WHERE employe_id = ? ORDER BY date_pointage DESC");
        $stmt->execute([$employe_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatsByManager() {
        $stmt = $this->pdo->query("
            SELECT e.nom, COUNT(p.id) AS total_pointages
            FROM presences p
            JOIN employes e ON p.employe_id = e.id
            GROUP BY p.employe_id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function calculatePresenceRate($pdo, $departementId) {
        // Nombre total de jours où au moins un employé a pointé dans le département
        $stmt = $pdo->prepare("
            SELECT COUNT(DISTINCT date_pointage) AS total_jours
            FROM presence
            WHERE employe_id IN (SELECT id FROM employe WHERE departement_id = ?)
        ");
        $stmt->execute([$departementId]);
        $totalJours = $stmt->fetchColumn();

        // Nombre total d'employés dans le département
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM employe WHERE departement_id = ?");
        $stmt->execute([$departementId]);
        $nbEmployes = $stmt->fetchColumn();

        // Taux de présence approximatif (nb de pointages / nb_employés * jours)
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM presence 
            WHERE employe_id IN (SELECT id FROM employe WHERE departement_id = ?)
        ");
        $stmt->execute([$departementId]);
        $totalPointages = $stmt->fetchColumn();

        $possiblePointages = $nbEmployes * max($totalJours, 1); // éviter division par 0
        return $possiblePointages ? round(($totalPointages / $possiblePointages) * 100, 2) : 0;
    }

    public function calculatePresenceRateForEmploye($employeId) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) 
            FROM presence 
            WHERE employe_id = ?
        ");
        $stmt->execute([$employeId]);
        $totalPointages = $stmt->fetchColumn();
    
        // Nombre de jours uniques où l'employé aurait pu pointer
        $stmt = $this->pdo->prepare("
            SELECT COUNT(DISTINCT DATE(date_pointage)) 
            FROM presence 
            WHERE employe_id = ?
        ");
        $stmt->execute([$employeId]);
        $joursActifs = $stmt->fetchColumn();
    
        return $joursActifs ? round(($totalPointages / $joursActifs) * 100, 2) : 0;
    }
    
}

