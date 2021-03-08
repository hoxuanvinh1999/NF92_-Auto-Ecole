<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>desinscription_seance</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
  </head>
  <body>
  <div class="note">
    <span> Désinscription d'un élève à une séance</span> <br>
    <span> Veuillez sélectionner l'élève, et la séance à laquelle vous souhaitez le désinscrire.</span> <br>
  </div>
  <?php
  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p020';
  $dbpass = 'EvqHyU4R';
  $dbname = 'nf92p020';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  mysqli_set_charset($connect, "utf8");
  $query = "SELECT * FROM eleves;";
  $result = mysqli_query($connect, $query);
  if (!$result) {
      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
  }else {
      echo "<div class='total'>";
      echo "<form method='POST' action='desinscrire_seance.php'>";

      echo "<div class='row'>";
        echo "<span>Élèves: </span> </th>";
        echo "<select name='eleves' size='1' required='required'>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value=$row[0]>$row[1] $row[2]</option>";
          }
        echo "</select>";
      echo "</div>";
        echo "<div class='row'>";
          echo "<span> Séances: </span>";
          $query = "SELECT idseance, DateSeance, EffMax, seances.idtheme, themes.nom FROM seances, themes WHERE (DateSeance > CURRENT_DATE) AND (themes.idtheme = seances.idtheme);";
          $result = mysqli_query($connect, $query);
          if (!$result) {
              echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
            } else {
              echo "<select name='seances' size='1' required='required'>";
              while ($row = mysqli_fetch_array($result)) {
                $query_effectif = "SELECT ideleve FROM inscription WHERE idseance=$row[0];";
                $result_effectif = mysqli_query($connect, $query_effectif);
                if (!$result_effectif) {
                    echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
                }
                else {
                    echo "<option value=$row[0]> $row[1] | $row[4]" . " | " . mysqli_num_rows($result_effectif) . "/" . $row[2] . " inscrit(s) </option>";
                }
            }
            echo "</select>";
        echo "</div>";
        echo "<div class='row'>";
            echo "<input type='submit' value='Enregistrer séance'>";
        echo "</div>";
      echo "</form>";
      echo "</div>";
      }
  }
  mysqli_close($connect);
  ?>
  </body>
</html>
