<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Vérifie le rôle autorisé (exemple d'utilisation dans une page : require_role('admin'))
function require_role($role_attendu) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role_attendu) {
        echo "Accès refusé - rôle requis : " . htmlspecialchars($role_attendu);
        exit;
    }
}
?>
