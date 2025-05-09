<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../includes/functions.php';
require_once '../../controllers/DepartementController.php';

requireLogin();
requireRole('admin');

$departements = $departementModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Départements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/teamify/assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3 vh-100" style="width: 220px;">
        <h4 class="mb-4">Teamify</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="gestion_employes.php" class="nav-link">Employés</a></li>
            <li class="nav-item"><a href="gestion_departements.php" class="nav-link active">Départements</a></li>
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
        <h3 class="mb-4">🏢 Gestion des Départements</h3>

        <!-- Formulaire d'ajout -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
                <h5 class="mb-3">Ajouter un département</h5>
                <form method="POST" class="row g-3">
                    <div class="col-md-9">
                        <input type="text" name="nom" class="form-control" placeholder="Nom du département" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="add_departement" class="btn btn-primary w-100">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des départements -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Liste des départements</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departements as $dep): ?>
                                <tr>
                                    <td>
                                        <form method="POST" class="d-flex gap-2">
                                            <input type="hidden" name="id" value="<?= $dep['id'] ?>">
                                            <input type="text" name="nom" class="form-control" value="<?= $dep['nom'] ?>" required>
                                    </td>
                                    <td class="text-end">
                                            <button type="submit" name="edit_departement" class="btn btn-sm btn-outline-primary me-2">Modifier</button>
                                            <a href="?delete_id=<?= $dep['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce département ?')">Supprimer</a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($departements)): ?>
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Aucun département trouvé.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
