<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../models/PaieModel.php';
requireRole('employe');

$paieModel = new PaieModel($pdo);
$mes_paie = $paieModel->getByEmploye($_SESSION['user_id']);
?>
<?php include_once '../views/_partials/head.php'; ?>


<h2>Mes bulletins de salaire</h2>

<table border="1">
    <tr><th>Mois</th><th>Salaire</th><th>PDF</th></tr>
    <?php foreach ($mes_paie as $p): ?>
        <tr>
            <td><?= $p['mois'] ?></td>
            <td><?= $p['salaire'] ?> FCFA</td>
            <td><a href="../../uploads/bulletins/<?= $p['fichier_pdf'] ?>" target="_blank">Télécharger</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php include_once '../views/_partials/footer.php'; ?>