<?php session_start(); 
include_once 'PHP - Funktiot/Connect.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Lomake-PHP</title>
</head>
<body>


<?php 
/*
$Asiakasnumero = $etunimi = $sukunimi = $sposti  =  $kayttajatunnus = $salasana = "";

if(!isset($_POST['asiakasnumero']) || isset($_POST['etunimi']) || isset($_POST['sukunimi']) || isset($_POST['Sposti']) || isset($_POST['kayttajatunnus']) || isset($_POST['salasana']) ){
$Asiakasnumero = $_POST['asiakasnumero'];
$etunimi = $_POST['etunimi'];
$sukunimi = $_POST['sukunimi'];
$sposti = $_POST['Sposti'];
$kayttajatunnus = $_POST['sukunimi'];
$salasana = $_POST['salasana'];

}
//echo "Asiakasnumero: ".$Asiakasnumero."</br>";
//echo "Etunimi: ".$etunimi."</br>";
//echo "Sukunimi: ".$sukunimi."</br>";
//echo "Sposti: ".$sposti."</br>";
//echo "Käyttäjätunnus: ".$kayttajatunnus."</br>";
//echo "Salasana: ".$salasana."<br><br>";  

//$_SESSION['asiakasnumero'] = $Asiakasnumero;
//$_SESSION['Etunimi'] = $etunimi;
//$_SESSION['Sukunimi'] = $sukunimi;
//$_SESSION['Sahkoposti'] = $sposti;
//$_SESSION['kayttajatunnus'] = $kayttajatunnus;
//$_SESSION['salasana'] = $salasana;


echo "-------------------------------<br>";
$_SESSION['asiakasnumero'] = $Asiakasnumero;
$_SESSION['Etunimi'] = $etunimi;
$_SESSION['Sukunimi'] = $sukunimi;
$_SESSION['Sahkoposti'] = $sposti;
$_SESSION['kayttajatunnus'] = $sukunimi."-B";
$_SESSION['salasana'] = $salasana; 
    
echo "Asiakasnumero: ".$_SESSION['asiakasnumero'];
echo "<br>";
echo "Etunimi: ".$_SESSION['Etunimi'];
echo "<br>";
echo "Sukunimi: ".$_SESSION['Sukunimi'];
echo "<br>";
echo "Käyttäjätunnus: ".$_SESSION['kayttajatunnus'];
echo "<br>";
echo "Salasana: ".$_SESSION['salasana']; 
	
header("refresh:5; url=AsiakasprofiiliB.php");  
*/


if (isset($_POST['rekisteroidyB']))
  {
      $asiakasnumero = $_POST['asiakasnumero'];
      $etunimi = mysqli_real_escape_string($conn,$_POST['etunimi']);
      $sukunimi = mysqli_real_escape_string($conn,$_POST['sukunimi']);
      $sahkoposti = mysqli_real_escape_string($conn,$_POST['Sposti']);
      $kayttajatunnus = mysqli_real_escape_string($conn,$_POST['kayttajatunnus']);
      $salasana = mysqli_real_escape_string($conn,$_POST['salasana']);

      $hashSalasana = password_hash($salasana, PASSWORD_BCRYPT);

      $insert1 ="INSERT INTO tbl_asiakkaat (Asiakasnumero,Etunimi,Sukunimi,Sposti) VALUES ('$asiakasnumero','$etunimi','$sukunimi','$sahkoposti')";
      $kysely1 = mysqli_query($conn, $insert1) or die (mysqli_error($conn));
        if($kysely1 == 1)
          {
              $insert2 = "INSERT INTO tbl_kayttajatunnus (Kayttajatunnus,Salasana,Asiakasnumero,Rooli) VALUES ('$kayttajatunnus','$hashSalasana','$asiakasnumero','Asiakas')";
              $kysely2 = mysqli_query($conn, $insert2) or die (mysqli_error($conn));
                if($kysely2==1)
                  {
                    echo "Data inserted";
                  }
          }
        else
            {
                echo "Data Not Inserted";
                
            }
        header("refresh:5; url=RekisteroitymisVahvistusB.php");
        }

?> 




</body>
</html>