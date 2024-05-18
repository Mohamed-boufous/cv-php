<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire État Civil</title>
    <!-- Inclusion du style CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
require_once("Formulair.php");

$formBuilder = new FormulaireBuilder("#", "post", "form_experience");

$formBuilder->addTextField("entreprise", "text", "Entreprise :");
$formBuilder->addTextField("poste", "text", "Poste :");
$formBuilder->addTextField("annees_experience", "number", "Années d'expérience :");
$formBuilder->addButton("submit_experience", "ajouter Expérience");
$formBuilder->addButton("submit_all", "Envoyer Expérience");

echo $formBuilder->generateForm();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_experience"])) {
    $entreprise = $_POST['entreprise'];
    $poste = $_POST['poste'];
    $annees_experience = $_POST['annees_experience'];

    $file = fopen("experience.txt", "w");
    fwrite($file, "Entreprise: $entreprise, Poste: $poste, Années d'expérience: $annees_experience\n");
    fclose($file);

    $_SESSION['entreprise'] = $entreprise;
    $_SESSION['poste'] = $poste;
    $_SESSION['annees_experience'] = $annees_experience;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_all"])) {

    $entreprise = $_POST['entreprise'];
    $poste = $_POST['poste'];
    $annees_experience = $_POST['annees_experience'];

    $file = fopen("experience.txt", "a");
    fwrite($file, "Entreprise: $entreprise, Poste: $poste, Années d'expérience: $annees_experience\n");
    fclose($file);

    $_SESSION['entreprise'] = $entreprise;
    $_SESSION['poste'] = $poste;
    $_SESSION['annees_experience'] = $annees_experience;
    header("Location: formation.php");
    exit();
}
