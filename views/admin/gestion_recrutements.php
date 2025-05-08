<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/RecrutementController.php';
requireRole('admin');

$candidatures = $recrutementModel->getAll();
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Gestion des Recrutements</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="Nom complet" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="poste" placeholder="Poste visé" required>
    <input type="file" name="cv" accept=".pdf,.doc,.docx" required>
    <button type="submit" name="postuler">Ajouter Candidat</button>
</form>

<hr>

<h3>Candidatures</h3>
<table border="1">
    <tr><th>Nom</th><th>Email</th><th>Poste</th><th>CV</th><th>Statut</th><th>Action</th></tr>
    <?php foreach ($candidatures as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['nom']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['poste']) ?></td>
            <td><a href="../../uploads/cv/<?= $c['cv'] ?>" target="_blank">Télécharger</a></td>
            <td><?= $c['statut'] ?></td>
            <td>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="candidature_id" value="<?= $c['id'] ?>">
                    <select name="nouveau_statut">
                        <option value="en attente" <?= $c['statut'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
                        <option value="accepté" <?= $c['statut'] == 'accepté' ? 'selected' : '' ?>>Accepté</option>
                        <option value="rejeté" <?= $c['statut'] == 'rejeté' ? 'selected' : '' ?>>Rejeté</option>
                    </select>
                    <button type="submit" name="changer_statut">Valider</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include_once '../views/_partials/footer.php'; ?>
