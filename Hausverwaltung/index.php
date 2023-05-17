<?php
session_start();
if (!$_SESSION['user']){
  header("Location: login.php");

}else{

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="index.css">

</head>

<body>


    <nav>
        <ul>
            <li><a href="mieter.php"><b>Mieter</b></a></li>
            <li><a href="freie.php"><b>Freie Zimmer</b></a></li>
            <li><a href="../Central/osm.php"><b>HomePage</b></a></li>
            <li><a href="logout.php"><b>Abmelden</b></a></li>
        </ul>
    </nav>



<?php 


if(isset($_GET['error'])){?>
<p><?php echo $_GET['error'];?></p>
<?php  }?></p>




    <div class="header">
        <h2>Neue Freie Zimmern</h2>
    </div>
    <form action="ajoutMaison.php" method="POST" enctype="multipart/form-data">
        <div class="input">
            <label>Bechreibung</label>
            <!--<input type="text" name="Bechreibung" id="Bechreibung" required="">-->
            <textarea name="Beschreibung"></textarea>
        </div>
        <div class="input">
            <label>Typ von Zimmer</label>
            <input type="text" name="zimmerTyp" id="zimmerTyp" required="">
        </div>


        <div class="input">
            <label>Latitude</label>
            <input type="text" name="latitude" id="latitude" required="">
        </div>
        <div class="input">
            <label>Longitude</label>
            <input type="text" name="longitude" id="longitude" required="">
        </div>
        <div class="input">
            <label>Preis</label>
            <input type="text" name="preis" id="preis" required="">
        </div>
        <div class="input">
            <div class="input">
                <label>Bild</label>
                <input type="file" name="bild" /><br />
            </div>
        </div>
        <input type="submit" class="btn" name="absenden"></button>

    </form>
</body>

</html>
<?php } ?>
