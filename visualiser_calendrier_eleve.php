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
        <span> Visualisation du calendrier d'un élève </span> <br>
    </div>
    <?php
    $ideleve = $_POST['menuEleve'];

    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, "utf8");

    $query = "SELECT prenom, nom FROM eleves WHERE ideleve=$ideleve;";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        echo "<br>Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    } else {
        if ($eleve = mysqli_fetch_array($result)) {
          echo "<div class='total'>";
            echo "<span> <br> Calendrier de $eleve[0] $eleve[1]: </span> <br>";
            echo "<br>";
        }
        echo "<table border='1'>";
        echo "<tr> <th>Inscription</th> <th>Date</th> <th> Theme </th></tr>";
        $query_will = "SELECT seances.DateSeance, themes.nom FROM themes, seances, inscription WHERE inscription.ideleve = $ideleve AND seances.idseance = inscription.idseance AND seances.idtheme = themes.idtheme AND seances.DateSeance > CURRENT_DATE;";
        $result_will = mysqli_query($connect, $query_will);
        if (!$result_will) {
            echo "<br>Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
        } else {
            if(0 != mysqli_num_rows($result_will)) {
                while ($row = mysqli_fetch_array($result_will)) {
                    echo "<tr> <td> OUI </td> <td>$row[0]</td> <td>$row[1]</td> </tr>";
                }
            }
        }
        $query_wont = "SELECT * FROM seances WHERE (DateSeance > CURRENT_DATE) AND seances.idSeance NOT IN (SELECT idseance FROM inscription WHERE ideleve=$ideleve);";
        $result_wont = mysqli_query($connect, $query_wont);
        if (!$result_wont) {
            echo "<br>Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
        } else {
            if(0 != mysqli_num_rows($result_wont)) {
                while ($row = mysqli_fetch_array($result_wont)) {
                     $query_theme_nom= "SELECT nom from themes WHERE idtheme=$row[3]";
                     $result_qtn=mysqli_query($connect,$query_theme_nom);
                     if (!$result_qtn) {
                         echo "<br>Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
                     } else {
                    $nomt=mysqli_fetch_array($result_qtn);
                    echo "<tr> <td> NON </td> <td>$row[1]</td> <td>$nomt[0]</td> </tr>";
                    }
                }
            }
        }
    echo "</table>";
    echo "</div>";
    }
    mysqli_close($connect);
    ?>
  </body>
</html>
