<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>visualiser_calendrier_eleve</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
      <span> Visualisation du calendrier d'un élève</span> <br>
      <span> Veuillez sélectionner l'élève dont vous souhaitez visualiser le calendrier.</span> <br>
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
        echo "<br>Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    } else {
        echo "<div class='total'>";
        echo "<form method='POST' action='visualiser_calendrier_eleve.php' >";

        echo "<div class='row'>";
        echo "<span> Élève:</span>";
        echo "<select name='menuEleve' size='1' required='required'>";
        while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
            echo "<option value=$row[0]>$row[1] $row[2]</option>";
            }
        echo "</select>";
        echo "</div>";

        echo "<div class='row'>";
        echo "<input type='submit' value='Visualiser'>";
        echo "</div>";

        echo "</form>";
        echo "</div>";

    }
    mysqli_close($connect);
    ?>
  </body>
</html>
