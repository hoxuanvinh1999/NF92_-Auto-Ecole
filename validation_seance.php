<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>validation_seance</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
      <span>Validation d'une séance</span> <br>
      <span>Veuillez sélectionner la séance.</span>
    </div>
  <?php
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, "utf8");

    echo "<div class='total'>";
    echo "<form method='POST' action='valider_seance.php'>";

    echo "<div class='row'>";
    echo "<span> Séance:</span>";

    $query = "SELECT idseance, DateSeance, EffMax, seances.idtheme, themes.nom FROM seances, themes WHERE DateSeance < CURRENT_DATE AND themes.idtheme = seances.idtheme;";

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
        echo "<input type='submit' value ='Valider'>";
        echo "</div>";
    }

    echo "</form>";
    echo "</div>";

    mysqli_close($connect);
    ?>
  </body>
</html>
