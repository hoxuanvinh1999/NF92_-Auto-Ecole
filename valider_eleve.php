<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>valider_eleve</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
      <span>Valider Eleve</span> <br>
    </div>
    <?php
    date_default_timezone_set('Europe/Paris');
    $today = date("Y-m-d");
    echo "<div class='note'>";
    echo "<span>La date est:"."'$today'"." <span>  <br> ";
    echo "</div>";
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $dateNaiss=$_POST['date_naissance'];

    echo "<div class='total'>";
    echo "<br><span> Votre information: </span><br>";
    echo "<br><span> Nom: </span>".$nom;
    echo "<br><span> Prenom: </span>".$prenom;
    echo "<br><span> Date de naissance </span>".$dateNaiss;
    echo "<br><span> Date d'inscription </span>".$today;"<br>";
    echo "</div'>";

    $dbhost = 'tuxa.sme.utc';
    $dbuser = 'nf92p020';
    $dbpass = 'EvqHyU4R';
    $dbname = 'nf92p020';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect,"urf8");
    $query = "INSERT INTO eleves VALUES (NULL, '$nom', '$prenom', '$dateNaiss', '$today');";
    $result = mysqli_query($connect, $query);
    if (!$result) {
      echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
    }else {
      echo "<span> <br> On a ajoute success </span>";
    }
    mysqli_close($connect);
    ?>
  </body>
</html>
