<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/CongesController.php';

requireLogin();
requireRole('employe');

$conges = $congesModel->getByEmploye($_SESSION['user_id']);
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Mes Congés</h2>

<form method="POST">
    <label>Du : <input type="date" name="date_debut" required></label>
    <label>Au : <input type="date" name="date_fin" required></label>
    <input type="text" name="motif" placeholder="Motif" required>
    <button type="submit" name="demander_conge">Demander</button>
</form>

<hr>

<table border="1">
    <thead>
        <tr><th>Début</th><th>Fin</th><th>Motif</th><th>Statut</th></tr>
    </thead>
    <tbody>
        <?php foreach ($conges as $c): ?>
            <tr>
                <td><?= $c['date_debut'] ?></td>
                <td><?= $c['date_fin'] ?></td>
                <td><?= htmlspecialchars($c['motif']) ?></td>
                <td><?= $c['statut'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../views/_partials/footer.php'; ?>