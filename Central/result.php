<?php
session_start();

require('../Private/password.php');

define('servername', $servername); // define() est utilise pour declarer des constantes
define('db_name', $db_name); //nom de ma base de donnee
define('username', $username); // nom de utilisateur
define('DB_Password', $DB_PASSWORD);

try {


    $db = new PDO("mysql:host=" . servername . ";dbname=" . db_name, username, DB_Password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    die('Impossible de se connecter a la base de donnees' . $e->getMessage());
}

@$keywords = $_POST['keywords'];
@$valider = $_POST['valider'];

if (isset($valider)&&  !empty(trim($keywords))){

  $sql = "SELECT Beschreibung from WOHNUNG WHERE Beschreibung like '%$keywords'";

//  $res = $db->prepare($sql);
  //$res->setFetchMode(PDO::FETCH_ASSOC);
  //$res->execute();
  //$tab=$res->fetchAll();
  //
  $sth ->setFetvhMode(PDO:: FETCH_OBJ);
  $sth->execute();
  $row = $sth->fetch();
 

$afficher = "oui";

}









?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form name="fo" method="POST" action="result.php">
<input type="text" name="keywords" value="<?php echo $keywords?>" placeholder="Mots-cles"/>
<input type="submit" name="valider" value="Rechercher"/>
</form>


<?php if (@$afficher === "oui") {?>   
 <div id="resultats">
<div id="nbr" ><?=count($row) ." ".(count($row)>1?"resultats troubes": "resultat trouve")?></div>
<ol>
<?php for($i=0; $i<count($row);$i++){?>
<li><?php echo $row["Beschreibung"];?></li>
<?php }?>

</ol>
</div>
<?php }?>
</body>
</html>

