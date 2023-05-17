<?php

require('../Private/password.php');

$db = new mysqli($servername, $username, $DB_PASSWORD, $db_name);

if ($db->connect_error){
  echo $db->connect_error;
}
else{}

    $requered = "SELECT * FROM Mieter";
    $result = mysqli_query($db, $requered);
  
  echo "<h1>Mieter</h1>";
  echo "<table border='1' width=1000>";
  echo "<tr><td>Name des/r Mieters/Mieterin</td><td>Vorname des/r Mieters/Mieterin</td><td>Geburtsdatum</td><td>Einzugsdatum</td><td>Dauer</td><td>Hochscule</td></tr>\n";

while ($row = mysqli_fetch_assoc($result)){

  echo "<tr><td>{$row['NameMi']}</td><td>{$row['VornameMi']}</td><td>{$row['Geburtsdatum']}</td><td>{$row['Einzugsdatum']}</td><td>{$row['Dauer']}</td><td>{$row['Hochschule']}</td></tr>\n";

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
