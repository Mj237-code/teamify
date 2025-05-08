<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Récupère le rôle de l'utilisateur connecté
function getUserRole() {
    return $_SESSION['user_role'] ?? null;  // <-- corrigé ici (avant c'était 'role')
}

// Redirige vers la page de login si non connecté
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /teamify/views/login.php");
        exit();
    }
}

// Vérifie si l'utilisateur a un rôle spécifique
function requireRole($role) {
    requireLogin();
    if (getUserRole() !== $role) {
        header("Location: /teamify/views/error.php?error=unauthorized");
        exit();
    }
}

// Vérifie si l'utilisateur a l'un des rôles autorisés
function requireAnyRole(array $roles) {
    requireLogin();
    if (!in_array(getUserRole(), $roles)) {
        header("Location: /teamify/views/error.php?error=unauthorized");
        exit();
    }
}
