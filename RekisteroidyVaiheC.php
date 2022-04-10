<?php session_start(); ?>
<?php
  include_once 'PHP - Funktiot/Connect.php';
  include_once 'PHP - Funktiot/Funktio.php';
  include_once 'PHP - Funktiot/formValidation.php';
  error_reporting(0);

/**PHP Mailer Libarary */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'PHPMailer/PHPMailerAutoload.php';

// Include autoload.php file
require 'vendor/autoload.php';
// Create object of PHPMailer class


$output = '';

$Lisays_PVM = date('Y-m-d');

$sql_LukuoikeusPyyntö = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB4'";
$result_LukuoikeusPyyntö = $conn->query($sql_LukuoikeusPyyntö);

if ($result_LukuoikeusPyyntö->num_rows > 0) {
    while($row = $result_LukuoikeusPyyntö->fetch_assoc()) {
      $LukuoikeusPyyntöLause =$row["Lause"];
    }
}

$Anro = $_SESSION['Asiakasnumero'];
$Enimi = $_SESSION['Enimi'];
$Snimi = $_SESSION['Snimi'];
$Email = $_SESSION['Email'];

  
$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }
}

//Haetaan vahvistusViesti
$sql1="SELECT Lause from tbl_lauseet WHERE Lause_Tunnus = 'W-DB-25'";
$result_1=mysqli_query($conn,$sql1);
$resultCheck=mysqli_num_rows($result_1);

      if($resultCheck > 0){
          while($row =mysqli_fetch_assoc($result_1)){
            $Lause_Vahvistus = $row['Lause'];
          }
      }

//Haetaan Vapaamuotoinen viesti
$Vapaamuotoinen_viesti="SELECT Lause from tbl_lauseet WHERE Lause_Tunnus = 'W-DB-7'";
$Vapaamuotoinen_viesti_result=mysqli_query($conn,$Vapaamuotoinen_viesti);
$resultCheck=mysqli_num_rows($Vapaamuotoinen_viesti_result);

      if($resultCheck > 0){
          while($row =mysqli_fetch_assoc($Vapaamuotoinen_viesti_result)){
            $Vapaamuotoinen_viesti = $row['Lause'];
          }
      }
?>


