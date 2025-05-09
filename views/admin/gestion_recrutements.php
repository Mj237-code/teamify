<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/RecrutementController.php';
requireRole('admin');

$candidatures = $recrutementModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Recrutements</title>
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
            <li class="nav-item"><a href="gestion_paies.php" class="nav-link">Paies</a></li>
            <li class="nav-item"><a href="gestion_documents.php" class="nav-link">Documents</a></li>
            <li class="nav-item"><a href="gestion_recrutements.php" class="nav-link active">Recrutements</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link">Mon profil</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Déconnexion</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="container-fluid py-4 px-5">
        <h3 class="mb-4">📋 Gestion des Recrutements</h3>

        <!-- Formulaire ajout candidat -->
        <div class="card border-0 shadow-sm mb-4 p-4">
            <h5 class="mb-3">Ajouter un(e) candidat(e)</h5>
            <form method="POST" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="nom" class="form-control" placeholder="Nom complet" required>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="poste" class="form-control" placeholder="Poste visé" required>
                </div>
                <div class="col-md-3">
                    <input type="file" name="cv" accept=".pdf,.doc,.docx" class="form-control" required>
                </div>
                <div class="col-md-12 text-end">
                    <button type="submit" name="postuler" class="btn btn-primary">Ajouter Candidat</button>
                </div>
            </form>
        </div>

        <!-- Liste des candidatures -->
        <div class="card border-0 shadow-sm p-4">
            <h5 class="mb-3">Candidatures reçues</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Poste</th>
                            <th>CV</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidatures as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['nom']) ?></td>
                                <td><?= htmlspecialchars($c['email']) ?></td>
                                <td><?= htmlspecialchars($c['poste']) ?></td>
                                <td>
                                    <a href="../../uploads/cv/<?= htmlspecialchars($c['cv']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                        Télécharger
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $c['statut'] == 'accepté' ? 'success' : ($c['statut'] == 'rejeté' ? 'danger' : 'warning') ?>">
                                        <?= ucfirst($c['statut']) ?>
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" class="d-flex gap-2 align-items-center">
                                        <input type="hidden" name="candidature_id" value="<?= $c['id'] ?>">
                                        <select name="nouveau_statut" class="form-select form-select-sm" required>
                                            <option value="en attente" <?= $c['statut'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
                                            <option value="accepté" <?= $c['statut'] == 'accepté' ? 'selected' : '' ?>>Accepté</option>
                                            <option value="rejeté" <?= $c['statut'] == 'rejeté' ? 'selected' : '' ?>>Rejeté</option>
                                        </select>
                                        <button type="submit" name="changer_statut" class="btn btn-sm btn-success">Valider</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($candidatures)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucune candidature reçue.</td>
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
