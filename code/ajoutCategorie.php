<?php
require_once "entete.php";

if( isset($_POST["nom"]) && !empty($_POST["nom"]) && 
    isset($_POST["res"]) && !empty($_POST["res"]) &&
    isset($_POST["photo"]) && !empty($_POST["photo"]))
    {
    $nom = $_POST["nom"];
    $res = $_POST["res"];
    $photo = $_POST["photo"];
    
    try {

        $requete = getBdd()->prepare("INSERT INTO categories(nom, res, photo) VALUES (?, ?, ?)");
        $requete->execute([$nom, $res, $photo]);

        ?>
        <div class="alert alert-success">Le manga <?=$_POST["nom"];?> a bien été ajouté.
        <br>Vous allez être redirigé vers l'accueil.<br>
        <a href="index.php">Cliquez ici si vous ne voulez pas attendre.</a></div>
       
        <?php
    header('refresh:4;index.php');
    } catch (Exception $e){

        ?>
        <div class="alert alert-danger">Le manga n'a pas pu être ajouté</div>

        <?php
    }
} else {
    ?>

    <h1>Ajout d'un nouvelle anime</h1>
    <form method="post">
    
        <div class="form-group">
            <label for="nom">Nom de l'anime</label>
            <input type="text" class="form-control" name="nom" 
            placeholder="Ajoutez un nom">
        </div>

        <div class="form-group">
            <label for="res">Résumé</label>
            <input type="text" class="form-control" name="res" 
            placeholder="Ajoutez un résumé ">
        </div>

        <div class="form-group">
        <label for="photo">Photo</label>
        <input type="text" class="form-control" name="photo" id="photo" placeholder="Entrez le lien de l'image">
    </div>
    
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    
    </form>
<?php
}
?>

<?php
require_once "pied.php";
?>