<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Rekisteröidy vaihe C</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style>
  *{
    font-family: 'Maven Pro', sans-serif;   
}
 
  body
    {
      background-color:white;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  .container>.row > .body
    {
      height:100%;
    }

  .container > .row > .header > .container > .row > ul
    {
      text-align:right;
      margin-left:45em;
      margin-top:-30px;
    }
  .container > .row > .header > .container > .row > ul li
    {
      list-style:none;
      display:inline-block;
      text-transform:uppercase;
      padding-left:5px;
      padding-right:5px;
      font-size:20px;
    }
  .container > .row > .header > .container > .row > ul li:hover
    {
      font-weight: bold;
    }
  .container > .row > .header > .container > .row > ul li a
    {
      display:block;
      text-decoration:none;
      color:black;
      letter-spacing:2px;
    }
  .header >.container >.row >.Logo span
    {
      text-align: center;
      font-size: 20px;
      text-transform: uppercase;
      font-weight: 700;
      letter-spacing: 5px;
      padding-top:15px;
    }
  .header >.container >.row >.Logo
    {
      margin-top:15px;
    }
  .container > .row > .header > .container > .row >.Logo a
    {
      text-decoration:none;
    }
  .container > .row >.body >form
    {
      width:100%;
    }
  .container > .row >.body >form >.container >.row input
    {
      width:525px;
      height:50px;
      margin-bottom:5px;
      text-align:center;
      text-transform:none;
      font-size:20px;
      border: 1px solid black;
      outline:none;
    }
  .container > .row >.body >form >.container >.row input::placeholder
    {
      text-transform:uppercase;
      color: gray;
    }
  .container > .row >.body >form >.container >.row input[type=radio]
    {
      margin-left:-15em;
      margin-top:-5px;
    }

  .container > .row >.body >form >.container >.row label
    {
      font-size:25px;
    }
  .container > .row >.body >form >.container >.row #asiakasnumero{
      width:100%;
      max-height:300px;
    }
  .container > .row >.body >form >.container >.row textarea
    {
      width:100%;
      height:100%;
      max-height:300px;
      border:1px solid black;
      padding-left:10px;
      padding-right:10px;
      font-size:20px;
      padding-top:5px;
      outline:none;
    }
  .container > .row >.body >form >.container >.row textarea::placeholder
    {
      color: gray;
      margin-left:15px;
      font-size:16px;
    }
  .container > .row >.body >form >.container >.row  .fa-info
    {
      position:absolute;
      bottom:2px;
      right:8px;
      width:27px;
      height:40px;
      font-size:23px;
      cursor:pointer;
      color:RGB(244,160,0);
    }
  .container > .row >.body >form >.container >.row >.LTY .fa-info
    {
      position:absolute;
      bottom:2px;
      right:8px;
      width:27px;
      height:55px;
      font-size:23px;
      cursor:pointer;
    }

  .container >.row > .body >form>.KirjauduTeksti
    {
      font-size:20px;
    }
  .container >.row > .body >form>.KirjauduTeksti a
    {
      text-decoration:none;
      color:blue;
      font-weight:bold;
    }
  .container > .row >.body >form  >.row .fa-info
    {
      margin-left:5px;
      cursor:pointer;
      color:RGB(244,160,0);
    }
  .container > .row >.body >form >.container >.row .fa-info
    {
      margin-left:5px;
      cursor:pointer;
      color:RGBA(244,160,0);
    }
    .body > form>.Muokkaa,.Muokkaa_2
      {
        height:50px;
        width:300px;
        text-align:center;
        margin-left:25em;
        text-transform:uppercase;
        letter-spacing:5px;
        font-weight:600;
        background-color:rgb(135,206,250,0.1);
        outline:none;
      }
  .body > .Muokkaa,.Muokkaa_2:hover
      {
        background-color:rgb(135,206,250,0.5);
      }
      .text{
      background-color:#0275d8;
      opacity:1;
    }
    .text:hover{
      color:#0275d8;
      box-shadow:0 0 2px #0275d8, 0 0 2px #0275d8;
    }
    .alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}
.missioBOX{
  width:100%;
  background-color:RGB(244,160,0,0.2);
  margin-top:2.5px;
  margin-bottom:-2.5px;
  DISPLAY:NONE;

}
.MISSIOOTSIKKO {
  text-align:center;
  font-weight:bold;
  padding-top:2px;
}
.MISSIOTEKSTI {
  margin-right:1em;
  padding-left:20px;
  text-align:center;
  font-size:18px;
}
  </style>


<div class="container">
    <div class="row">
        <div class="col-xl header">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 Logo"><a href="index.php">
                        <span style="color:RGB(244,160,0);">Tuottavuus</span>
                        <span style="color:RGB(15,157,88);">klinikat</span>
                      </a></div>
                        <ul>
                            <li><a href="#" class="avaa_1" data-toggle="modal" data-target="#myModal_2">Missio</a></li>
                            <li><a href="uutiskirjetilaus.php">uutiskirjeen tilaus</a></li>

                        </ul>
                </div>
                    <div class="col-6 col-sm-6 col-md col-xl- hamburger">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
            </div>
        </div>
    </div>
</div>
</head>
<?php

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(isset($_POST["submit"]))
{
  header('Location:AsiakasprofiiliC.php');
}


?>
<body>
<script>
$(document).ready(function(){
  $("#Rekisteroidy").click(function(){
    $("#sukunimiboksi").show("slow");
  });
});


</script>

<div class="container">

    <div class="row">
           
