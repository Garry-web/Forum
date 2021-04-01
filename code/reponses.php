<?php
require_once ("entete.php");

if (isset($_GET["id"]) && !empty($_GET["id"])){
    $requete = getBdd()->prepare("SELECT * FROM sujets LEFT JOIN utilisateurs USING(id_user) WHERE id_sujet = ?");
    $requete->execute([$_GET["id"]]);
    $sujet = $requete->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST["resp"]) && !empty($_POST["resp"])){
    
        $resp = $_POST["resp"];
       
        $requete = getBdd()->prepare("INSERT INTO reponses(resp, date_resp, id_sujet, id_user) VALUES(?,NOW(),?,?)");
        $requete->execute([$resp, $sujet["id_sujet"], $_SESSION["id_user"]]);
    }

    $requete = getBdd()->prepare("SELECT * FROM reponses LEFT JOIN utilisateurs USING(id_user) WHERE reponses.id_sujet = ?");
    $requete->execute([$_GET["id"]]);
    $reponses = $requete->fetchAll(PDO::FETCH_ASSOC);
    


}else{
    header("location:index.php");
}

?>
<div id="rep">
<div id="repcard">
    <div id="titrerep"><?=$sujet["titre"];?></div>
        <div id="sujetrep">
            <p><?=$sujet["sujet"];?></p>
            <p>Créé par <?=$sujet["identifiant"];?></p>
            <?php if(isset($_SESSION["identifiant"]) && !empty ($_SESSION["identifiant"])){?>
                <form method="POST">
                    <input type="textarea" placeholder="Votre réponse" name="resp" style="width:80%"></input><br /><br>
                    <button type="submit" class="btn btn-primary">Répondre</button>
                </form>
        
                <?php } ?>
        </div>
</div>
<br>
<br>
<?php
foreach($reponses as $reponse){
    ?>
    <div id="reponse">
        <div >
            <p><?=$reponse["resp"];?></p>
            <p>Réponse de <?=$reponse["identifiant"]?> <img src="<?=$utilisateurs["avatar"];?>" 
        style="float:right" 
        height="60px" 
        width="50px"
        clip-path="ellipse(50% 50%)"></p>
        <button type="submit" class="btn btn-primary">Suprimer</button>
        </div>
    </div>
    
    <?php 
    }
    ?>
</div>


