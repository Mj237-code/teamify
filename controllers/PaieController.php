<?php
// Inclusion de la configuration PDO
require_once __DIR__ . '/../includes/config.php'; // Corrigé ici
require_once __DIR__ . '/../models/PaieModel.php';
require_once __DIR__ . '/../lib/tcpdf/tcpdf.php'; // Assure-toi que ce chemin est correct

$paieModel = new PaieModel($pdo);

if (isset($_POST['ajouter_paie'])) {
    $employe_id = $_POST['employe_id'];
    $mois = $_POST['mois'];
    $salaire = $_POST['salaire'];

    // Création du PDF avec TCPDF
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor("Teamify RH");
    $pdf->SetTitle("Bulletin de paie");
    $pdf->SetMargins(20, 20, 20);
    $pdf->AddPage();

    $html = <<<EOD
<h1 style="text-align:center;">Bulletin de Paie</h1>
<p><strong>Employé ID :</strong> {$employe_id}</p>
<p><strong>Mois :</strong> {$mois}</p>
<p><strong>Salaire :</strong> {$salaire} FCFA</p>
EOD;

    $pdf->writeHTML($html, true, false, true, false, '');

    // Construction du chemin absolu vers le fichier PDF
    $nom_fichier = uniqid('paie_') . '.pdf';
    $repertoire_relatif = '/../uploads/bulletins/';
    $repertoire_absolu = realpath(__DIR__ . $repertoire_relatif);

    if (!$repertoire_absolu) {
        mkdir(__DIR__ . $repertoire_relatif, 0777, true);
        $repertoire_absolu = realpath(__DIR__ . $repertoire_relatif);
    }

    $chemin_complet = $repertoire_absolu . DIRECTORY_SEPARATOR . $nom_fichier;

    // Génération du PDF
    $pdf->Output($chemin_complet, 'F');

    // Enregistrement en BDD
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
