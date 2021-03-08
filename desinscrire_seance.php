<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>desinscrire_seance</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
  </head>
  <body>
  <div class="note">
    <span>Désinscription d'un élève à une séance</span> <br>
    <span>Résultat: </span> <br>
  </div>

  <?php
  $idEleve = $_POST['eleves'];
  $idSeance = $_POST['seances'];

  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p020';
  $dbpass = 'EvqHyU4R';
  $dbname = 'nf92p020';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  mysqli_set_charset($connect, "utf8");

  $query_verif = "SELECT * FROM inscription WHERE ideleve=$idEleve AND idseance=$idSeance;";
  $result = mysqli_query($connect, $query_verif);
  if (!$result) {
      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
  }

  if (0 == mysqli_num_rows($result)) {
      echo "<div class='total'>";
      echo "<span> L'élève séléctionné n'est pas inscrit à cette séance</span> <br>";
  } else {
      $query = "DELETE FROM inscription WHERE ideleve = $idEleve AND idseance = $idSeance;";
      $result = mysqli_query($connect, $query);
      if (!$result) {
          echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
      }
      else {
          echo "<div class='total'>";
          echo "<span> L'élève $idEleve a été désinscrit de la séance $idSeance avec succès.</span>";
      }
  }
    echo "<div class='row'>";
      echo "<form method='POST' action='desinscription_seance.php'>";
        echo "<input type='submit' value ='Retouner et deinscrire autre seance'>";
      echo "</form>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<form method='POST' action='accueil.html'>";
      echo "<input type='submit' value ='Retouner a Accueil'>";
      echo "</form>";
    echo "</div>";
  echo "</div>";
  mysqli_close($connect);
  ?>
  </body>

</html>
