<?php
require_once __DIR__ . '/../models/DocumentModel.php';
$docModel = new DocumentModel($pdo);

if (isset($_POST['upload_doc'])) {
    $nom = $_POST['nom'];
    $type = $_POST['type']; // contrat, bulletin, etc.
    $employe_id = $_POST['employe_id'];

    $file_name = uniqid() . '_' . $_FILES['fichier']['name'];
    $tmp_path = $_FILES['fichier']['tmp_name'];
    $dest_path = "../uploads/" . $file_name;

    if (move_uploaded_file($tmp_path, $dest_path)) {
        $docModel->upload($nom, $type, $file_name, $employe_id);
        header("Location: ../views/admin/gestion_documents.php?success=1");
        exit();
    } else {
        header("Location: ../views/admin/gestion_documents.php?error=1");
        exit();
    }
}
