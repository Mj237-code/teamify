<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../includes/functions.php';
require_once '../../controllers/DepartementController.php';

requireLogin();
requireRole('admin');

$departements = $departementModel->getAll();
?>
<?php include_once '../views/_partials/head.php'; ?>


<h1>Départements</h1>

<!-- Ajouter un département -->
<form method="POST" class="mb-4">
    <input type="text" name="nom" placeholder="Nom du département" required>
    <button type="submit" name="add_departement">Ajouter</button>
</form>

<!-- Liste des départements -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($departements as $dep): ?>
        <tr>
            <td><?= $dep['id'] ?></td>
            <td><?= $dep['nom'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $dep['id'] ?>">
                    <input type="text" name="nom" value="<?= $dep['nom'] ?>" required>
                    <button type="submit" name="edit_departement">Modifier</button>
                </form>
                <a href="?delete_id=<?= $dep['id'] ?>" onclick="return confirm('Supprimer ce département ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include_once '../views/_partials/footer.php'; ?>