<!-- The Modal -->
<div class="modal fade" id="myModal_2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
          <h4 class="modal-title w-100" style="font-size: 30px;text-transform: uppercase;">missiomme</h4>
        </div>
        
        <!-- Modal body -->
        <div style="font-size: 20px;" class="modal-body text-center">
          <?php echo $Lause; ?>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-secondary w-100" data-dismiss="modal" style="border-radius: 0px 0px;font-size: 20px;text-transform: uppercase;">sulje</button>
        </div>
        
      </div>
    </div>
  </div>
    
<script>
    $(document).ready(function(){
      $("#sulje").click(function(){
        $(".missioBOX").hide();
      });
      $("#avaa").click(function(){
        $(".missioBOX").show();
      });
    });
</script>
<style>
.alert-success
    {
      height:100%;
      border-radius: 0% 0%;
      background-color: lightgreen;
    }
.alert-success > h5
    {
      text-align: center;
      font-size: 25px;
      
    }
.alert-success a h5
    {
      text-align: center;
      font-size: 25px;
      margin-top: 1em;
      text-transform: uppercase;
      color:black;
      text-decoration: none;
      font-weight: bold;
    }
.alert-success a:hover h5 
    {
      color:black;
      font-weight: bold;
    }
h6
{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}
</style>
      <div class="col-xl body">
      <?php 
