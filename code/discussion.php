<?php
    require_once "entete.php";

         
        if (isset($_GET["id"]) && !empty($_GET["id"])){
            $requete = getBdd()->prepare("SELECT * FROM sujets LEFT JOIN categories USING(id_categorie) LEFT JOIN utilisateurs   USING(id_user) WHERE sujets.id_categorie = ?");
            $requete->execute([$_GET["id"]]);
            $sujets = $requete->fetchAll(PDO::FETCH_ASSOC);
        }


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Discussion</h1>
<?php if(isset($_SESSION["identifiant"]) && !empty ($_SESSION["identifiant"])){?>
    <a href="ajoutersujet.php" class="btn btn-primary">Ajouter un sujet de discussion</a>
 
<?php
}
?>

<br>
<br>

<?php
    foreach($sujets as $sujet){
        if(empty($sujet["sujet"])){
            $sujet["sujet"] = "aucune";
        }
    ?>

<div class="discut" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title"><?=$sujet["titre"];?></h5>
        <p class="card-text">Sujet: <?=$sujet["sujet"];?></p>
        <p class = "card-text">Créé par <?=$sujet["identifiant"];?></p>
        <a href="reponses.php?id=<?=$sujet["id_sujet"]?>" class = "btn btn-success">Voir les réponses du sujet</a>
    </div>
</div>  

<?php
}
?>


</body>
</html>
