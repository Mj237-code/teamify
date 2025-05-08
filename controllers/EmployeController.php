<?php
require_once __DIR__ . '/../models/EmployeModel.php';
require_once __DIR__ . '/../models/DepartementModel.php';

$employeModel = new EmployeModel($pdo);
$departementModel = new DepartementModel($pdo);

// Créer
if (isset($_POST['add_employe'])) {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $departement_id = $_POST['departement_id'];

    if (!empty($nom) && !empty($email)) {
        $employeModel->create($nom, $email, $departement_id);
        header("Location: ../views/admin/gestion_employes.php");
        exit();
    }
}

// Modifier
if (isset($_POST['edit_employe'])) {
    $id = $_POST['id'];
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $departement_id = $_POST['departement_id'];

    if (!empty($nom) && !empty($email)) {
        $employeModel->update($id, $nom, $email, $departement_id);
        header("Location: ../views/admin/gestion_employes.php");
        exit();
    }
}

// Supprimer
if (isset($_GET['delete_id'])) {
    $employeModel->delete($_GET['delete_id']);
    header("Location: ../views/admin/gestion_employes.php");
    exit();
}
