<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="log.css">
</head>

<body>
  <div class="header">
    <h2>Hausverwaltung Portal</h2>
  </div>
  <form method="post">
    <div class="input">
      <label>Username</label>
      <input type="text" name="username" required="">
    </div>
    <div class="input">
      <label>Password</label>
      <input type="password" name="password" required="">
    </div>
    <div class="input">
      <button type="submit" name="absenden" class="btn">Login</button>
    </div>
    <!-- <p> Nicht einen Mitglied? <a href="registrieren.php">Sign up</a> </p>-->
  </form>
</body>

</html>
<?php
session_start();

require('../Private/password.php');


$db = new mysqli($servername, $username, $DB_PASSWORD, $db_name);

if ($db->connect_error) :
  echo $db->connect_error;
endif;

if (isset($_POST['absenden'])) :
  $username = $_POST['username'];
  $password = $_POST['password'];

  $search_user = $db->prepare("SELECT * FROM Hausverwalter WHERE USERNAME = ? AND PASSWORD = ?");
  $search_user->bind_param('ss', $username, $password);
  $search_user->execute();
  $search_result = $search_user->get_result();

  if ($search_result->num_rows == 1) :
    $search_object = $search_result->fetch_object();
    $_SESSION['user'] = $search_object->USERNAME;

        header("Location: index.php?username=$username");
  //echo 'Funktionniert';

  else :
?>
    <script>
      alert("Ihre Angaben sind leider nicht korrekt!");
    </script>
<?php
  //  echo 'Deine Angaben sind leider nicht korrekt';

  endif;

endif;
?>
