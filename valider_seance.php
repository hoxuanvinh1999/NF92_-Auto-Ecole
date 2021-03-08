<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>valider_seance</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
        <span>Validation d'une séance</span> <br>
    <?php
    $idSeance = $_POST['seances'];
    echo "<br><span>ID de la séance: </span>" . $idSeance . "<br>";
    echo "</div>";
    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, "utf8");
    $query_eleve = "SELECT eleves.ideleve, nom, prenom, note FROM eleves, inscription WHERE eleves.ideleve = inscription.ideleve AND inscription.idseance=$idSeance;";
    $eleve_result = mysqli_query($connect, $query_eleve);
    if (!$eleve_result) {
        echo "<br>Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    } else {
        echo "<div class='total'>";
        if (mysqli_num_rows($eleve_result) != 0) {
            echo "<form method='POST' action='noter_eleves.php' >";


            while ($eleve = mysqli_fetch_array($eleve_result,MYSQL_NUM)) {
                if (-1 < $eleve[3]) {
                    $note_affiche = $eleve[3];
                }
                else {
                    $note_affiche = NULL;
                }
                echo "<div class='row'>";
                echo "<span>$eleve[1] $eleve[2]: </span>";
                echo "<input type='number' min='0' max='40' value='$note_affiche' name='eleve[$eleve[0]][note]' id='$eleve[0]'><br>";
                echo "</div>";

                echo "<input type='hidden' value='$eleve[0]' name='eleve[$eleve[0]][id]'>";
            }
            echo "<input type='hidden' name='idSeance' value='$idSeance'>";

            echo "<div class='row'>";
            echo "<input type='submit' value='Enregistrer notes'>";
            echo "</div>";

            echo "</form>";
        }
        else {
            echo "<span><br>Aucun élève n'est inscrit à cette séance!</span>";
        }
    }
    echo "</div>";
    mysqli_close($connect);
    ?>
  </body>
</html>
