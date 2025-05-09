<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/CongesController.php';

requireLogin();
requireRole('admin');

$conges = $congesModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Congés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/teamify/assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 vh-100" style="width: 220px;">
        <h4 class="mb-4">Teamify</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="dashboard.php" class="nav-link text-white">Dashboard</a></li>
            <li class="nav-item"><a href="gestion_employes.php" class="nav-link">Employés</a></li>
            <li class="nav-item"><a href="gestion_departements.php" class="nav-link">Départements</a></li>
            <li class="nav-item"><a href="gestion_conges.php" class="nav-link active">Congés</a></li>
            <li class="nav-item"><a href="gestion_paies.php" class="nav-link">Paies</a></li>
            <li class="nav-item"><a href="gestion_recrutements.php" class="nav-link">Recrutements</a></li>
            <li class="nav-item"><a href="gestion_documents.php" class="nav-link">Documents</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link">Mon profil</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Déconnexion</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="container-fluid py-4 px-5">
        <h3 class="mb-4">🌴 Gestion des Congés</h3>

        <!-- Liste des congés -->
        <div class="card shadow-sm border-0 p-4">
            <h5 class="mb-3">Liste des congés</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Employé</th>
                            <th>Du</th>
                            <th>Au</th>
                            <th>Motif</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($conges as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['employe_nom']) ?></td>
                                <td><?= htmlspecialchars($c['date_debut']) ?></td>
                                <td><?= htmlspecialchars($c['date_fin']) ?></td>
                                <td><?= htmlspecialchars($c['motif']) ?></td>
                                <td><?= htmlspecialchars($c['statut']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($conges)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Aucun congé enregistré.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
