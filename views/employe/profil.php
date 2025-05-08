<?php
require_once '../../models/DocumentModel.php';
$docModel = new DocumentModel($pdo);
$mesDocs = $docModel->getByEmploye($_SESSION['user_id']);
?>
<?php include_once '../views/_partials/head.php'; ?>


<h3>Mes documents</h3>
<ul>
    <?php foreach ($mesDocs as $doc): ?>
        <li><?= $doc['nom'] ?> (<?= $doc['type'] ?>) - <a href="../../uploads/<?= $doc['fichier'] ?>">Voir</a></li>
    <?php endforeach; ?>
</ul>
<?php include_once '../views/_partials/footer.php'; ?>