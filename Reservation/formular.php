<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="formular.css">
</head>

<body>

    <div class="header">
        <h2>Formular für die Zimmer Mietung</h2>
    </div>

    <form method="post" autocomplete="on">
        <div class="input">
            <label>Name</label>
            <input type="text" name="name" id="username" required="">
        </div>

        <div class="input">
            <label>Vorname</label>
            <input type="text" name="vorname" id="vorname" required="">
        </div>
        <div class="input">
            <label>Geburtsdatum</label>
            <input type="date" name="Geburtsdatum" id="Geburtsdatum" required="">
        </div>
        <div class="input">
            <label>Einzugsdatum</label>
            <input type="date" name="Einzugsdatum" id="password" required="">
        </div>
        <div class="input">
            <label>Wie lange?</label>
            <input type="text" name="dauer" id="dauer"
                placeholder="Es muss mindestens 3 Monaten sein. Bitte geben Sie nur die Zahl ein." required="">
        </div>
        <div class="input">
            <label>Wo studieren sie?</label>
            <select name="selector" id="hs-select" required="">
                <option value="Bremen" id="hsBremen" name="Bremen">Hochschule Bremen</option>
                <option value="Bremerhaven" id="hsBremerhaven" name="Bremerhaven">
                    Hochschule Bremerhaven
                </option>
                <option value="nichts" id="" name="nichts">Meine Universität ist nicht in der Liste.</option>
            </select><br>
        </div>
        <input type="submit" id='popup' class="btn" name="absenden"></button>

    </form>

    <?php
    session_start();

    $id_session = $_GET['id'];
    //echo $id_session;
//var_dump(PDO::getAvailableDrivers());//Pour voir tous les drivers de gestion de donnees
    
    // define() est utilise pour declarer des constantes
//nom de ma base de donnee
// nom de utilisateur
// Pour que sil ya une erreur lerreur soit 
//signale et visible a lecran
    
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

    if (isset($_POST["absenden"])) {
        $name = $_POST['name'];
        $vorname = $_POST['vorname'];
        $date1 = strtr($_REQUEST['Geburtsdatum'], '/', '_');
        $date2 = strtr($_REQUEST['Einzugsdatum'], '/', '_');
        $dateGeburt = date('Y-m-d', strtotime($date1));
        $dateEinzug = date('Y-m-d', strtotime($date2));
        $uni = $_POST['selector'];
        $dauer = $_POST['dauer'];

        $currentTime = $date = date('Y-m-d');
        //if( $dateEinzug >= $currentTime && $uni != "nichts"){
        if ($dateEinzug >= $currentTime && $uni != "nichts") {

            if ($id_session !== null) {

                $sql = "INSERT INTO Mieter(NameMi, VornameMi, Geburtsdatum, Einzugsdatum, Dauer, Hochschule) VALUES (:NameMi, :VornameMi, 
        :Geburtsdatum, :Einzugsdatum, :Dauer, :Hochschule )";

                if ($id_session != null) {
                    if ($dauer > 3) {
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':NameMi', $name);
                        $stmt->bindParam(':VornameMi', $vorname);
                        $stmt->bindParam(':Geburtsdatum', $dateGeburt);
                        $stmt->bindParam(':Einzugsdatum', $dateEinzug);
                        $stmt->bindParam(':Dauer', $dauer);
                        $stmt->bindParam(':Hochschule', $uni);
                        $stmt->execute();



                        //echo $id_session . "<br>";
    
                        //Pour supprimer l'annonce sur le site une fois que la reseravtion a ete faite
                        $deleteRequest = "DELETE FROM WOHNUNG WHERE id = :id";

                        //Preparons notre requette
                        $stmt_1 = $db->prepare($deleteRequest);
                        $stmt_1->bindParam(':id', $id_session);
                        $stmt_1->execute();


                        $_SESSION['name'] = $name;
                        $_SESSION['vorname'] = $vorname;
                        $_SESSION['geburtsdatum'] = $dateGeburt;
                        $_SESSION['dateEinzug'] = $dateEinzug;
                        $_SESSION['uni'] = $uni;
                        $_SESSION['dauer'] = $dauer;


                        ?>

                        <script> alert("Ihre Reservierung wurde erfolgreich durchgeführt. Sie werden in den nächsten Stunden kontaktiert, um den Vertrag zu unterzeichnen und die Wohnung zu übergeben.\n\nUnser Team wünscht Ihnen einen schönen Tag.")


                            if (window.confirm('Wenn Sie ok klicken werden Sie weitergeleitet.')) {
                                window.location.href = 'confirmation.php';

                            };

                        </script>';
                    <?php //echo "Ajout reussi";
                        //header("location:osm.php");
                        //}
                    } else {
                        echo "Überprüfen Sie bitte Ihre Angaben";
                    }
                } else {
                    echo "Id introuvable";
                }
                //echo $_SESSION['id'];
    
            } else {
                echo "Vous ne pouvez pas reserver";
            }
        } else {


            ?>
            <script>  alert("Das eingegebene Einzugsdatum muss in der  Zukunft oder heute liegen.\n Sie müssen auch ein Student der Hochschule Bremen oder Bremerhaven sein.");   </script>
            <?php
        }
    }

    ?>
</body>

</html>