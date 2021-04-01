<?php
require_once "entete.php";

$requete = getbdd()->prepare("SELECT * FROM utilisateurs INNER JOIN roles USING (id_role) ");
$requete->execute();
$utilisateurs = $requete->fetchALL(PDO::FETCH_ASSOC);


?>

<body>
    <h1>Gérer les utilisateurs</h1>
    <br>
    <a href="creerUser.php" class="btn btn-primary">Créer un nouvel utilisateur</a>
    <br>
    <br>

    <?php
    foreach($utilisateurs as $utilisateur){
        ?>
        <table>
            <thead>
                <tr>
                    <td>identifiant</td>
                    <td>role</td>
                    <td>avatar</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?=$utilisateur["identifiant"]?></td>
                    <td><?=$utilisateur["role"]?></td>
                    <td><?=$utilisateur["avatar"]?></td>
                </tr>
            </tbody>
        </table>
        <a href="modifierUser.php?id=<?=$utilisateur["id_user"];?>" class="btn btn-warning my-2">Modifier l'utilisateur</a>
        <a href="supprimerUser.php?id=<?=$utilisateur["id_user"];?>" class="btn btn-danger my-2">Supprimer l'utilisateur</a>
        <br>
        <br>
        <br>
<?php
    }
    ?>

</body>