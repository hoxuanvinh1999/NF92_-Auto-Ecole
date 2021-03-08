<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>supprimer_seance</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
  <div class="note">
      <span>Suppression d'une séance</span> <br>
  </div>
    <?php
    $idSeance = $_POST['seances'];

    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, "utf8");
    $query = "DELETE FROM seances WHERE idseance=$idSeance;";
    $result = mysqli_query($connect, $query);
    if (!$result) {
      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    } else {
        echo "<div class='total'>";
        echo "<span> La séance a été supprimé avec succès.</span>";
    }

    $query = "DELETE FROM inscription WHERE idseance=$idSeance;";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        echo "<span> <br> Une erreur s'est produite lors de la récupération des données </span>" . mysqli_error($connect);
    } else {
        echo "<span> <br> Tous les élèves ont été désinscrit.</span>";
    }
    echo "</div>";
    mysqli_close($connect);
    ?>
  </body>
</html>
