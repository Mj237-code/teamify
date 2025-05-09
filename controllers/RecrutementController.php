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
    $nouveau_statut = $_POST['nouveau_statut'];

    // Récupération des infos du candidat
    $candidat = $recrutementModel->getById($id);
    if ($candidat) {
        $recrutementModel->updateStatut($id, $nouveau_statut);

        // Préparation de l'email
        $to = $candidat['email'];
        $subject = "Mise à jour de votre candidature - Teamify";
        $message = "Bonjour " . htmlspecialchars($candidat['nom']) . ",\n\n";
        $message .= "Votre candidature pour le poste de " . htmlspecialchars($candidat['poste']) . " a été mise à jour.\n";
        $message .= "Statut actuel : " . strtoupper($nouveau_statut) . "\n\n";
        $message .= "Merci pour votre intérêt et à bientôt.\n\nL'équipe RH Teamify";

        $headers = "From: no-reply@teamify.com\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        // Envoi de l'email
        mail($to, $subject, $message, $headers);
    }
}
