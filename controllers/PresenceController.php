<?php
require_once __DIR__ . '/../models/PresenceModel.php';

$presenceModel = new PresenceModel($pdo);

// Pointer (employé)
if (isset($_POST['pointer'])) {
    $employe_id = $_SESSION['user_id'];
    $date = date('Y-m-d');
    $heure = date('H:i:s');

    $presenceModel->pointer($employe_id, $date, $heure);
    header("Location: ../views/employe/pointage.php");
    exit();
}
