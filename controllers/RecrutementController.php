<?php
require_once __DIR__ . '/../models/RecrutementModel.php';
$recrutementModel = new RecrutementModel($pdo);

// Création d'une nouvelle candidature
if (isset($_POST['postuler'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $poste = $_POST['poste'];

    // Gérer l’upload
    $cv_nom = uniqid() . '_' . $_FILES['cv']['name'];
    $cv_tmp = $_FILES['cv']['tmp_name'];
    $cv_path = "../uploads/cv/" . $cv_nom;
    move_uploaded_file($cv_tmp, $cv_path);

    $recrutementModel->create($nom, $email, $poste, $cv_nom);

    header("Location: ../views/admin/gestion_recrutements.php");
    exit();
}

// Mise à jour du statut
if (isset($_POST['changer_statut'])) {
    $id = $_POST['candidature_id'];
    $statut = $_POST['nouveau_statut'];
    $recrutementModel->updateStatut($id, $statut);
    header("Location: ../views/admin/gestion_recrutements.php");
    exit();
}
