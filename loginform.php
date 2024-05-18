<?php
session_start();

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_con"])) {
    // Vérifier les informations de connexion (ex : email et mot de passe)
    $email_saisi = $_POST['email'];
    $mot_de_passe_saisi = $_POST['mot_de_passe'];

    $motdepassetemailficehir=file_get_contents("motdepassetemail.txt");
  
    $motdepassetemail=explode("-" ,$motdepassetemailficehir);
   
    if (
       
        $email_saisi ==$motdepassetemail[0]&&
      $mot_de_passe_saisi==$motdepassetemail[1]
    ) {
        // Informations de connexion correctes, initialiser la session
      

        // Rediriger vers la page d'accueil après la connexion réussie
        header("Location: login.php");
        exit();
    } else {
        // Informations de connexion incorrectes, afficher un message d'erreur
        $erreur_message = "Email ou mot de passe incorrect ";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php
    if (isset($erreur_message)) {
        echo "<p style='color: red;'>$erreur_message</p>";
    }
    ?>

    <form action="#" method="post">
        <label for="email">Email :</label>
        <input type="email" name="email" required><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" required><br>

        <input type="submit" value="Se Connecter" name="submit_con">
        <a href=""></a>
    </form>
</body>
</html>
