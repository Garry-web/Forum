<?php
require_once "entete.php";


        $requete = getbdd()->prepare("SELECT * FROM categories");   
        $requete->execute();
        $categories = $requete->fetchALL(PDO::FETCH_ASSOC); 

if( isset($_POST["id_categorie"]) && !empty($_POST["id_categorie"]) && 
    isset($_POST["titre"]) && !empty($_POST["titre"]) &&
    isset($_POST["sujet"]) && !empty($_POST["sujet"]))

{
    $id_categorie = $_POST["id_categorie"];
    $titre = $_POST["titre"];
    $sujet = $_POST["sujet"];
    

    try {

        $requete = getBdd()->prepare("INSERT INTO sujets(id_categorie, titre, sujet, date_,id_user) VALUES (?, ?, ?, NOW(), ?)");
        $requete->execute([$id_categorie, $titre, $sujet, $_SESSION["id_user"]]);

        ?>
        <div class="alert alert-success">La discussion <?=$_POST["titre"];?> a bien été ajouté.
        <br>Vous allez être redirigé vers la page de discussion.<br>
        <a href="discussion.php?id=<?=$id_categorie?>">Cliquez ici si vous ne voulez pas attendre.</a></div>
       
        <?php
    header("refresh:4;discussion.php?id=$id_categorie");
    } catch (Exception $e){
        print_r($e)
        ?>
        <div class="alert alert-danger">La discussion n'a pas pu être ajouté</div>

        <?php
    }
} else {
    ?>

    <h1>Ajoutez une nouvelle discussion</h1>
    <form method="post">
    

    <div class="form-group">
    
            <label for="id_categorie">Indiquer le nom anime :</label>
            <select name="id_categorie" id="id_categorie">
            <?php
            foreach ($categories as $categorie){    
            ?>
            <option value="<?=$categorie["id_categorie"];?>"><?=$categorie["nom"];?></option>
            <?php
            }
            ?>
            </select>
    </div>

        <div class="form-group">
            <label for="titre">Intituler :</label>
            <input type="text" class="form-control" name="titre" 
            placeholder="Ajoutez un titre à la discussion">
        </div>

        <div class="form-group">
            <label for="sujet">Sujet :</label>
            <input type="text" class="form-control" name="sujet" 
            placeholder="Ajoutez un sujet">
        </div>

        
            <input type="hidden" class="form-control" name="identifiant" 
            value = "<?=$_SESSION["id_user"]?>" disabled="disabled">
        

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>

<?php
require_once "pied.php";
        }