<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_once '../../models/EmployeModel.php';

requireLogin();
requireRole('employe');

$employeModel = new EmployeModel($pdo);
$employe = $employeModel->getById($_SESSION['user_id']);
?>
<?php include_once '../views/_partials/head.php'; ?>

<h2>Mon Profil</h2>
<p><strong>Nom :</strong> <?= htmlspecialchars($employe['nom']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($employe['email']) ?></p>
<p><strong>Département :</strong> <?= htmlspecialchars($employe['departement_nom']) ?></p>
<?php include_once '../views/_partials/footer.php'; ?>
