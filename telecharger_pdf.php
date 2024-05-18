<?php
require_once 'vendor/autoload.php'; // Assurez-vous que le chemin est correct si vous avez installé Dompdf via Composer

use Dompdf\Dompdf;

// Initialise dompdf
$dompdf = new Dompdf();

// Récupère le contenu HTML de votre page
ob_start(); // Commence la mise en mémoire tampon de la sortie
include 'login.php'; // Ajustez le chemin si nécessaire
$html = ob_get_clean(); // Récupère le contenu du tampon et le nettoie

// Masquer les éléments avec la classe .btn-telecharger-pdf
$html = preg_replace('/<div class="btn-telecharger-pdf">.*?<\/div>/s', '', $html);

// Charge le contenu HTML dans dompdf
$dompdf->loadHtml($html);

// Rendre le PDF
$dompdf->render();

// Télécharger le PDF
$dompdf->stream('mon_cv.pdf');
?>
