<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Maison";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Afficher toutes les tables de la base de données
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

// Vérifier si au moins une table a été trouvée
if (mysqli_num_rows($result) > 0) {
    // Afficher le nom de chaque table
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["Tables_in_" . $dbname] . "<br>";
    }
} else {
    echo "Aucune table trouvée dans la base de données.";
}

mysqli_close($conn);
?>
