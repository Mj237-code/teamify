<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
requireRole('admin');
require_once '../../controllers/DocumentController.php';

$documents = $docModel->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Documents</title>
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
            <li class="nav-item"><a href="gestion_recrutements.php" class="nav-link">Recrutements</a></li>
            <li class="nav-item"><a href="gestion_documents.php" class="nav-link active">Documents</a></li>
            <li class="nav-item"><a href="profil.php" class="nav-link">Mon profil</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Déconnexion</a></li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="container-fluid py-4 px-5">
        <h3 class="mb-4">📁 Gestion des Documents</h3>

        <!-- Formulaire d'upload -->
        <div class="card border-0 shadow-sm mb-4 p-4">
            <h5 class="mb-3">Uploader un document</h5>
            <form method="POST" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="nom" class="form-control" placeholder="Nom du document" required>
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select" required>
                        <option value="contrat">Contrat</option>
                        <option value="bulletin">Bulletin de salaire</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="employe_id" class="form-control" placeholder="ID Employé" required>
                </div>
                <div class="col-md-3">
                    <input type="file" name="fichier" class="form-control" accept=".pdf,.doc,.docx" required>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" name="upload_doc" class="btn btn-primary">Uploader</button>
                </div>
            </form>
        </div>

        <!-- Liste des documents -->
        <div class="card border-0 shadow-sm p-4">
            <h5 class="mb-3">Documents uploadés</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Employé ID</th>
                            <th>Fichier</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($documents as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars($doc['nom']) ?></td>
                                <td><?= htmlspecialchars($doc['type']) ?></td>
                                <td><?= htmlspecialchars($doc['employe_id']) ?></td>
                                <td><a href="../../uploads/<?= urlencode($doc['fichier']) ?>" class="btn btn-sm btn-outline-primary" target="_blank">Télécharger</a></td>
                                <td><?= htmlspecialchars($doc['date_upload']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($documents)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Aucun document disponible.</td>
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
