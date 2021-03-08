<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>statistique_eleve</title>
    <link rel="stylesheet" href="decoration.css" type="text/css">
    <link rel="icon" href="student.svg">
  </head>
  <body>
  <div class="note">
    <span> Statistiques générales de l'auto-école</span> <br>
    <span> Voici les statistiques de réussite, par thème du code de la route.</span> <br>
  </div>
  <?php
  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p020';
  $dbpass = 'EvqHyU4R';
  $dbname = 'nf92p020';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  mysqli_set_charset($connect, "utf8");
  $query = "SELECT * FROM themes";
  $result=mysqli_query($connect,$query);
  echo "<div class='total'>";
  echo "<table border='1'>";
  echo "<tr><th>Nom du thème</th><th>Pourcentage de réussite</th><th>Moyenne (/40)</th></tr>";
  while ($row=mysqli_fetch_array($result))
   {
	   $quality=0;
	   $num=0;
	   $sum=0;
	   $query2="SELECT note FROM inscription,seances WHERE (seances.idseance=inscription.idseance) AND (seances.idtheme=$row[0]) AND (note != -1)";
	   $result2=mysqli_query($connect,$query2);
	   if ( count($result2) != 0 ) 
	    {
		   while ($row2=mysqli_fetch_array($result2)) 
		   {
			 $num=$num+1;  
		     if ($row2[0] >=20) 
			 {
				 $quality=$quality+1;
			 }
		   $sum=$row2[0]+$sum;
	      }
		 if ($num != 0)
		 {	 
			$moy=round( $sum/$num ,2);
			$pass=round ($quality*100/$num ,2);
		 } else 
		  {	
			$moy=0;
			$pass=0;
		  }
		 echo "<tr> <td>$row[1]</td> <td>$pass%</td> <td>$moy</td> </tr>";
		}
   }			   
  echo "</table>";
  echo "</div>";
  mysqli_close($connect);
  ?>
  </body>
</html>
