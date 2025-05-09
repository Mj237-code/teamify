<?php
require_once __DIR__ . '/../models/DepartementModel.php';

$departementModel = new DepartementModel($pdo);

// Ajouter un département
if (isset($_POST['add_departement'])) {
    $nom = trim($_POST['nom']);
    if (!empty($nom)) {
        $departementModel->create($nom);
        redirect('views/admin/gestion_departements.php');
    } else {
        alert("Nom du département requis", "danger");
    }
}

// Modifier un département
if (isset($_POST['edit_departement'])) {
    $id = $_POST['id'];
    $nom = trim($_POST['nom']);
    if (!empty($nom)) {
        $departementModel->update($id, $nom);
        redirect('views/admin/gestion_departements.php');
    } else {
        alert("Nom du département requis", "danger");
    }
}

// Supprimer un département
if (isset($_GET['delete_id'])) {
    $departementModel->delete($_GET['delete_id']);
    redirect('views/admin/gestion_departements.php');
}
