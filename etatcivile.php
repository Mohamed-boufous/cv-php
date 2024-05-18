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
require_once("Formulair.php"); 
$formBuilder = new FormulaireBuilder("etatcivile.php", "post", "monFormulaire");


// Ajoutez les champs requis au formulaire
$formBuilder->addTextField("nom", "text", "Nom :");
$formBuilder->addTextField("prenom", "text", "Prénom :");
$formBuilder->addTextField("email", "email", "E-mail :");
$formBuilder->addTextField("telephone", "tel", "Numéro de téléphone :");
$formBuilder->addTextField("password", "password", "Mot de passe :");
$formBuilder->addButton("submit_et", "Envoyer");

// Générez le formulaire
echo $formBuilder->generateForm();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_et"])) { // Corrected the button name
    // Récupérer les données du formulaire d'état civil
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    // Ne pas utiliser le hashage du mot de passe pour des raisons de sécurité
    $password = $_POST['password'];

    // Enregistrement des données dans le fichier etatcivil.txt
    if (!$file = fopen("etatcivile.txt", "w")) {
        die("Erreur lors de l'ouverture du fichier");
    }

    fwrite($file, "Nom: $nom, Prénom: $prenom, Email: $email, Téléphone: $telephone");
    fclose($file);
    
    // Enregistrement de l'email et du mot de passe dans le fichier motdepassetemail.txt avec un trait d'union entre eux
    if (!$file = fopen("motdepassetemail.txt", "w")) {
        die("Erreur lors de l'ouverture du fichier");
    }
    fwrite($file, "$email-$password");
    fclose($file);


    // Stockage des informations dans la session (sans le mot de passe pour des raisons de sécurité)
    session_start(); // Start the session if not already started
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['email'] = $email;
    $_SESSION['telephone'] = $telephone;
    $_SESSION['password'] = $password;

    // Ne pas stocker le mot de passe dans la session pour des raisons de sécurité

    // Redirection vers experience.php
    header("Location: experience.php");
    exit();
}
?>
