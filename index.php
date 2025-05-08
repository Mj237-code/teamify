<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/auth.php';

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    // Redirection selon le rôle
    switch ($_SESSION['role']) {
        case 'admin':
            header('Location: views/admin/dashboard.php');
            exit;
        case 'manager':
            header('Location: views/manager/dashboard.php');
            exit;
        case 'employe':
            header('Location: views/employe/dashboard.php');
            exit;
        default:
            // Rôle inconnu : déconnexion de sécurité
            session_destroy();
            header('Location: views/login.php');
            exit;
    }
} else {
    // Non connecté, redirige vers la page de connexion
    header('Location: views/login.php');
    exit;
}
