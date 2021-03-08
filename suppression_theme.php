<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>suppression_theme</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
  <div class="note">
    <span>Suppression d'un thème</span><br>
    <span>Veuiller sélectionner le thème à supprimer.</span><br>
  </div>
    <?php
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, "utf8");
    $query = "SELECT * FROM themes WHERE supprime=0;";
    $result = mysqli_query($connect, $query);
    if (!$result) {
      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    } else {
      echo "<div class='total'>";
      echo "<form method='POST' action='supprimer_theme.php' >";

      echo "<div class='row'>";
      echo "<span> Thème: </span>";
      echo "<select name='menutheme' size='1' required='required'>";
      while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
          echo "<option value=$row[0]>$row[1]</option>";
      }
      echo "</select>";
      echo "</div>";

      echo "<div class='row'>";
      echo "<input type='submit' value='Supprimer'>";
      echo "</div>";

      echo "</form>";
      echo "</div>";
    }
    mysqli_close($connect);
    ?>
  </body>
</html>