if(isset($_POST['rekisteroidyC']))
  {
    $Asiakasnumero_2 = mysqli_real_escape_string($conn,$_POST['asiakasnumero']);
    $Etunimi = mysqli_real_escape_string($conn,$_POST['etunimi']);
    $Sukunimi = mysqli_real_escape_string($conn,$_POST['sukunimi']);
    $Puhelin = mysqli_real_escape_string($conn,$_POST['puhelinnumero']);
    $Titteli = mysqli_real_escape_string($conn,$_POST['asemaYrityksessa']);
    $Y_tunnus = mysqli_real_escape_string($conn,$_POST['ytunnus']);
    $Sahkoposti = mysqli_real_escape_string($conn,$_POST['Sposti']);
    $VapaaVastaus = mysqli_real_escape_string($conn,$_POST['VapaaVastaus']);
    $YrityksNimi = mysqli_real_escape_string($conn,$_POST['yrityksenNimi']);
    $Liiketoimintaryhma = mysqli_real_escape_string($conn,$_POST['liiketoimintaryhma']);
    $Liiketoimintayksikko = mysqli_real_escape_string($conn,$_POST['liiketoimintayksikko']);
    $Osoite = mysqli_real_escape_string($conn,$_POST['osoite']);
    $PostiNro = mysqli_real_escape_string($conn,$_POST['postinumero']);
    $PostiTmiPaikka = mysqli_real_escape_string($conn,$_POST['postitoimipaikka']);
    $Rakennusliike = mysqli_real_escape_string($conn,$_POST['Rakennusliike']);
    $Kayttajatunnus = mysqli_real_escape_string($conn,$_POST['Kayttajatunnus']);
    
    $Salasana = mysqli_real_escape_string($conn,$_POST['Salasana']);
    $Cryptaus = md5($Salasana);


    $_SESSION['Asiakasnumero_2'] = $Asiakasnumero_2;

    if((empty($_POST['asiakasnumero'])))
    {
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['etunimi']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['sukunimi']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['asemaYrityksessa']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['Sposti']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['puhelinnumero']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['yrityksenNimi']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['ytunnus']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['liiketoimintaryhma']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['liiketoimintayksikko']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['osoite']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['postinumero']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['postitoimipaikka']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['Rakennusliike']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }else if((empty($_POST['VapaaVastaus']))){
      echo "<style>form{display:block;}</style>";
      echo "<style>.avaa{display:none;}</style>";
      echo "<style>.eka{display:block;}</style>";
      echo "<style>.toka{display:none;}</style>";
      echo "<style>.alert-success{display:none;}</style>";
    }
    else
    {

      $InsertQuery ="INSERT INTO tbl_yritykset (Y_tunnus,YrityksNimi,Liiketoimintaryhma,Liiketoimintayksikko,Osoite,PostiNro,PostiTmiPaikka,Rakennusliike,LisattyYritys)
        VALUES ('$Y_tunnus','$YrityksNimi','$Liiketoimintaryhma','$Liiketoimintayksikko','$Osoite','$PostiNro','$PostiTmiPaikka','$Rakennusliike','$Lisays_PVM')";

          $InsertRun = mysqli_query($conn, $InsertQuery) or die (mysqli_error($conn));
            if($InsertRun == 1)
              {
                $Muokkaa1 ="UPDATE tbl_asiakkaat SET Etunimi='$_POST[etunimi]',Sukunimi='$_POST[sukunimi]',Sposti='$_POST[Sposti]',LukuoikeusMyonnetty='EI',LukuoikeusOSTETTU='EI',Puhelin='$_POST[puhelinnumero]',Titteli='$_POST[asemaYrityksessa]',Y_tunnus ='$_POST[ytunnus]', VapaaVastaus='$_POST[VapaaVastaus]',MuokattuAsiakas = '$Lisays_PVM',RekisteroitynytCVaihe='$Lisays_PVM' WHERE Asiakasnumero = '$Asiakasnumero_2'";

                      $KyselyMuokkaa1 = mysqli_query($conn, $Muokkaa1) or die (mysqli_error($conn));
                            if($KyselyMuokkaa1 == 1)
                              {
                                  $InsertQuery2 ="INSERT INTO tbl_kayttajatunnus_c (Kayttajatunnus,Salasana,Password_Hash,Asiakasnumero,Rooli,LisattyKayttajatunnus_c)
                                                  VALUES ('$Kayttajatunnus','$Salasana','$Cryptaus','$Asiakasnumero_2','Asiakas','$Lisays_PVM')";
                                  $InsertRun2 = mysqli_query($conn, $InsertQuery2) or die (mysqli_error($conn));
                                      if($InsertRun2 == 1)
                                          {
                                            $PoistaViiteavantarkistus ="SET FOREIGN_KEY_CHECKS=OFF";
                                            $PoistaViiteavantarkistusKysely = mysqli_query($conn, $PoistaViiteavantarkistus) or die (mysqli_error($conn));
                                                if($PoistaViiteavantarkistusKysely == 1)
                                                  {
                                                    $PoistaBvaiheenKT ="DELETE FROM tbl_kayttajatunnus WHERE Asiakasnumero = '$Asiakasnumero_2'";
                                                    $PoistaBvaiheenKTRun = mysqli_query($conn, $PoistaBvaiheenKT) or die (mysqli_error($conn));
                                                      if($PoistaBvaiheenKTRun == 1)
                                                        {
                                                            // Email Functionality
                                                            date_default_timezone_set('Etc/UTC');
                                                            $mail = new PHPMailer();
                                                            $mail->IsSMTP();
                                                            $mail->CharSet = 'UTF-8';
                                                            $mail->Host = 'smtp.titan.email';             
                                                            $mail->SMTPDebug  = 0;                      
                                                            $mail->SMTPAuth   = true;                   
                                                            $mail->Port       = 465; 
                                                            $mail->SMTPSecure = 'ssl';                     
                                                            $mail->Username   = 'system@chpc.fi';             
                                                            $mail->Password   = 'K_?eEdX=yW5Y';             
                                                            $header ="TUOTTAVUUSKLINIKAT";
                                                            $header .="MIME-Version: 1.0\n\n";
                                                            $header .="Content-type text/html; charset=utf-8";
                                                            // Email ID from which you want to send the email
                                                            $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
                                                            $mail->addAddress($Sahkoposti);
                                                            $mail->Subject = 'Rekisteroityminen - Vaihe C';
                                                            $message = '<html><body>';
                                                            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                                                            $message .= "<tr style='background: #eee;'><td><strong>KÄYTTÄJÄTUNNUS</strong> </td><td><strong>SALASANA</strong></td></tr>";
                                                            $message .= "<tr><td>".$Kayttajatunnus."</td><td>" .  $Salasana . "</td></tr>";
                                                            $message .= "</table>";
                                                            $message .= "<br/><br/>";
                                                            $message .= "NYT VOIT KIRJAUTUA JÄRJESTELMÄÄN <a href='https://chpc.fi/KirjauduVaiheC.php'>TÄSTÄ</a>";
                                                            $message .= "</body></html>";
                                                      
                                                            $mail->Body = $message;
                                                      
                                                            $mail->isHTML(true);

                                                            if ($mail->send()) 
                                                              {
                                                                  
                                                                echo "<style>form{display:none;}</style>";
                                                                echo "<style>.tahti{display:none;}</style>";
                                                                echo "<style>.avaa{display:none;}</style>";
                                                                echo "<style>.eka{display:none;}</style>";
                                                                echo "<style>.toka{display:block;}</style>";
                                                                echo "<style>.alert-success{display:block;}</style>";

                                                                //Lähetetään ADMINILLE Spsti ja tiedostetaan häntä uuden asiakkaan rekisteröitymisestä
                                                                date_default_timezone_set('Etc/UTC');
                                                                $mail = new PHPMailer();
                                                                $mail->IsSMTP();
                                                                $mail->CharSet = 'UTF-8';
                                                                $mail->Host = 'smtp.titan.email';             
                                                                $mail->SMTPDebug  = 0;                      
                                                                $mail->SMTPAuth   = true;                   
                                                                $mail->Port       = 465; 
                                                                $mail->SMTPSecure = 'ssl';                     
                                                                $mail->Username   = 'system@chpc.fi';             
                                                                $mail->Password   = 'K_?eEdX=yW5Y';               
                                                                $header ="TUOTTAVUUSKLINIKAT";
                                                                $header .="MIME-Version: 1.0\n\n";
                                                                $header .="Content-type text/html; charset=utf-8";
                                                                // Email ID from which you want to send the email
                                                                $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
                                                                $mail->addAddress('lukuoikeus@chpc.fi');
                                                                $mail->Subject = 'Uusi lukuoikeuspyyntö';
                                                                $message = '<html><body>';
                                                                $message .= '<h3>Seuraava asiakas on rekisteröitynyt C- vaiheesen ja odottaa lukuoikeuksien myöntämistä</h3><br><br>';
                                                                $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                                                                $message .= "<tr style='background: #eee;'><td><strong>Asiakasnumero</strong> </td><td><strong>NIMI</strong></td></tr>";
                                                                $message .= "<tr><td>".$Asiakasnumero_2."</td><td>" . $Etunimi." ".$Sukunimi. "</td></tr>";
                                                                $message .= "</table>";
                                                                $message .= "<br/>";
                                                                $message .= "</body></html>";
                                                                $mail->Body = $message;
                                                                $mail->isHTML(true);
                                                                $mail->send();
                                                              }
                                                            else
                                                              {
                                                                echo "<script>location='RekisteröityminenError.php'</script>";
                                                              }


                                                          
                                              


                                           }
                                    }
                              }
                        }
                  }
                  else
                  {
                   
                  }
                  


        }
  }
  else
  {
    echo "<style>form{display:block;}</style>";
    echo "<style>.avaa{display:none;}</style>";
    echo "<style>.eka{display:block;}</style>";
    echo "<style>.toka{display:none;}</style>";
    echo "<style>.alert-success{display:none;}</style>";
  }
        
