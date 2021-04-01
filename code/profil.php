<?php
require_once("entete.php");

$requete = getbdd()->prepare("SELECT * FROM utilisateurs") ;
$requete->execute();

?>

<div>
  <h1> Profil : </h1>
  <h4>Votre pseudo : <?= $_SESSION["identifiant"] ?></h4>
  <p>Avatar :</p>
  <p><img src="<?=$utilisateurs["avatar"];?>"  
        height="150px" 
        width="120px"> </p>
</div>
<br>
<h1>Modifier votre Pseudo</h1>

     <form method="post" enctype="multipart/form-data" action="upload2.php">
     <div class="form-group">
            <input type="text" class="form-control" 
            name="libelle" 
            id="libelle" 
            placeholder="Saisissez votre nouveau pseudo"/>
        </div>

<h1>Modifier votre Avatar</h1>
        <div class="form-group">
              <label for="avatar"></label>
              <input type="file" name="avatar"/>
              <br>
        </div>

        <div class="form-group text-center">
            <button type="submit" 
            class="btn btn-primary">Modifier le profil</button>
        </div>
     </form>



