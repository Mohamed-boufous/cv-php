<?php
session_start();

$visite = isset($_COOKIE['visite']) ? $_COOKIE['visite'] : 0;

if (isset($_COOKIE['visite'])) {
    $visite++;
    echo "Visites : $visite";
} else {
    echo "Visites : $visite";
}

setcookie("visite", $visite, time() + 3600 * 24);
echo "<br>";

$_SESSION['date'] = date("H:i:s Y-m-d");

// Ajouter la session contenant le titre
$_SESSION['titre'] = "Création de CV";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        #container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #right-section {
            display: flex;
            margin-left: 400px;
        }

        #right-section > span {
            margin-right: 10px; /* Ajustez la marge selon vos préférences */
        }

        h1 {
            font-size: 24px;
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
<div id="container">
    <div id="right-section">
        <span><?php echo "Nom : " . $_SESSION['nom']; ?></span>
        <span><?php echo "Prénom : " . $_SESSION['prenom']; ?></span>
        <span><?php echo "Date : " . $_SESSION['date']; ?></span>
        <span><?php echo "Titre : " . $_SESSION['titre']; ?></span>
    </div>

    <h1>Etat civil</h1>
    <div id="etat-civil">
        <?php  
        $contenuFichier = file_get_contents("etatcivile.txt");
        echo "<p>$contenuFichier</p>";
        ?>
    </div>

    <h1>Experience</h1>
    <div id="experience">
        <?php  
        $contenuFichier = file_get_contents("experience.txt");
        echo "<p>$contenuFichier</p>";
        ?>
    </div>

    <h1>Hobbies</h1>
    <div id="hobbies">
        <?php  
        $contenuFichier = file_get_contents("hobbies.txt");
        echo "<p>$contenuFichier</p>";
        ?>
    </div>

    <h1>Formation</h1>
    <div id="formation">
        <?php  
        $contenuFichier = file_get_contents("formation.txt");
        echo "<p>$contenuFichier</p>";
        ?>
    </div>
    <div class="btn-telecharger-pdf">
    <form method="post" action="telecharger_pdf.php">
        <button type="submit">Télécharger en PDF</button>
    </form>
    <li><a href="loginform.php">Déconnexion</a></li>
</div>


</div>
</body>
</html>