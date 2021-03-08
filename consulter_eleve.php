<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>consulter_eleve</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
  </head>
  <body>
  <div class="note">
    <span> Consultation de la fiche d'un élève</span> <br>
    <span> Informations sur l'élève : </span> <br>
  </div>
  <?php
  $ideleve = $_POST['menuEleve'];

  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p020';
  $dbpass = 'EvqHyU4R';
  $dbname = 'nf92p020';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  mysqli_set_charset($connect, "utf8");
  $query = "SELECT * FROM eleves WHERE ideleve=$ideleve;";
  $result = mysqli_query($connect, $query);
  if (!$result) {
      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
  }
  else {
      while ($eleve = mysqli_fetch_array($result)) {
          echo "<div class='total'>";
		  echo "<span>Ideleve : </span>" . $eleve[0];
          echo "<br> <span>Nom : </span>" . $eleve[1];
          echo "<br> <span>Prénom : </span>" . $eleve[2];
          echo "<br> <span>Date de naissance : </span>" . $eleve[3];
          echo "<br> <span>Date d'inscription : </span>" . $eleve[4];
		  echo "</div>";
      }
  }
  mysqli_close($connect);
  ?>
  </body>
</html>
