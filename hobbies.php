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

// Vérifier si le formulaire de hobbies a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_hobbies"])) {
    // Récupérer les données du formulaire de hobbies
    $hobby1 = $_POST["hobby1"];
    $hobby2 = $_POST["hobby2"];
    $hobby3 = $_POST["hobby3"];

    // Enregistrement des données dans le fichier hobbies.txt
    $file_hobbies = fopen("hobbies.txt", "w");
    fwrite($file_hobbies, "Hobby 1: $hobby1, Hobby 2: $hobby2, Hobby 3: $hobby3\n");
    fclose($file_hobbies);

    // Ajout des données de hobbies à la session
    $_SESSION["hobby1"] = $hobby1;
    $_SESSION["hobby2"] = $hobby2;
    $_SESSION["hobby3"] = $hobby3;

    // Redirection vers login.php
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_ALL"])) {
    // Récupérer les données du formulaire de hobbies
    $hobby1 = $_POST["hobby1"];
    $hobby2 = $_POST["hobby2"];
    $hobby3 = $_POST["hobby3"];

    // Enregistrement des données dans le fichier hobbies.txt
    $file_hobbies = fopen("hobbies.txt", "a");
    fwrite($file_hobbies, "Hobby 1: $hobby1, Hobby 2: $hobby2, Hobby 3: $hobby3\n");
    fclose($file_hobbies);

    // Ajout des données de hobbies à la session
    $_SESSION["hobby1"] = $hobby1;
    $_SESSION["hobby2"] = $hobby2;
    $_SESSION["hobby3"] = $hobby3;

    // Redirection vers login.php
    header("Location: login.php");
    exit();
}

$formBuilder = new FormulaireBuilder("hobbies.php", "post", "form_hobbies");

$formBuilder->addTextField("hobby1", "text", "Hobby 1 :");
$formBuilder->addTextField("hobby2", "text", "Hobby 2 :");
$formBuilder->addTextField("hobby3", "text", "Hobby 3 :");
$formBuilder->addButton("submit_hobbies", "Envoyer Hobbies");
$formBuilder->addButton("submit_ALL", "Envoyer Hobbies");

echo $formBuilder->generateForm();
