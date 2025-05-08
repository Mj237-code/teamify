<?php
require_once '../includes/session.php';
require_role('rh');
require_once '../includes/config.php';

// Employés actifs
$stmt1 = $pdo->query("SELECT COUNT(*) FROM employes WHERE statut = 'actif'");
$employesActifs = $stmt1->fetchColumn();

// Congés à valider
$stmt2 = $pdo->query("SELECT COUNT(*) FROM conges WHERE statut = 'en_attente'");
$congesEnAttente = $stmt2->fetchColumn();

// Candidatures reçues
$stmt3 = $pdo->query("SELECT COUNT(*) FROM recrutements");
$candidatures = $stmt3->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard RH</title>
</head>
<body>
    <h1>Tableau de bord - RH</h1>
    <p>Bonjour <?= htmlspecialchars($_SESSION['nom']); ?> !</p>

    <div>
        <h3>Statistiques RH</h3>
        <ul>
            <li>Employés actifs : <?= $employesActifs ?></li>
            <li>Congés à valider : <?= $congesEnAttente ?></li>
            <li>Candidatures reçues : <?= $candidatures ?></li>
        </ul>
    </div>

    <a href="../logout.php">Déconnexion</a>
</body>
</html>
