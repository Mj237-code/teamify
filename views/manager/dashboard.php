<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../models/EmployeModel.php';
require_once '../../models/CongesModel.php';
require_once '../../models/PresenceModel.php';

requireRole('manager');

// Récupération de l'ID du manager
$managerId = $_SESSION['user_id'] ?? null;

// Statistiques dynamiques pour le manager
$monDepartementId = $_SESSION['departement_id'] ?? null;
$nbEmployes = EmployeModel::countByDepartement($pdo, $monDepartementId);
$congesEnAttente = CongesModel::countPendingByManager($pdo, $managerId); // ✅ ici on passe bien le managerId
$tauxPresence = PresenceModel::calculatePresenceRate($pdo, $monDepartementId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-4">👔 Tableau de bord Manager</h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <a href="validation_conges.php" class="btn btn-warning w-100">📅 Valider les congés</a>
        </div>
        <div class="col-md-4">
            <a href="profil.php" class="btn btn-dark w-100">👤 Mon profil</a>
        </div>
        <div class="col-md-4">
            <a href="../../logout.php" class="btn btn-outline-danger w-100">🚪 Déconnexion</a>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="card-title">📊 Statistiques de mon département</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">👥 Employés : <?= $nbEmployes ?></li>
                <li class="list-group-item">📆 Congés en attente : <?= $congesEnAttente ?></li>
                <li class="list-group-item">⏱️ Taux de présence : <?= $tauxPresence ?>%</li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
