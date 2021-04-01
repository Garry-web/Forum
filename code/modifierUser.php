<?php
require_once "entete.php";
$erreurs = 0;

        $requete = getbdd()->prepare("SELECT * FROM roles");   
        $requete->execute();
        $roles = $requete->fetchALL(PDO::FETCH_ASSOC); 

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $iduser = $_GET["id"];
} else {
    header("location:listeCategories.php");
}

try {
    // récupérer les infos de la catégorie
    $requete = getBdd()->prepare("SELECT * FROM utilisateurs INNER JOIN roles USING (id_role) WHERE utilisateurs.id_user = ?");
    $requete->execute([$iduser]);
    $utilisateurs = $requete->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // gérer les erreurs éventuelles
    $erreurs++;
    ?>
        <div class="alert alert-danger">
            Erreur : la catégorie n'a pas pu être récupérée.<br>
            Vous allez être redirigé vers la liste des utilisateurs<br>
            <a href="gestion_user.php">Cliquez ici si vous ne voulez pas attendre</a>
        </div>
    <?php
header("refresh:5;gestion_user.php");

}
if ($erreurs === 0) {
    if (isset($_POST["identifiant"]) && !empty($_POST["identifiant"]) &&
        isset($_POST["id_role"]) && !empty($_POST["id_role"])) {
 
    try {
            $requete = getBdd()->prepare("UPDATE utilisateurs SET identifiant = ?, id_role = ? WHERE id_user = ?");
            $requete->execute([$_POST["identifiant"], $_POST["id_role"]]);
            ?>
            <div class="alert alert-success">
            L'utilisateur a bien été modifiée.<br>
            Vous allez être redirigé vers la liste des utilisateurs<br>
            <a href="gestion_user.php">Cliquez ici si vous ne voulez pas attendre</a>
        </div>
            <?php
header("refresh:5;gestion_user.php");

        } catch (Exception $e) {
            ?>
            <div class="alert alert-danger">
                Une erreur s'est produite lors de la modification de l'utilisateur
            </div>
            <?php
            print_r($e);
}
    } else {
        ?>
    <h1>Modification de l'utilisateur n°<?=$iduser;?></h1>
    <form method="post">
            <?php
            foreach ($utilisateurs as $utilisateur){    
            ?>
        <div class="form-group">
            <label for="identifiant">identifiant</label>
            <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Saisissez l'identifiant" value="<?=$utilisateur["identifiant"]?>" />
        </div>
        <div class="form-group">
    
            <label for="id_role">Sélectionnez le role de l'utilisateur :</label>
            <select name="role" id="role">
            <?php
            foreach ($roles as $role){    
            ?>
            <option value="<?=$utilisateur["id_role"];?>"><?=$role["role"];?></option>
            <?php
            }
        
            ?>
            </select>
    </div>
       

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
        </div>
        <?php
        }
        ?>
    </form>
<?php
}
}
require_once "pied.php";
?>