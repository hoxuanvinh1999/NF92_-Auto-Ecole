<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>consultation_eleve</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
  </head>
  <body>
  <div class="note">
    <span> Consultation de la fiche d'un élève</span> <br>
    <span> Veuillez sélectionner l'élève dont vous souhaitez consulter la fiche.</span> <br>
  </div>

  <?php
  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p020';
  $dbpass = 'EvqHyU4R';
  $dbname = 'nf92p020';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  mysqli_set_charset($connect, "utf8");
  $query = "SELECT ideleve, nom, prenom FROM eleves;";
  $result = mysqli_query($connect, $query);
  if (!$result) {
      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
  }
  else {
      echo "<div class='total'>";
      echo "<form method='POST' ACTION='consulter_eleve.php' >";

      echo "<div class='row'>";
        echo "<span> Élève :</span>";
        echo "<select name='menuEleve' size='1' required='required'>";
        while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
            echo "<option value=$row[0]>$row[1] $row[2]</option>";
          }
        echo "</select>";
      echo "</div>";

      echo "<div class='row'>";
        echo "<input type='submit' value='Consulter'>";
      echo "</div>";

      echo "</form>";
      echo "</div>";
  }
  mysqli_close($connect);
  ?>
</body>
</html>
