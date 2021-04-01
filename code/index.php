<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Forum manga/anime</title>
</head>


<body>
    <header class="menu">
    <?php
    require_once "entete.php";

      
        $requete = getbdd()->prepare("SELECT * FROM categories");
        $requete->execute();
        $categories = $requete->fetchALL(PDO::FETCH_ASSOC); 
    ?>

    <?php
        if(isset($_SESSION["identifiant"]) && !empty($_SESSION["identifiant"])){
    ?>
<div id="BJ">
        <p>Bonjour <?=$_SESSION["identifiant"];?></p>

    <?php
    }
    ?>
</div>
</header>

<main>

<h1>Forum manga/anime</h1>
</br>

    <?php
    foreach($categories as $categorie){
        if(empty($categorie["nom"])){
            $categorie["nom"] = "aucune";
        }
    ?>

<div class="card-group">
  <div class="card">     
  <img class="card-img-top" src="<?=$categorie["photo"];?>" alt="Card image cap" >
    <div class="card-body">
    <h5 class="card-title"><?=$categorie["nom"];?></h5>
    <p class="card-text"><?=$categorie["res"];?></p>
    <a href="discussion.php?id=<?=$categorie["id_categorie"];?>"  class="btn btn-primary">Voir discussion</a>
    </div>
  </div>
</div>

<?php
}
?>




</main>
</body>

</html>

