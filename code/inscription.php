<?php

require_once "entete.php";
?>


    <h1>Inscription : </h1>
    <form method="POST" enctype="multipart/form-data" action="upload.php">
    
        <div class="form-group">
                <label for="identifiant">Pseudo </label>
                <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Entrez votre pseudo" value="<?=(isset($_POST['email']) ? $_POST['email'] : "")?>" required>
        </div>
    
        <div class="form-group">
                <label for="mdp">Mot de passe : </label>
                <input type="password" class="form-control" name="mdp" id="mpd" placeholder="Entrez votre mot de passe" value="<?=(isset($_POST['mdp']) ? $_POST['mdp'] : "")?>" required>
        </div>
    
        <div class="form-group">
                <label for="mdpVerif">Vérification du mot de passe : </label>
                <input type="password" class="form-control" name="mdpVerif" id="mdpVerif" placeholder="Vérifier votre mot de passe" value="<?=(isset($_POST['mdpVerif']) ? $_POST['mdpVerif'] : "")?>" required>
        </div>
    
        <div class="form-group">
                <label for="avatar">Ajoutez un avatar</label>
                <input type="file" name="avatar"/>
                <br>

        </div>


        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="submit" value="ON">Inscription</button>
        </div>
    
    </form>


<?php
require_once "pied.php";
?>