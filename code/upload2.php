<?php
require_once "entete.php";
$dossier = "images/";
$nom = "image_de_gojo";
$extension = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
$fichier = $dossier . $nom . "." . $extension;

print_r ($_POST);
        if (
        isset($_POST["submit"]) && !empty($_POST["submit"] && $_POST["submit"] === "ON")
        ) {

        $erreurs = [];

        if(
        isset($_POST)["libelle"]) && !empty($_POST["libelle"]) &&
        isset($_POST["identifiant"]) && !empty($_POST["identifiant"]) &&
        isset($_FILES["avatar"]) && !empty($_FILES["avatar"]))
        {

        // Vérification que l'email est unique
        $requete = getBdd()->prepare("SELECT identifiant FROM utilisateurs WHERE identifiant = ?;");
        $requete->execute([$_POST["identifiant"]]);
        if($requete->rowCount() > 0){
            $erreurs[] = "Votre pseudo est déjà utilisé";
        }

        // TEST 1 : Vérifier si on peut récpérer les dimensions de l'image
        if(getimagesize($_FILES["avatar"]["tmp_name"])) {

        // TEST 2 : Vérifier si le poids en octets de l'image ne dépasse pas 3 mégas
        if($_FILES["avatar"]["size"] <= 3000000) {

        // TEST 3 : Vérifier le vrai type du fichier 
        if ($_FILES["avatar"]["type"] == "image/png" || $_FILES["avatar"]["type"] == "image/jpeg"){

        // TEST 4 : On enregistre le fichier et on teste si on ça a fonctionné
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $fichier)){
            echo "l'image " . $nom . " a bien été enregistré";
        } else {
            echo "le fichier n'a pas pu être enregistré";
        }
        } else {
            echo "le fichier n'a pas le bon type";
        }
        }else {
            echo "le fichier pèse plus de 3M";
        }
        }else {
            echo "lefichier n'est pas une image";
        }
        } else {
        // il manque au moins un champ
        $erreurs[] = "Au moins un champ n'a pas été saisi";
        ?>
        <div class="alert alert-warning mt-3">Tous les champs doivent être saisis pour envoyer le formulaire correctement.</div>
        <?php
    }

    if(count($erreurs) === 0) {
        // on envoie le formulaire
        // transfort nos values du formulaire en variable avec le nom des inputs
        extract($_POST);

        try {
            //a modifier pour le profil
            $requete = getBdd()->prepare("UPDATE utilisateurs(identifiant, avatar) SET identifiant=?, avatar=?");
            $requete->execute([$identifiant, $fichier]);

        ?>
        <div class="alert alert-success mt-3">
        <br>Vos modiffication on été pris en compte<br>Vous allez être redirigé vers la page d'accueil dans 4 secondes.<br>
        <a href="index.php">Si vous ne souhaitez pas attendez, cliquez ici.</a>
        </div>
        <?php
        header("refresh:4;index.php");

        } catch(Exception $e){
            ?>
            <div class="alert alert-danger">
                Une erreur s'est produite.
            </div>
            <?php
        }


    } else {
        ?>
        <div class="alert alert-warning mt-3">
            Erreur<?=(count($erreurs) > 1 ? "s" :"")?> :
            <?php
            foreach($erreurs as $erreur){
                ?>
                <br><?=$erreur;?>
                <?php
            }
            ?>
        </div>
        <?php
    }

}
?>
