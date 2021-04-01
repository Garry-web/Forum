<?php
require_once "entete.php";

    if(isset($_POST["submit"]) && !empty($_POST["submit"]) && $_POST["submit"] === "ON"){
        
        extract($_POST);
        $erreurs = [];


        $erreurs = [];

        // si l'un des champs est vide 
        if(
            !isset($identifiant) || empty($identifiant) ||
            !isset($mdp) || empty($mdp)
        ){
            $erreurs[] = "L'un des champs est vide";
        }


        // vérification de la longueur du mot de passe
        if(strlen($mdp) < 8){
            $erreurs[]= "Le mot de passe doit contenir au moins 8 caractères.";
        }

        // Si on a pas d'erreur à ce stade, on va faire les vérifications dans la BDD
        if(count($erreurs) == 0){
            $requete = getBdd()->prepare("SELECT identifiant, mdp, id_role, id_user FROM utilisateurs WHERE identifiant = ?");
            $requete->execute([$identifiant]);
            
            // Vérification si le pseudo n'existe pas en regardant le nombre de lignes 
            //retournées par la requête
            if($requete->rowCount() > 0){
                // Le pseudo existe
                $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
                
                // Vérifier si les mots de passe correspondentne correspondent pas
                if(!password_verify($mdp, $utilisateur["mdp"])){
                    //Le mot de passe ne correspond pas
                    $erreurs[] = "Le mot de passe saisi est incorrect";
                }

            } else {
                // L'email n'existe pas
                $erreurs[] = "Le pseudo n'existe pas";
            }
        }


        // Si après les vérifications dans la BDD je n'ai toujours pas d'erreurs
        if(count($erreurs) == 0){

            // on connecte l'utilisateur
            $_SESSION["identifiant"] = $identifiant;
            $_SESSION["id_role"] = $utilisateur["id_role"];
            $_SESSION["id_user"] = $utilisateur["id_user"];

            header("location:index.php");

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

    <h1>Formulaire de connexion</h1>
    <form method="POST">
    
        <div class="form-group">
                <label for="email">Pseudo: </label>
                <input type="text" class="form-control" name="identifiant" id="identifiant" 
                placeholder="Entrez votre Pseudo" value="<?=(isset($_POST['identifiant']) ? $_POST['identifiant'] : "")?>" >
        </div>
    
        <div class="form-group">
                <label for="mdp">Mot de passe : </label>
                <input type="password" class="form-control" name="mdp" id="mpd" 
                placeholder="Entrez votre mot de passe" value="<?=(isset($_POST['mdp']) ? $_POST['mdp'] : "")?>" >
        </div>
    
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="submit" value="ON">Connexion</button>
        </div>
    
    </form>


<?php
require_once "pied.php";
?>