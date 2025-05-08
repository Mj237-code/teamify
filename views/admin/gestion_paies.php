<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/PaieController.php';
requireRole('admin');

$liste = $paieModel->getAll();
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Gestion des Paies</h2>

<form method="POST">
    <input type="number" name="employe_id" placeholder="ID Employé" required>
    <input type="month" name="mois" required>
    <input type="number" name="salaire" placeholder="Salaire FCFA" required>
    <button type="submit" name="ajouter_paie">Générer PDF & Enregistrer</button>
</form>

<hr>

<h3>Historique des bulletins</h3>
<table border="1">
    <tr><th>Employé</th><th>Mois</th><th>Salaire</th><th>PDF</th></tr>
    <?php foreach ($liste as $paie): ?>
        <tr>
            <td><?= htmlspecialchars($paie['nom']) ?></td>
            <td><?= $paie['mois'] ?></td>
            <td><?= $paie['salaire'] ?> FCFA</td>
            <td><a href="../../controllers/PaieController.php?download_pdf=<?= $paie['id'] ?>" target="_blank">Télécharger</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include_once '../views/_partials/footer.php'; ?>
