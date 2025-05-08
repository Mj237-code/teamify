<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../models/EmployeModel.php';
require_once '../../models/DepartementModel.php';
require_once '../../models/CongesModel.php';
require_once '../../models/RecrutementModel.php';
requireRole('admin');

// Statistiques dynamiques
$totalEmployes = EmployeModel::count($pdo);
$totalDepartements = DepartementModel::count($pdo);
$congesEnAttente = CongesModel::countPending($pdo);
$postesOuverts = RecrutementModel::countOpen($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-4">🛠️ Tableau de bord Administrateur</h1>

    <div class="row g-3">
        <div class="col-md-3">
            <a href="gestion_employes.php" class="btn btn-outline-primary w-100">👥 Gérer les employés</a>
        </div>
        <div class="col-md-3">
            <a href="gestion_departements.php" class="btn btn-outline-secondary w-100">🏢 Gérer les départements</a>
        </div>
        <div class="col-md-3">
            <a href="gestion_conges.php" class="btn btn-outline-warning w-100">📅 Gérer les congés</a>
        </div>
        <div class="col-md-3">
            <a href="gestion_paies.php" class="btn btn-outline-success w-100">💸 Gérer les paies</a>
        </div>
        <div class="col-md-3">
            <a href="gestion_recrutements.php" class="btn btn-outline-dark w-100">📄 Gérer les recrutements</a>
        </div>
        <div class="col-md-3">
            <a href="gestion_documents.php" class="btn btn-outline-info w-100">📂 Gérer les documents</a>
        </div>
        <div class="col-md-3">
            <a href="profil.php" class="btn btn-outline-primary w-100">👤 Mon profil</a>
        </div>
        <div class="col-md-3">
            <a href="logout.php" class="btn btn-outline-danger w-100">🚪 Déconnexion</a>
        </div>
    </div>

    <div class="card shadow-sm mt-5">
        <div class="card-body">
            <h5 class="card-title">📊 Statistiques</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">👥 Employés : <?= $totalEmployes ?></li>
                <li class="list-group-item">🏢 Départements : <?= $totalDepartements ?></li>
                <li class="list-group-item">📅 Congés en attente : <?= $congesEnAttente ?></li>
                <li class="list-group-item">💼 Postes ouverts : <?= $postesOuverts ?></li>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
