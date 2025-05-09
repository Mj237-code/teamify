<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/PaieController.php';
requireRole('admin');

$liste = $paieModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Paies</title>
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
            <li class="nav-item"><a href="gestion_conges.php" class="nav-link">Congés</a></li>
            <li class="nav-item"><a href="gestion_paies.php" class="nav-link active">Paies</a></li>
            <li class="nav-item"><a href="gestion_recrutements.php" class="nav-link">Recrutements</a></li>
            <li class="nav-item"><a href="gestion_documents.php" class="nav-link">Documents</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link">Mon profil</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Déconnexion</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="container-fluid py-4 px-5">
        <h3 class="mb-4">💰 Gestion des Paies</h3>

        <!-- Formulaire de paie -->
        <div class="card border-0 shadow-sm mb-4 p-4">
            <h5 class="mb-3">Ajouter un bulletin de paie</h5>
            <form method="POST" class="row g-3">
                <div class="col-md-3">
                    <input type="number" name="employe_id" class="form-control" placeholder="ID Employé" required>
                </div>
                <div class="col-md-3">
                    <input type="month" name="mois" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="salaire" class="form-control" placeholder="Salaire FCFA" required>
                </div>
                <div class="col-md-3 text-end">
                    <button type="submit" name="ajouter_paie" class="btn btn-success w-100">Générer PDF & Enregistrer</button>
                </div>
            </form>
        </div>

        <!-- Liste des paies -->
        <div class="card border-0 shadow-sm p-4">
            <h5 class="mb-3">Historique des bulletins</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Employé</th>
                            <th>Mois</th>
                            <th>Salaire</th>
                            <th>PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($liste as $paie): ?>
                            <tr>
                                <td><?= htmlspecialchars($paie['nom']) ?></td>
                                <td><?= htmlspecialchars($paie['mois']) ?></td>
                                <td><?= number_format($paie['salaire'], 0, ',', ' ') ?> FCFA</td>
                                <td>
                                    <a href="../../controllers/PaieController.php?download_pdf=<?= $paie['id'] ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                                        Télécharger
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($liste)): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Aucun bulletin de paie disponible.</td>
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
