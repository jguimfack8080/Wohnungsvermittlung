
<?php
session_start();
//var_dump(PDO::getAvailableDrivers());//Pour voir tous les drivers de gestion de donnees

require('../Private/password.php');


define('servername', $servername); // define() est utilise pour declarer des constantes
define('db_name', $db_name); //nom de ma base de donnee
define('username', $username); // nom de utilisateur
define('DB_Password', $DB_PASSWORD);

try {


    $db = new PDO("mysql:host=" . servername . ";dbname=" . db_name, username, DB_Password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Reussi";
} catch (PDOException $e) {

    die('Impossible de se connecter a la base de donnees' . $e->getMessage());
}


if ($_SESSION['user']== ''){
  header("Location: login.php");
}



if (isset($_POST["absenden"])) {

    //echo var_dump($_FILES);     
    $beschreibung = nl2br($_POST['Beschreibung']);
    $lat = $_POST['latitude'];
    $long = $_POST['longitude'];
    $preis = $_POST['preis'];
    //$bild = file_get_contents($_FILES['bild']['tmp_name']);
    $zimmer = $_POST['zimmerTyp'];
    $nameBild = $_FILES['bild']['name'];
    $grosseBild = $_FILES['bild']['size'];
    $tmp_name = $_FILES['bild']['tmp_name'];
    $error = $_FILES['bild']['error'];


    if ($error === 0) {
        if ($grosseBild > 2000000) {
            $message = "Entschuldigung, das Foto ist zu groß.";
            header("Location: index.php?error=$message");
        } else {
            $bild_extension = pathinfo($nameBild, PATHINFO_EXTENSION);
            $bild_extension_lc = strtolower($bild_extension);
            $erlaubteExtension = array('jpg', 'png', 'jpeg', 'jfif', 'webp');
        }
        if (in_array($bild_extension_lc, $erlaubteExtension)) {

            $neue_bild_name = uniqid("IMG-", true) . '.' . $bild_extension_lc;
            $bildVerzeichnis = '../Images/'.$neue_bild_name;
            move_uploaded_file($tmp_name, $bildVerzeichnis);

            $sql = "INSERT INTO WOHNUNG(Beschreibung, Latitude, Longitude,Bild, Preis, Zimmertyp) 
        VALUES (:Beschreibung, :Latitude, :Longitude, :Bild, :Preis, :Zimmertyp)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':Beschreibung', $beschreibung);
            $stmt->bindParam(':Latitude', $lat);
            $stmt->bindParam(':Longitude', $long);
            $stmt->bindParam(':Bild', $neue_bild_name);
            $stmt->bindParam(':Preis', $preis);
            //
            $stmt->bindParam(':Zimmertyp', $zimmer);
            $stmt->execute();
?>
             <script>
            alert("Die neuen Informationen wurden berücksichtigt und in die Datenbank eingefügt.");

            if (window.confirm('Wenn Sie ok klicken werden Sie weitergeleitet. Cancel will load this website ')) 
            {
              window.location.href='index.php';
};
             </script>
<?php


        } else {
            $message = "Sie können nicht dieser Typ von Datei herunterladen.";
           // header("Location: index.php?error=$message");
?>
<script> alert("Sie können nicht dieser Dateityp hochladen");
        if (window.confirm('')) 
            {
              window.location.href='index.php';
        }

</script>
<?php
        }
    } else {
        $message = "unknow error ocured";
        header("Locataion: index.php?error=$message");
    }
} else {
    header("Location: index.php");
}

