<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ajouter_theme</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
      <span>Ajout d'un thème</span> <br>
    </div>
  <?php
  date_default_timezone_set('Europe/Paris');
  $date = date("Y-m-d");

  $nom = $_POST['nom'];
  $description = $_POST['description'];

  if (empty($description) OR is_numeric($nom) OR empty($nom)) {
      echo "<div class='total'";
      echo "<br><span> Vous devez compléter les informations suivantes: </span>";
      if (empty($nom) OR is_numeric($nom)) {
          echo "<span><br> -Vous devez saisir un nom correctement, pas un numéro!</span>";
      }
      if (empty($description)) {
          echo "<span><br> -Vous devez remplir une description!</span>";
      }
      echo "</div>";
  }

  else {
    $description = str_replace(array("'", '"'), '`', $description);
    $nom = str_replace(array("'", '"'), '`', $nom);

  	$dbhost = 'tuxa.sme.utc';
  	$dbuser = 'nf92p020';
  	$dbpass = 'EvqHyU4R';
  	$dbname = 'nf92p020';
      $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
      mysqli_set_charset($connect, "utf8");
      $query = "SELECT * FROM themes WHERE nom='$nom';";
      $result = mysqli_query($connect, $query);
      if (!$result) {
          echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
      }
      else {
          if ($unknow = mysqli_fetch_array($result, MYSQL_NUM)) {
              if ($unknow[2] == 1) {
                  $query = "UPDATE themes SET supprime = 0 WHERE idtheme = $unknow[0];";
                  $result = mysqli_query($connect, $query);
                  if (!$result) {
                      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
                  }
                  else {
                      echo "<div class='total'";
                      echo "<br><span> Le thème '$nom' précédemment supprimé, a été réactivé.</span><br>";
                      echo "</div";
                  }
              } else {
                  echo "<div class='total'";
                  echo "<br><span> Vous devez entrer un nom différent pour le theme.</span><br>";
                  echo "<span> Le thème '$nom' existe déjà</span>";
              }
              echo "<span> <br> Voici sa description:</span>";
              echo "<span> $unknow[3]</span>";


              echo "<form method='POST' action='ajout_theme.html'>";
                echo "<div class='row'>";
                echo "<input type='submit' value ='Retouner et Ajouter autre theme'>";
                echo "</div>";
                echo "</form>";

                echo "<div class='row'>";
                echo "<form method='POST' action='accueil.html'>";
                  echo "<input type='submit' value ='Retouner a Accueil'>";
                  echo "</form>";
                echo "</div>";
              echo "</div>";

          } else {
              echo "<div class='total'";
              echo "<span> Résultat de la saisie: </span> <br>";
              echo "<span> Nom du thème: </span>" . $nom;
              echo "<br><span> Description: </span>" . $description;
              $query = "INSERT INTO themes VALUES (null, '$nom', 0, '$description'); ";
              $result = mysqli_query($connect, $query);
              if (!$result) {
                  echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
              }
              else {
                  echo "<span> <br> Le thème a été ajouté avec succès.</span>";
                  echo "</div";
              }
          }
      }
      mysqli_close($connect);
  }
  ?>
  </body>
</html>
