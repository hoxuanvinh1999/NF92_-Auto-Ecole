<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ajout_eleve</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
    <div class="note">
      <span> Ajout d'un élève à l'auto-école </span> <br>
     <?php
     date_default_timezone_set('Europe/Paris');
     $today = date("Y-m-d");
     echo "<span> Aujourd'hui:"."'$today'"."<span> </br> ";
     echo "<span> Résultat de la saisie:</span> <br>";
     echo "</div>";
     $nom=$_POST['nom'];
     $prenom=$_POST['prenom'];
     $dateNaiss=$_POST['date_naissance'];
     if (strlen($dateNaiss)==10) {
       $annee=substr($dateNaiss,0,4);
       $mois=substr($dateNaiss,5,2);
       $jour=substr($dateNaiss,8,2);
       if (is_numeric($annee) and is_numeric($mois) and is_numeric($jour)) {
         $date_valide = checkdate($mois,$jour,$annee);
       } else {
         $date_valide = False;
       }
       $date_today=date_create($today);
       $date_birth=date_create_from_format("Y-m-d",$dateNaiss);
       if (empty($nom) or empty($prenom) or is_numeric($nom) or is_numeric($prenom) or ($date_today<$date_birth) or ($date_birth==false) or ($date_valide==false)) {
         echo"<br> <span> Recommencer, il y a une error avec votre saisie <span> <br>";
         if (empty($nom) or is_numeric($nom)) {
           echo "<br><span> Saisir un nom correct, pas de numbre <span><br>";
         }
         if (empty($prenom) or is_numeric($prenom)) {
           echo "<br><span> Saisir un nom correct, pas de numbre <span><br>";
         }
         if (($date_today<$date_birth) or ($date_birth==false) or ($date_valide==false)) {
           echo "<br><span> Saisir un date de naissance correct <span><br>";
         }
       } else {

         echo "<div class='total'>";
          echo "<div class='row'>";
          echo "<br>Votre information:<br>";
          echo "<br>Nom: ".$nom;
          echo "<br>Prenom: ".$prenom;
          echo "<br>Date de naissance: ".$dateNaiss;
          echo "<br>Date d'inscription: ".$today;"<br>";
          echo "</div>";

         //$fp=fopen('eleve.txt','a+');
         //fwrite($fp,$nom);
         //fclose($fp);


         $dbhost = 'tuxa.sme.utc';
         $dbuser = 'nf92p020';
         $dbpass = 'EvqHyU4R';
         $dbname = 'nf92p020';
         $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
         mysqli_set_charset($connect,"urf8");
         $query = "SELECT nom, prenom FROM eleves WHERE nom='$nom' and prenom='$prenom'; ";
         $result = mysqli_query($connect, $query);
         if (!$result) {
           echo "<br> <span> Une erreur s'est produite lors de la récupération des données </span> <br>" . mysqli_error($connect);
         } else {
           if ($unknow=mysqli_fetch_array($result,MYSQL_NUM)) {
             echo "<br>";
             echo "<br> <span> Eleve: $unknow[0] $unknow[1] exist deja, refaie votre inscription? <span>";
             echo "<div class='row'>";
               echo "<form method='post' action='valider_eleve.php'>";
               echo "<input type='hidden' name='nom' value='$nom'>";
               echo "<input type='hidden' name='prenom' value='$prenom'>";
               echo "<input type='hidden' name='date_naissance' value='$dateNaiss'>";
               echo "<input type='submit' value='Oui'>";
               echo "</form>";
            echo "</div>";

            echo "<div class='row'>";
             echo "<form action='ajout_eleve.html' method='post'>";
                 echo "<input type='submit' value='Non'>";
             echo "</form>";
            echo "</div>";
          echo "</div>";
           } else {
             $query= $query = "INSERT INTO eleves VALUES (NULL, '$nom', '$prenom', '$dateNaiss', '$today');";
             $result = mysqli_query($connect, $query);
             if (!$result) {
               echo "<br> Une erreur s'est produite lors de la récupération des données" . mysqli_error($connect);
             }else {
               echo "<br> <span> On a ajoute success </span>";
             }
           }
         }
         mysqli_close($connect);
       }
     }else {
       echo "<br><span> Saisir un date de naissance correct <span><br>";
     }


     ?>
  </body>
</html>
