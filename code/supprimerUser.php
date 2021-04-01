<?php
require_once "entete.php";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $iduser = $_GET["id"];
} else {
    header("location:index.php");
}

if (isset($_POST["id_user"]) && !empty($_POST["id_user"])) {
    try {
        $requete = getBdd()->prepare("DELETE FROM utilisateurs WHERE id_user = ?");
        $requete->execute([$_POST["id_user"]]);

        ?>
            <div class="alert alert-success">
                L'utilisateur a bien été supprimé<br>
                Vous allez être redirigé vers l'accueil<br>
                <a href="index.php">Cliquez ici si vous ne souhaitez pas attendre</a>
            </div>
        <?php
header("refresh:5;index.php");
    } catch (Exception $e) {
        ?>
        <div class="alert alert-danger">
            Une erreur s'est produite lors de la suppression
        </div>
        <?php
}
} else {
    ?>

<p>Êtes-vous sûr de vouloir supprimer l'utilisateur n°<?=$iduser;?> ?</p>
<form method="post">
    <input type="hidden" name="id_user" value="<?=$iduser;?>"/>
    <button type="submit" class="btn btn-warning">Oui</button>
    <a href="index.php" class="btn btn-secondary">Annuler la suppression et retourner à l'accueil</a>
</form>


<?php
}
require_once "pied.php";
?>