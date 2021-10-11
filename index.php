<?php
require_once '_connect.php';

$pdo = new \PDO(DSN, USER, PASS);

if ($_POST){

    $lastname = trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);
    $sqlInsertFriend = $pdo->prepare('INSERT INTO friend (lastname,firstname) VALUES (:lastname,:firstname)');
    $sqlInsertFriend->bindParam(':lastname', $lastname, \PDO::PARAM_STR);
    $sqlInsertFriend->bindParam(':firstname', $firstname, \PDO::PARAM_STR);

    if ($sqlInsertFriend->execute()) {
        echo 'Votre insertion a été un succès'; 
        header('location: index.php');
        exit();
    } else {
        echo 'Votre insertion a été un echec'; 
    }


}

?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sqlSelectFriends = "SELECT * FROM friend";

    $resultat = $pdo->query($sqlSelectFriends);

    $resultats = $resultat->fetchAll();

    foreach ($resultats as $key => $value) {
        echo'<tr>';
            echo'<td>'.$value['id'].'</td>';
            echo'<td>'.$value['lastname'].'</td>';
            echo'<td>'.$value['firstname'].'</td>';
        echo'</tr>';
    }
    ?>

    </tbody>
</table>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulaire</title>
</head>
<body>
 <form method="POST" target="">
     <h2>Création d'un friend</h2>
    <div>
        <label for="lastname">Nom</label>
        <input type="text" id="lastname" name="lastname" value ="<?php if(isset($_POST['lastname'])); ?>" required>
    </div>
     <p></p>
    <div>
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name ="firstname" value ="<?php if(isset($_POST['firstname'])); ?>"required>
    </div>
     <p></p>
     <div class="button">
        <button type="submit">Créer le nouvel ami</button>
    </div>
  </form>
 </body>
</html>