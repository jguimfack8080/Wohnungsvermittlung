<?php
session_start();

  ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestätigung</title>
</head>
<body>

<h1>Bestätigungsformular</h1><br></br><br></br><br></br>

<p>Name: <b><?php echo $_SESSION['name'];?></b></p><br>
<p>Vorname: <b><?php echo $_SESSION['vorname'];?></b></p><br>
<p>Geburtsdatum: <b><?php echo $_SESSION['geburtsdatum'];?></b></p><br>  
<p>Einzugsdatum: <b><?php echo  $_SESSION['dateEinzug'];?></b></p><br> 
<p>Studienort: <b><?php echo $_SESSION['uni'];?></b></p><br>
<p>Dauer: <b><?php echo $_SESSION['dauer'];?></b> Monaten</p><br>
<br/><br/></br>
</body>
</html>
