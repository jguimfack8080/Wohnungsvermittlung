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

if (isset($_POST['valider'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM WOHNUNG WHERE Zimmertyp LIKE '%$search%' OR Beschreibung LIKE '%$search%'";

} else {
    $sql = "SELECT * FROM WOHNUNG";
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>PrototypSWE2</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="https://informatik.hs-bremerhaven.de/leaflet/leaflet.css" />
    <link rel="icon" type="image/png" href="../icon.png">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <nav>
        <ul>
            <li><a href="osm.php"><b>Home</b></a></li>
            <li><a href="../Hausverwaltung\login.php"><b>Hausverwaltung</b></a></li>
            <li><a href="#"><b>Hilfe</b></a></li>
        </ul>
    </nav>
    <h1> Wohnungsvermittlung</h1>

    <div class="suche">
        <form class="search" action="" method="POST">
            <input type="text" class="sucheTerm" placeholder="Search" name="search">
            <div class="suche2"><input type="submit" class="sucheButton" value="suche" name="valider"></div>
        </form>
    </div>

    <div class="container">

        <div class="list">

            <?php
            foreach ($db->query($sql) as $row) {

                $id = $row['id'];
                $beschreibung = $row['Beschreibung'];
                $long = $row['Longitude'];
                $lat = $row['Latitude'];
                $bild = $row['Bild'];
                $preis = $row['Preis'];
                $typZimmer = $row['Zimmertyp'];

                $_SESSION['id'] = $id;
                ?>


                <div class="item img1" id="oh" data-lat="<?php echo $lat ?>" data-lng="<?php echo $long; ?>"
                    data-price="<?php echo $preis ?>">
                    <a href="../Reservation/formular.php?id=<?php echo $_SESSION['id']; ?>"><img
                            src="../Images/<?= $row['Bild'] ?>" alt=""></a>
                    <h4>
                        <?php echo $typZimmer ?>
                    </h4>
                    <p>
                        <?php echo $beschreibung ?>

                    </p>
                </div>
            <?php } ?>
        </div>
        <div class="map" id="map"></div>

    </div>
    <!--<script type="text/javascript" src="https://in-->
</body>
<script src="vendor.js"></script>
<script src="securite.js"></script>
<?php
// Traitement de la recherche
if (isset($_POST['valider'])) {
    if (isset($_POST['search_term'])) {
        $search_term = $_POST['search_term'];

        $sql = "SELECT * FROM WOHNUNG WHERE Zimmertyp LIKE :search_term OR  Beschreibung LIKE :search_term";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':search_term', '%' . $search_term . '%', PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $sql = "SELECT * FROM WOHNUNG";
    $data = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>
<script type="text/javascript">
    const data = JSON.parse('<?php echo json_encode($db->query($sql)->fetchAll(PDO::FETCH_ASSOC)); ?>');

    // Code pour afficher les résultats sur la page
    const list = document.querySelector('.list');
    list.innerHTML = '';

    data.forEach(item => {
        const id = item.id;
        const beschreibung = item.Beschreibung;
        const long = item.Longitude;
        const lat = item.Latitude;
        const bild = item.Bild;
        const preis = item.Preis;
        const typZimmer = item.Zimmertyp;

        const itemHTML = `
            <div class="item img1" id="oh" data-lat="${lat}" data-lng="${long}" data-price="${preis}">
                <a href="../Reservation/formular.php?id=${id}"><img src="../Images/${bild}" alt=""></a>
                <h4>${typZimmer}</h4>
                <p>${beschreibung}</p>
            </div>
        `;
        list.innerHTML += itemHTML;
    });

</script>

</html>