?>
        <p class="otsikko eka">Rekisteröityminen vaihe, C</p>
        <p class="otsikko toka" >Rekisteröityminen vaihe, C, etenee</p>
        <span class="error tahti" style="font-size:18px;">* - Tähdellä merkityt kentät pakollisia</span>
        <br>
        <div class="alert alert-success">
          <h5><?php echo $Lause_Vahvistus; ?></h5>
          <a href="https://chpc.fi/KirjauduVaiheC.php"><h5>kirjaudu järjestelmään</h5></a>
          <br>
          <h5>HUOM! Jos et ole saanut lähettämämme sähköpostia saapuneet kansiosta, tarkista roskapostikansio </h5>
          <br>
          <h5>Mikäli et edelleenkään löydä, ota yhteys asiakaspalveluumme <a href="mailto:info@chpc.fi">info@chpc.fi</a></h5>
        </div>
        <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 "><input type="text" name="asiakasnumero" id="asiakasnumero"  readonly onkeypress="IsInputNumber(event)"  style="width:100%;background-color:rgba(128,128,128,0.2); outline:none;border:none;" placeholder="Asiakasnumero" value="<?php echo $Anro; ?>">
                </div>

                <div class="container ErrorBox" style="margin-left:0em;margin-top:-5px;margin-bottom:5px;width:70em;">
                    <div class="alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                          <strong><?php echo $asiakasnumeroErr; ?></strong>
                    </div>
                </div>



                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Enimi; ?>" id="etunimi" name="etunimi" placeholder="Etunimet" >
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Jos sinulla on useampi etunimi tai yrityksessäsi on useampi saman niminen henkilö, voit erotella etunimet esim. yhdysviivalla ”-”"></i>
                    <span class="error">*</span></div>
                    
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input value="<?php echo $Snimi; ?>" type="text"  id="sukunimi" name="sukunimi" placeholder="Sukunimi" >
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Jos sukunimesi muuttuu, esim. avioliiton kautta, käänny asiakaspalvelumme puoleen perusteluineen info@chpc.fi"></i>
                    <span class="error">*</span></div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $etunimiErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $sukunimiErr; ?></strong>
                        </div>
                    </div>




                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Titteli; ?>"  id="asemaYrityksessa" name="asemaYrityksessa" placeholder="Asema Yrityksessä"  ><span class="error">*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="email" readonly value="<?php echo $Email; ?>" name="Sposti" id="Sposti" placeholder="Henkilön sähköpostiosoite yrityksessä"  >
                     <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Jos sähköpostisi muuttuu, käänny asiakaspalvelumme puoleen perusteluineen info@chpc.fi. On myös erittäin suotavaa, jotta voidaan tunnistaa, että asiakas toimii yrityksessä, että sähköpostissa ilmenee yritykseen yhdistettävissä oleva domain."></i>   
                        
                        <span class="error">*</span></div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $asemaYrityksessaErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $SpostiErr; ?></strong>
                        </div>
                    </div>



                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Puhelin; ?>" id="puhelinnumero" name="puhelinnumero" onkeypress="IsInputNumber(event)" placeholder="Puhelinnumero" ><span class="error">*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 ">

                      <input type="text" value="<?php echo $YrityksNimi; ?>"  onkeypress="IsInputString(event)" id="yrityksenNimi" name="yrityksenNimi" placeholder="Yrityksen nimi" ><span class="error">*</span>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Ole hyvä ja kirjoita yrityksesi nimi virallisessa ja koko muodossaan, jotta sen voi tunnistaa (samassa muodossa) YTJ-rekisteristä. Tarkista muoto linkistä https://tietopalvelu.ytj.fi/. Näin vältytään tunnistukseen liittyvästä jälkipelistä.”"></i>
                    </div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $puhelinnumeroErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $yrityksenNimiErr; ?></strong>
                        </div>
                    </div>





                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Y_tunnus; ?>" id="ytunnus" name="ytunnus" placeholder="Y-tunnus"><span class="error">*</span>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Ole hyvä ja tarkista huolellisesti yrityksesi/sinua koskevan liiketoimintaryhmäsi/liiketoimintayksikkösi Y-tunnus ja kirjoita se oikein juuri siinä muodossa, jossa se on kirjoitettu YTJ-rekisteriin. Muista tarkista se linkistä https://tietopalvelu.ytj.fi/. Näin vältytään tunnistukseen liittyvästä jälkiselvittelystä"></i></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Liiketoimintaryhma; ?>" id="liiketoimintaryhma" name="liiketoimintaryhma"  placeholder="Liiketoimintaryhmä"><span class="error">*</span>
                    <i class="fa fa-info vari" data-toggle="tooltip" data-placement="top" title="Koskee erityisesti isoja yrityksiä. Jos olet pienempi yritys, merkitse tähän yrityksesi nimi ja vastaavan päällikön/johtajan nimi"></i>
                    </div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $ytunnusErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $liiketoimintaryhmaErr; ?></strong>
                        </div>
                    </div>




                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 LTY"><input type="text" value="<?php echo $Liiketoimintayksikko; ?>" id="liiketoimintayksikko" name="liiketoimintayksikko" placeholder="Liiketoimintayksikkö" ><span class="error">*</span>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Koskee erityisesti isoja yrityksiä. Jos olet pienempi yritys, merkitse tähän yrityksesi nimi ja vastaavan päällikön/johtajan nimi" style="top:15px;"></i></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Osoite; ?>" id="osoite" name="osoite" placeholder="Edellä mainitun osoite" >
                        
                    <span class="error" >*</span>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Kirjoita tähän sinua koskevan yrityksen/sinua koskevan liiketoimintaryhmän/liiketoimintayksikön konttorin osoite, joka koskee sinua. Älä siis kirjoita työmaan osoitetta. Tee sekin huolella käyttäen virallisia yrityksessä käytettyjä koko pitkiä nimiä."></i>
                    </div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $liiketoimintayksikkoErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $osoiteErr; ?></strong>
                        </div>
                    </div>


                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 LTY"><input type="text" value="<?php echo $PostiNro; ?>" id="postinumero" name="postinumero" onkeypress="IsInputNumber(event)" placeholder="Postinumero" >
                    <span class="error">*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $PostiTmiPaikka; ?>" id="postitoimipaikka" name="postitoimipaikka" placeholder="Postitoimipaikka"><span class="error">*</span></div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $postinumeroErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $postitoimipaikkaErr; ?></strong>
                        </div>
                    </div>



                    <br><br>
                    <div class="container ErrorBox" style="margin-top:-20px;margin-bottom:15px"></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 " style="font-size:25px;">Onko yrityksesi rakennusliike?<span style="margin-top:5px;font-size:30px;" class="error">*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-2 "><label for="Kyllä">Kyllä</label></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-1 "><input type="radio" id="Rakennusliike" name="Rakennusliike"  value="KYLLA"></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-2 "><label for="EI">EI</label></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-1 "><input type="radio" id="Rakennusliike" name="Rakennusliike"  value="EI"></div>
                    <br><br>
                    <div class="container ErrorBox" style="margin-left:0em;margin-top:-5px;margin-bottom:5px;width:70em;">
                    <div class="alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                          <strong><?php echo $RakennusliikeErr; ?></strong>
                    </div>
                </div>


                    <br><br>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6" style="display:flex;"><input value="<?php echo $Email; ?>" id="Kayttajatunnus" name="Kayttajatunnus"  style="width:27em;margin-right:5px;outline:none;border:none;background-color:rgba(128,128,128,0.2);" type="text" placeholder="Käyttäjätunus" readonly>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" style="margin-right:0.2em;" title="Käyttäjätunnuksena toimii sähköposti" ></i>
                    </div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" name="Salasana" id="Salasana" placeholder="Salasana" style="background-color:rgba(128,128,128,0.2);width:26.1em;margin-right:5px;outline:none;border:none;" value="<?php echo $GeneroiSalasana; ?>" readonly>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top"  title="Salasana generoidaan automaattisesti, voit muutta salasannasi myöhemmin."></i>
                    </div>


                    <br><br>
                   
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 "><textarea maxlength="2001" onkeyup="count_down(this);" value="<?php echo $VapaaVastaus; ?>"  id="VapaaVastaus" name="VapaaVastaus" rows="5" cols="5" placeholder="<?php echo $Vapaamuotoinen_viesti; ?>"><?php echo $VapaaVastaus; ?></textarea></div>
                    <div class="container ErrorBox" style="margin-left:0em;margin-top:-5px;margin-bottom:5px;width:70em;">
                    <span id="MerkkienLaskenta" style="position:absolute;right:90px;margin-top:5px;background-color:transparent;color:red;">0</span><div style="position:absolute;right:40px;margin-top:5px;" class="kautta">/2000</div>
                  </div>
                  <div class="container ErrorBox" style="margin-left:0em;margin-top:-5px;margin-bottom:5px;width:70em;">
                    <div class="alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                          <strong><?php echo $VapaaVastausErr; ?></strong>
                    </div>
                </div>

                
                        <script>
                            function count_down(obj) {
                            var element = document.getElementById('MerkkienLaskenta');
                            element.innerHTML = 0 + obj.value.length;

                            if (0 + obj.value.length > 2000) {
                                element.style.color = 'red';
                                document.getElementById('MerkkienLaskenta').innerHTML = 'Olet ylittänyt sallitun merkkirajan'+" "+obj.value.length;

                            } else {
                                element.style.color = 'green';
                            }
                        }
                    </script>
                    <script>
                        $("#Sposti").keyup(function(){
                            update();
                        });

                        function update() {
                          $("#Kayttajatunnus").val($('#Sposti').val());
                        }
                    </script>


                </div>
            </div>
            <br>
                <p class="KirjauduTeksti">Jos sinulla on tunnukset, kirjaudu<a href ="KirjauduVaiheC.php"> tästä</a></p>
                <button type="submit" name="rekisteroidyC" id="rekisteroidyC" style="outline:none;" class="Muokkaa btn btn-outline-primary text">Rekisteröidy</button>
              </form>



