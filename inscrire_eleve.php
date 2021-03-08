<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>inscrire_eleve</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
  <div class="note">
    <span> Inscription d'un élève à une séance</span> <br>
    <span> Résultat de la saisie:</span><br>
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

  $query_veri = "SELECT * FROM inscription WHERE ideleve=$idEleve AND idseance=$idSeance;";
  $result = mysqli_query($connect, $query_veri);
  if (!$result) {
        echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    }else {
      if (0 != mysqli_num_rows($result)) {
          echo "<div class='total'>";
          echo "<span> <br> L'élève séléctionné est déjà inscrit à cette séance! </span>";
      } else {
          $query = "INSERT INTO inscription VALUES ($idEleve, $idSeance, -1);";
          $result = mysqli_query($connect, $query);
          if (!$result) {
                echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
          }
          echo "<div class='total'>";
          echo "<br> ID de l'élève: " .$_POST['eleves'];
          echo "<br> ID de la séance: " .$_POST['seances'];
          echo "<span> <br> L'élève a été inscrit à la séance avec succès! </span> ";
    }
      echo "<div class='row'>";
        echo "<form method='POST' action='inscription_eleve.php'>";
          echo "<input type='submit' value ='Retouner et faire autre inscription'>";
        echo "</form>";
      echo "</div>";
      echo "<div class='row'>";
        echo "<form method='POST' action='accueil.html'>";
          echo "<input type='submit' value ='Retouner a Accueil'>";
        echo "</form>";
      echo "</div>";
    echo "</div>";
    }
  mysqli_close($connect);
  ?>
  </body>
</html>
