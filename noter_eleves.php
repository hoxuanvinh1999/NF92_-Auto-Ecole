<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>noter_eleves</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
      <span>Notation des élèves lors d'une séance</span> <br>
    <?php
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    $idSeance = $_POST['idSeance'];

    echo "ID de la séance: " . $idSeance . "<br>";
    echo "</div>";

    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, "utf8");
    echo "<div class='total'>";
    foreach ($_POST['eleve'] as $eleve) {

        if ("" != $eleve['note']) {
            $query = "UPDATE inscription SET note = " . $eleve['note'] . " WHERE ideleve = " . $eleve['id'] . " AND idseance = $idSeance;";
            $result = mysqli_query($connect, $query);
            if (!$result) {
                echo "<br> Erreur lors de l'éxécution de la query de notation de l'élève $eleve: <br>" . mysqli_error($connect);
            }
            else {
                echo "<div class='row'>";
                echo "<span>La note $eleve[note] a été attribué à l'élève d'ID $eleve[id]. <br> </span>";
                echo "</div>";
            }
        }
    }
    echo "</div>";
    mysqli_close($connect);
    ?>
  </body>
</html>
