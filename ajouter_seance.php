<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ajouter_seance</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
  <div class="note">
    <span> Ajout d'une séance</span>
  </div>

  <?php
  date_default_timezone_set('Europe/Paris');
  $today = date("Y-m-d");

    $effectif = $_POST['effectif'];
    $date = $_POST['date'];
    $annee=substr($date,0,4);
    $mois=substr($date,5,2);
    $jour=substr($date,8,2);

    if (is_numeric($annee) AND is_numeric($mois) AND is_numeric($jour)) {
        $date_valide = checkdate($mois,$jour,$annee);
    } else {
        $date_valide = FALSE;
    }
    $date_today = date_create($today);
    $date_seance = date_create_from_format("Y-m-d", $date);

    if (is_null($_POST['menutheme']) OR empty($effectif) OR ($date_today>$date_seance) OR ($date_seance == FALSE) OR ($date_valide == FALSE)) {
        echo "<div class='total'>";
        echo "<br><span> Vous devez compléter les informations suivantes:</span> <br>";
        if (is_null($_POST['menutheme'])) {
            echo "<span> -Vous devez choisir un thème.</span>";
        }
        if (empty($effectif)) {
            echo "<span> <br> -Vous devez choisir un effectif.</span>";
        }
        if (($date_today>$date_seance) OR ($date_seance == FALSE) OR ($date_valide == FALSE)) {
            echo "<span>  <br> -Vous devez saisir une date de séance correcte.</span>";
        }
          echo "<div class='row'>";
            echo "<form method='POST' action='ajout_seance.php'>";
              echo "<input type='submit' value ='Retouner et Ajouter autre seance'>";
            echo "</form>";
          echo "</div>";


          echo "<div class='row'>";
              echo "<form method='POST' action='accueil.html'>";
                echo "<input type='submit' value ='Retouner a Accueil'>";
              echo "</form>";
          echo "</div>";
        echo "</div>";
    }else {
        $idTheme = $_POST['menutheme'];
    	$dbhost = 'tuxa.sme.utc';
    	$dbuser = 'nf92p020';
    	$dbpass = 'EvqHyU4R';
    	$dbname = 'nf92p020';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        mysqli_set_charset($connect, "utf8");

        $query = "SELECT * FROM seances WHERE idTheme='$idTheme' AND DateSeance='$date'; ";
        $result = mysqli_query($connect, $query);
        if (!$result) {
            echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
        }

        if ($unknow = mysqli_fetch_array($result, MYSQL_NUM)) {
            echo "<div class='total'>";
            echo "<span> <br> Vous devez compléter les informations suivantes:</span>";
            echo "<span> Impossible de sélectionner un thème plusieurs fois dans une même journée.<span>
                  Cependant, une séance portant sur le même thême existe déja le $date.<br>
                  Veuillez sélectionner une autre date ou un autre thème et réessayer.</span>";
                    echo "<div class='row'>";
                      echo "<form method='POST' action='ajout_seance.php'>";
                        echo "<input type='submit' value ='Retouner et Ajouter autre seance'>";
                      echo "</form>";
                    echo "</div>";
                    echo "<div class='row'>";
                      echo "<form method='POST' action='accueil.html'>";
                        echo "<input type='submit' value ='Retouner a Accueil'>";
                      echo "</form>";
                    echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='total'>";
            echo "<br> <span> Résultat de la saisie: </span>";
            echo "<br> <span> ID Thème:</span> " . $idTheme;
            echo "<br> <span> Effectif:</span> " . $effectif;
            echo "<br> <span> Date:</span> " . $date;

            $query = "INSERT INTO seances VALUES (NULL, '$date', '$effectif', '$idTheme');";

            $result = mysqli_query($connect, $query);
            if (!$result) {
                echo "<br> Pas bon" . mysqli_error($connect);
            }
            else {
                echo "<span> <br> La séance a été ajoutée avec succès.</span>";
                echo "</div>";
            }
        }
        mysqli_close($connect);
    }
  ?>
  </body>
</html>
