<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/EmployeController.php';

requireLogin();
requireRole('admin');

$employes = $employeModel->getAll();
$departements = $departementModel->getAll();
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Gestion des Employés</h2>

<form method="POST">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="departement_id" required>
        <option value="">-- Département --</option>
        <?php foreach ($departements as $dep): ?>
            <option value="<?= $dep['id'] ?>"><?= $dep['nom'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" name="add_employe">Ajouter</button>
</form>

<hr>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Département</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employes as $emp): ?>
        <tr>
            <form method="POST">
                <td><input type="text" name="nom" value="<?= $emp['nom'] ?>" required></td>
                <td><input type="email" name="email" value="<?= $emp['email'] ?>" required></td>
                <td>
                    <select name="departement_id" required>
                        <?php foreach ($departements as $dep): ?>
                            <option value="<?= $dep['id'] ?>" <?= $dep['id'] == $emp['departement_id'] ? 'selected' : '' ?>>
                                <?= $dep['nom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                    <button type="submit" name="edit_employe">Modifier</button>
                    <a href="?delete_id=<?= $emp['id'] ?>" onclick="return confirm('Supprimer cet employé ?')">Supprimer</a>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../views/_partials/footer.php'; ?>
