<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/EmployeController.php';
require_once '../../controllers/DepartementController.php';

requireLogin();
requireRole('admin');

$employes = $employeModel->getAll();
$departements = $departementModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Employés</title>
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
            <li class="nav-item"><a href="gestion_employes.php" class="nav-link active">Employés</a></li>
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
        <h3 class="mb-4">👥 Gestion des Employés</h3>

        <!-- Formulaire d'ajout -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
                <h5 class="mb-3">Ajouter un employé</h5>
                <form method="POST" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                    </div>
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-3">
                        <select name="departement_id" class="form-select" required>
                            <option value="">– Département –</option>
                            <?php foreach ($departements as $dep): ?>
                                <option value="<?= $dep['id'] ?>"><?= $dep['nom'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" name="add_employe" class="btn btn-primary w-100">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des employés -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Liste des employés</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Département</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employes as $emp): ?>
                                <tr>
                                    <form method="POST" class="d-flex flex-wrap gap-2">
                                        <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                                        <td><input type="text" name="nom" class="form-control" value="<?= $emp['nom'] ?>" required></td>
                                        <td><input type="email" name="email" class="form-control" value="<?= $emp['email'] ?>" required></td>
                                        <td>
                                            <select name="departement_id" class="form-select" required>
                                                <?php foreach ($departements as $dep): ?>
                                                    <option value="<?= $dep['id'] ?>" <?= $dep['id'] == $emp['departement_id'] ? 'selected' : '' ?>>
                                                        <?= $dep['nom'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td class="text-end">
                                            <button type="submit" name="edit_employe" class="btn btn-sm btn-outline-primary me-2">Modifier</button>
                                            <a href="?delete_id=<?= $emp['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet employé ?')">Supprimer</a>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($employes)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun employé trouvé.</td>
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
