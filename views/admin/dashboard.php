<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../models/EmployeModel.php';
require_once '../../models/DepartementModel.php';
require_once '../../models/CongesModel.php';
require_once '../../models/RecrutementModel.php';
requireRole('admin');

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
    <link href="/teamify/assets/css/style.css" rel="stylesheet"> <!-- ton CSS personnalisé -->
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 vh-100" style="width: 220px;">
        <h4 class="mb-4">Teamify</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link active">Dashboard</a></li>
            <li class="nav-item"><a href="gestion_employes.php" class="nav-link">Employés</a></li>
            <li class="nav-item"><a href="gestion_departements.php" class="nav-link">Départements</a></li>
            <li class="nav-item"><a href="gestion_conges.php" class="nav-link">Congés</a></li>
            <li class="nav-item"><a href="gestion_paies.php" class="nav-link">Paies</a></li>
            <li class="nav-item"><a href="gestion_recrutements.php" class="nav-link">Recrutements</a></li>
            <li class="nav-item"><a href="gestion_documents.php" class="nav-link">Documents</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link">Mon profil</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Déconnexion</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="container-fluid py-4 px-5">
        <h3 class="mb-4">🛠️ Tableau de bord Administrateur</h3>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">👥 Employés</h5>
                        <p class="card-text fs-4"><?= $totalEmployes ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">🏢 Départements</h5>
                        <p class="card-text fs-4"><?= $totalDepartements ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">📅 Congés en attente</h5>
                        <p class="card-text fs-4"><?= $congesEnAttente ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">💼 Postes ouverts</h5>
                        <p class="card-text fs-4"><?= $postesOuverts ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