<div class="container Tietoja">
    <div class="row">
         <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 teksti">
            <?php
						if($resultCheck > 0){
							while($row=mysqli_fetch_assoc($result_9)){
							 echo $row['Lause'];
							}
			  			}
					  ?>
          </div>

    </div>
</div>

<p class="avaa" data-toggle="modal" data-target="#myModal" style="display: block;" >Lue tietosuojakäytännöstämme <strong>tästä</strong></p>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="text-transform:uppercase;">Tietosuojaseloste</h4>
        </div>
        <div class="modal-body">
          <ol>
            <?php 
                // Hankitaan LOPUT TIETOSUOJALASUEET
                $Hae_Tietosuoja = "SELECT * from tbl_lauseet WHERE Lause_Tunnus Like 'Tietosuoja%'";
                $result_Hae_Tietosuoja = $conn->query($Hae_Tietosuoja);

                if ($result_Hae_Tietosuoja->num_rows > 0) {

                    while($row = $result_Hae_Tietosuoja->fetch_assoc()) {
                      $Tietosuoja = $row["Lause"]; 
                      echo " <li>
                           $Tietosuoja
                            </li>";
                    }
                }
            ?>
            
            
        </ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" style="border:2px solid red;color:red;font-weight:bold;width:100%;" data-dismiss="modal">SULJE IKKUNA</button>
        </div>
      </div>
    </div>
  </div>       
          
          
      </div>
    </div>
  </div>
</body>



<footer>
  <div class="container">
    <div class="row">
      <div class="col-xl footer">
        <div class="container">
          <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  Logo"><span style="color:RGB(244,160,0);letter-spacing:1px;">Tuottavuus</span><span style="color:RGB(15,157,88);letter-spacing:1px;">klinikat</span> pidättää kaikki oikeudet kotisivuilla julkaistavaan aineistoon</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script src="JS-Skriptit/FormValidation.js"></script>

</html>
