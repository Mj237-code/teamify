<?php
require_once __DIR__ . '/../models/PaieModel.php';
$paieModel = new PaieModel($pdo);

if (isset($_POST['ajouter_paie'])) {
    $employe_id = $_POST['employe_id'];
    $mois = $_POST['mois'];
    $salaire = $_POST['salaire'];

    // Génération du fichier PDF
    require_once '../lib/fpdf/fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,"Bulletin de paie");
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,10,"Employé ID: $employe_id", 0, 1);
    $pdf->Cell(0,10,"Mois: $mois", 0, 1);
    $pdf->Cell(0,10,"Salaire: $salaire FCFA", 0, 1);

    $nom_fichier = uniqid('paie_') . '.pdf';
    $chemin = "../uploads/bulletins/" . $nom_fichier;
    $pdf->Output('F', $chemin);

    $paieModel->create($employe_id, $mois, $salaire, $nom_fichier);

    header("Location: ../views/admin/gestion_paies.php");
    exit();
}

if (isset($_GET['download_pdf'])) {
    $id = $_GET['download_pdf'];
    $pdfPath = $paieModel->getPDFPath($id);
    header("Location: ../uploads/bulletins/$pdfPath");
    exit();
}
