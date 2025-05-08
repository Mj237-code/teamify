<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
requireRole('admin');
require_once '../../controllers/DocumentController.php';

$documents = $docModel->getAll();
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Gestion des documents</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="Nom du document" required>
    <select name="type" required>
        <option value="contrat">Contrat</option>
        <option value="bulletin">Bulletin de salaire</option>
    </select>
    <input type="number" name="employe_id" placeholder="ID Employé" required>
    <input type="file" name="fichier" accept=".pdf,.docx,.doc" required>
    <button type="submit" name="upload_doc">Uploader</button>
</form>

<hr>

<h3>Documents uploadés</h3>
<table border="1">
    <tr><th>Nom</th><th>Type</th><th>Employé ID</th><th>Fichier</th><th>Date</th></tr>
    <?php foreach ($documents as $doc): ?>
        <tr>
            <td><?= htmlspecialchars($doc['nom']) ?></td>
            <td><?= $doc['type'] ?></td>
            <td><?= $doc['employe_id'] ?></td>
            <td><a href="../../uploads/<?= $doc['fichier'] ?>" target="_blank">Télécharger</a></td>
            <td><?= $doc['date_upload'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include_once '../views/_partials/footer.php'; ?>
