<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/CongesController.php';

requireLogin();
requireRole('manager');

$conges = $congesModel->getAll(); // On pourrait filtrer selon équipe du manager
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Validation des Congés</h2>

<table border="1">
    <thead>
        <tr><th>Employé</th><th>Du</th><th>Au</th><th>Motif</th><th>Statut</th><th>Actions</th></tr>
    </thead>
    <tbody>
        <?php foreach ($conges as $c): ?>
        <tr>
            <td><?= $c['employe_nom'] ?></td>
            <td><?= $c['date_debut'] ?></td>
            <td><?= $c['date_fin'] ?></td>
            <td><?= htmlspecialchars($c['motif']) ?></td>
            <td><?= $c['statut'] ?></td>
            <td>
                <?php if ($c['statut'] === 'En attente'): ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="conge_id" value="<?= $c['id'] ?>">
                    <button name="changer_statut" value="Validé">Valider</button>
                    <button name="changer_statut" value="Refusé">Refuser</button>
                </form>
                <?php else: ?>
                    <em><?= $c['statut'] ?></em>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../views/_partials/footer.php'; ?>