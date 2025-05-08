<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/CongesController.php';

requireLogin();
requireRole('admin');

$conges = $congesModel->getAll();
?>


<h2>Liste des Congés (Admin)</h2>
<?php include_once '../views/_partials/head.php'; ?>

<table border="1">
    <thead>
        <tr><th>Employé</th><th>Du</th><th>Au</th><th>Motif</th><th>Statut</th></tr>
    </thead>
    <tbody>
        <?php foreach ($conges as $c): ?>
        <tr>
            <td><?= $c['employe_nom'] ?></td>
            <td><?= $c['date_debut'] ?></td>
            <td><?= $c['date_fin'] ?></td>
            <td><?= htmlspecialchars($c['motif']) ?></td>
            <td><?= $c['statut'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../views/_partials/footer.php'; ?>
