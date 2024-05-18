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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_formation"])) {
    // Récupérer les données du formulaire de formation
    $diplome = $_POST["diplome"];
    $domaine = $_POST["domaine"];
    $annee_obtention = $_POST["annee_obtention"];

    // Enregistrement des données dans le fichier formation.txt
    $file = fopen("formation.txt", "w");
    fwrite($file, "Diplôme: $diplome, Domaine: $domaine, Année d'obtention: $annee_obtention\n");
    fclose($file);

    // Création d'une session pour stocker les données de formation
    $_SESSION["diplome"] = $diplome;
    $_SESSION["domaine"] = $domaine;
    $_SESSION["annee_obtention"] = $annee_obtention;


}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["CONFERMATION"])) {
     // Récupérer les données du formulaire de formation
     $diplome = $_POST["diplome"];
     $domaine = $_POST["domaine"];
     $annee_obtention = $_POST["annee_obtention"];
 
     // Enregistrement des données dans le fichier formation.txt
     $file = fopen("formation.txt", "a");
     fwrite($file, "Diplôme: $diplome, Domaine: $domaine, Année d'obtention: $annee_obtention\n");
     fclose($file);
 
     // Création d'une session pour stocker les données de formation
     $_SESSION["diplome"] = $diplome;
     $_SESSION["domaine"] = $domaine;
     $_SESSION["annee_obtention"] = $annee_obtention;
    header("Location: hobbies.php");
    exit();
}

$formBuilder = new FormulaireBuilder("formation.php", "post", "form_formation");

$formBuilder->addTextField("diplome", "text", "Diplôme :");
$formBuilder->addTextField("domaine", "text", "Domaine d'études :");
$formBuilder->addTextField("annee_obtention", "text", "Année d'obtention :");
$formBuilder->addButton("submit_formation", "ajouter_formation");
$formBuilder->addButton("CONFERMATION", "NEXTPAGE");

echo $formBuilder->generateForm();
