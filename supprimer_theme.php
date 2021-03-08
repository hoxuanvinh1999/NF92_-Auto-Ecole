<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>supprimer_theme</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
      <span> Suppression d'un thème</span> <br>
    </div>
    <?php
    $idtheme = $_POST['menutheme'];

    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, "utf8");
    $query = "UPDATE themes SET supprime = 1 WHERE idtheme = $idtheme;";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    }
    else {
        echo "<div class='total'>";
        $query_theme_nom= "SELECT nom from themes WHERE idtheme=$idtheme";
        $result_qtn=mysqli_query($connect,$query_theme_nom);
        if (!$result_qtn) {
            echo "<br>Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
        } else {
        $nomt=mysqli_fetch_array($result_qtn);
        echo "<span> Le thème $nomt[0] (id est $idtheme) a été supprimé avec succès.</span>";
        echo "</div>";
        }
    }
    mysqli_close($connect);
    ?>
  </body>
</html
