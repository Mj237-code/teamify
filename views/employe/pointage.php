<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../controllers/PresenceController.php';

requireLogin();
requireRole('employe');

$presences = $presenceModel->getByEmploye($_SESSION['user_id']);
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Pointage</h2>

<form method="POST">
    <button type="submit" name="pointer">Pointer maintenant</button>
</form>

<hr>

<h3>Historique des pointages</h3>
<table border="1">
    <thead>
        <tr><th>Date</th><th>Heure</th></tr>
    </thead>
    <tbody>
        <?php foreach ($presences as $p): ?>
            <tr>
                <td><?= $p['date_pointage'] ?></td>
                <td><?= $p['heure_pointage'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once '../views/_partials/footer.php'; ?>