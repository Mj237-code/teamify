<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../models/CongesModel.php';
require_once '../../models/PresenceModel.php';
requireRole('employe');

$employeId = $_SESSION['user_id'] ?? null;

// Statistiques dynamiques
$congesModel = new CongesModel($pdo);
$nbConges = $congesModel->countByEmploye($employeId);

$presenceModel = new PresenceModel($pdo);
$tauxPresence = $presenceModel->calculatePresenceRateForEmploye($employeId);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-4">🙋 Tableau de bord Employé</h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <a href="pointage.php" class="btn btn-primary w-100">🕘 Pointage</a>
        </div>
        <div class="col-md-4">
            <a href="mes_conges.php" class="btn btn-warning w-100">📅 Mes congés</a>
        </div>
        <div class="col-md-4">
            <a href="mon_salaire.php" class="btn btn-success w-100">💸 Mon salaire</a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <a href="profil.php" class="btn btn-dark w-100">👤 Mon profil</a>
        </div>
        <div class="col-md-6">
            <a href="../../logout.php" class="btn btn-outline-danger w-100">🚪 Déconnexion</a>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="card-title">📊 Mes statistiques</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">📅 Nombre de congés pris : <?= $nbConges ?></li>
                <li class="list-group-item">⏱️ Taux de présence : <?= $tauxPresence ?>%</li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
