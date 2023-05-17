<?php
include "../Prototyp_Swe2/Private/Password.php";

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


?>




<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="https://informatik.hs-bremerhaven.de/leaflet/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <nav>
        <ul>
            <li><a href="#"><b>Home</b></a></li>
            <li><a href="#"><b>Home</b></a></li>
            <li><a href="Leiter\loginLeiter.html"><b>Leiter</b></a></li>
            <li><a href="#"><b>Kontakt</b></a></li>
        </ul>
    </nav>
    <h1> Wohnungsvermittlung</h1>

    <div class="container">

        <div class="list">

            <?php $sql = "SELECT * FROM WOHNUNG";
            foreach ($db->query($sql) as $row) {
                $beschreibung = $row['Beschreibung'];
                $long = $row['Longitude'];
                $lat = $row['Latitude'];
                //$bild = $row['Bild'];
                $preis = $row['Preis'];
                $typZimmer = $row['Zimmertyp'];
                //echo $beschreibung ."<br>";
                //echo $long ."<br>";
                //echo $lat ."<br>";
                //echo $preis ."<br>";



            ?>


                <div class="item img1" data-lat="<?php echo $lat ?>" data-lng="<?php echo $long; ?>" data-price="<?php echo $preis ?>">
                    <?php //require("test.php"); 
                    ?>
                    <!-- <img src="<?php //require("test.php"); 
                                    ?>" alt="">-->
                    <!--  <img src="<?php $bild ?>" alt="">-->
                    <img src="img1.jpg" alt="">
                    <a href=""></a>
                    <h4><?php echo $typZimmer ?></h4>
                    <p>
                        <?php echo $beschreibung ?>

                    </p>
                </div>
            <?php } ?>
        </div>
        <div class="map" id="map"></div>

    </div>
    <!--<script type="text/javascript" src="https://informatik.hs-bremerhaven.de/leaflet/leaflet.js"></script> -->
</body>
<script src="vendor.js"></script>
<script src="securite.js"></script>

</html>