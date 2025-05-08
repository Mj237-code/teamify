<?php
ob_start();
session_start();

require_once '../includes/config.php';
require_once '../models/UserModel.php';

$userModel = new UserModel($pdo);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'employe'; // par défaut, on inscrit comme employé

    // Vérifier si l'email existe déjà
    $existingUser = $userModel->getByEmail($email);
    if ($existingUser) {
        $message = "<div class='alert alert-warning'>Cet email est déjà utilisé.</div>";
    } else {
        $created = $userModel->create($nom, $email, $password, $role);
        if ($created) {
            $message = "<div class='alert alert-success'>Inscription réussie. Vous pouvez maintenant vous connecter.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Une erreur s'est produite lors de l'inscription.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Teamify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Créer un compte</h2>

    <?= $message ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Adresse e-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Rôle</label>
            <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="employe">Employé</option>
                <option value="manager">Manager</option>
            </select>
        </div>
        
        <button class="btn btn-primary" type="submit">S'inscrire</button>
    </form>
    <p class="mt-3">Déjà inscrit ? <a href="login.php">Se connecter</a></p>
</div>

</body>
</html>
<?php ob_end_flush(); ?>
