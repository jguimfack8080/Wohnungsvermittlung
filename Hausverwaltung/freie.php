<?php

require('../Private/password.php');

$db = new mysqli($servername, $username, $DB_PASSWORD, $db_name);

if ($db->connect_error){
  echo $db->connect_error;
}
else{}

    $requered = "SELECT * FROM WOHNUNG";
    $result = mysqli_query($db, $requered);
  
  echo "<h1>Freie Zimmer</h1>";
  echo "<table border='1' width=1000>";
  echo "<tr><td>id</td><td>Beschreibung</td><td>Latitude</td><td>Longitude</td><td>Bild</td><td>Preis</td><td>Zimmertyp</td></tr>\n";

while ($row = mysqli_fetch_assoc($result)){

  echo "<tr><td>{$row['id']}</td><td>{$row['Beschreibung']}</td><td>{$row['Latitude']}</td><td>{$row['Longitude']}</td><td>{$row['Bild']}</td><td>{$row['Preis']} "?> <?php echo "€" ?> <?php echo "</td><td>{$row['Zimmertyp']}</td></tr>\n";

}
  echo "</table>";




?>

<style> 

body {

background-color:  #b6c1c9;
background-image: url(../logo.png);
}

h1{
  font-size: 50px;
 text-align: center;
}

table {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  table td{
    border: 1px solid #ddd;
    padding: 8px;
    
  }

  table tr:nth-child(even){
    background-color: #f2f2f2;
  }

  table tr:hover {
    background-color: #ddd;
    background-color: #008CBA;
  }
  
  table th {
    border: 1px solid #ddd;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #008CBA;
    color: white;
  }

</style>
