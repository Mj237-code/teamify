<?php
require_once __DIR__ . '/../models/CongesModel.php';

$congesModel = new CongesModel($pdo);

// Demande de congé (employé)
if (isset($_POST['demander_conge'])) {
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $motif = $_POST['motif'];
    $employe_id = $_SESSION['user_id'];

    $congesModel->create($employe_id, $date_debut, $date_fin, $motif);
    header("Location: ../views/employe/mes_conges.php");
    exit();
}

// Validation / refus (manager)
if (isset($_POST['changer_statut'])) {
    $id = $_POST['conge_id'];
    $statut = $_POST['statut']; // "Validé" ou "Refusé"
    $congesModel->updateStatut($id, $statut);
    header("Location: ../views/manager/validation_conges.php");
    exit();
}
