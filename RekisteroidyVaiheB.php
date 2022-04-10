<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Connect.php';
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Index_sql_query.php';
require 'PHPMailer/PHPMailerAutoload.php';

//Haetaan vahvistusViesti, ok
$sql1="SELECT Lause from tbl_lauseet WHERE Lause_Tunnus = 'W-DB-19'";
$result_1=mysqli_query($conn,$sql1);
$resultCheck=mysqli_num_rows($result_1);

      if($resultCheck > 0){
          while($row =mysqli_fetch_assoc($result_1)){
            $Lause_Vahvistus = $row['Lause'];
          }
      }

//Haetaan vahvistusViesti, virhe
$sql2="SELECT Lause from tbl_lauseet WHERE Lause_Tunnus = 'W-DB-20'";
$result_2=mysqli_query($conn,$sql2);
$resultCheck=mysqli_num_rows($result_2);

      if($resultCheck > 0){
          while($row =mysqli_fetch_assoc($result_2)){
            $Lause_Vahvistus_Error = $row['Lause'];
          }
      }

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }

}

$Lisays_PVM = date('Y-m-d');

?>


<!DOCTYPE html>
<html lang="fi-Fi">
<head>
  <title>CHPC- Rekisteröidy vaihe B</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  


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

  .container > .row > .body > form >.row
      {
        text-transform:uppercase;
        text-align:center;
      }
  .container > .row > .body > form >.row > div input[type=text],input[type=username],input[type=email],input[type=password]
      {
        padding-left:5px;
        text-align:center;
        width:750px;
        height:55px;
        outline:none;
        text-transform:none;
      }
  .container > .row > .body > form >.row  .label
      {
        text-align:center;
        font-size:20px;
        margin-bottom:5px;
        text-transform:none;
      }
  .container > .row > .body > form >.row   input[type=text],input[type=username],input[type=email]
      {
        font-size:25px;
      }
  .errorTeksti
      {
        font-size:18px;
        color:red;
        margin-left:1.2em;
        margin-bottom:10em;
      }
  .error
      {
        color:red;
        font-size:2em;
        position: absolute;
        margin-top: -8px;
        padding-left:9px;
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
  .container > .row >.body >form  >.row .fa-info
      {
        margin-left:-19px;
        cursor:pointer;
        color:RGB(244,160,0);
        margin-top:20px;
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



    
/*RESPONSIIVISUUS*/
  /*Jos näytön leveys on 600px tai pienempi*/
@media only screen and (max-width: 600px) 
{
  
  .navbar .fa-bars
  {
    display: block;
  } 
  
  .navbar .fa-bars
  {
    font-size: 27px;
    margin-top:4px;
    float:right;
    color:black;
  } 
  
  .navbar .Missio, .UT
  {
    display: none;
  }
  
  .navbar .UT
  {
    display: none;
  }
  
  .navbar .Logo
  {
    font-size: 30px;
    margin-top: 10px;
  }
  
  #mySidebar
  {
    height:100%;
    background-color: rgb(166,241,166,0.6);
    margin-top: 2.5px;
    width: 100%;
    display: block;
  }
  
  #mySidebar .Missio,.UT
  {
    display: block;
    font-size:25px;
    width:500px;
  }
  
  
  #mySidebar .Missio,.UT
  {
    margin-left: 8em;
    margin-top:0.5em;
  }
  
  #mySidebar a.suljeIkoni
  {
    font-size: 35px;
    float: right;
    position:   inherit;
    margin-right: 32px;
    color:black;
  }
  
  .container > .row > .body > form >.row > div input[type=text], input[type=username], input[type=email], input[type=password]
  {
    width:100%;
  }
  
  .body > form > .Muokkaa
  {
    width:100%;
    margin-left: 0!important;
  }
  
  .container > .row > .footer
  {
    height: 100%;
  }

  .fa-info:before {
    display: none;
}

}
  

/*Jos näytön leveys on 980px tai pienempi*/
@media only screen and (max-width: 900px) 
{
  .container > .row > .header
  {
    height: 100%;
    width:100%;
  }
  
  #RespoIlmoitus
  {
    display: block;
  }

  .alert-danger {
    width: 100%;
  }
  
  .container > .row > .body > form >.row input[type=text], input[type=username],input[type=password]
  {
    width:100%;
  }
  
  .body > form > .Muokkaa
  {
    width:100%;
    margin-left: 0!important;
  }
  
  .container > .row > .footer
  {
    height: 100%;
  }
  
  .navbar .fa-bars
  {
    display: block;
  } 
  
  .navbar .fa-bars
  {
    font-size: 27px;
    margin-top:4px;
    float:right;
    color:black;
  } 
  
  .navbar .Missio, .UT
  {
    display: none;
  }
  
  .navbar .UT
  {
    display: none;
  }
  
  .navbar .Logo
  {
    font-size: 30px;
    margin-top: 10px;
  }
  
  #mySidebar
  {
    height:100%;
    background-color: rgb(166,241,166,0.6);
    margin-top: 2.5px;
    width: 100%;
    display: none;
  }
  
  #mySidebar .Missio,.UT
  {
    display: block;
  }
  
  #mySidebar .Missio,.UT
  {
    font-size:25px;
  }
  
  #mySidebar .Missio,.UT
  {
    width:300px;
  }
  
  #mySidebar .Missio,.UT
  {
    margin-left: 5em;
    margin-top:0.5em;
  }
  
  #mySidebar a.suljeIkoni
  {
    font-size: 35px;
    float: right;
    position:   inherit;
    margin-right: 32px;
    color:black;
  }
  
  .container > .row > .body > form >.row  .label
  {
    margin-top:-15px;
  }
  
  .alert-danger
  {
    margin-left: 0em;
    width: 100%;
  }
}
  
  

  
/*Jos näytön leveys on 768px tai suurempi*/
@media only screen and (min-width: 950px) 
{
  #RespoIlmoitus
  {
    display: none;
  }
  
  #mySidebar
  {
    display: none;
  }
  
  .navbar .Logo
  {
    font-size: 1.5em;
    text-transform: uppercase;
    margin-top: 0.5em;
  }
  .NavButton
  {
    text-align: right;
  }
  
  .NavButton a
  {
    text-decoration: none;
    
  }
  
  .navbar .fa-bars
  {
    display: none;
  } 
  
  .navbar .fa-bars
  {
    font-size: 27px;
    margin-top:4px;
    float:right;
    color:black;
  } 
  
  .navbar .Missio, .UT
  {
    display: block;
    float:right;
    margin-left:10%;
  }
  
  
} 


</style>

<div class="container">
  <div class="row">
      <div class="container">
        <div class="row">
            <div class="col-xl header">
              <div class="row navbar">
            
            <div class="col Logo"><span style="color:RGB(244,160,0)";>Tuottavuus</span><span style="color:RGB(15,157,80)">klinikat</span></div>
            <div class="col NavButton">
              <a href="#">
                <button type="button" class="btn btn-outline-dark Missio" data-toggle="modal" data-target="#myModal_2">Missio</button>
              </a>
              <a href="uutiskirjetilaus.php">
                <button type="button" class="btn btn-outline-dark UT">Uutiskirjeen tilaus</button>
              </a>
              <a href="#">
                <i class="fas fa-bars" onclick="w3_open()"></i>
              </a>
            </div>
            </div>
            </div>
        <!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button suljeIkoni">x</a>
  <div class="Navigaatiopalkit">
    <br><br>
        <a href="#">
            <button type="button" class="btn btn-outline-dark Missio" data-toggle="modal" data-target="#myModal_2">Missio</button>
        </a>
        <a href="uutiskirjetilaus.php">
            <button type="button" class="btn btn-outline-dark UT">Uutiskirjeen tilaus</button>
        </a>
    </div>
        <br>
</nav>
        </div>
      </div>
    </div>
</div>


</head>



<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<script>
$(document).ready(function(){
  $("#Rekisteroidy").click(function(){
    $("#sukunimiboksi").show("slow");
  });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<body>

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

      $("#avaa_2").click(function(){
              $(".missioBOX").show();
            });
    });
</script>
<style>
.alert-success
    {
      height:100%;
      border-radius: 0% 0%;
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
  if(isset($_POST['rekisteroidyB']))
    {
      $Asiakasnumero = mysqli_real_escape_string($conn,$_POST['asiakasnumero']);
      $Etunimi = mysqli_real_escape_string($conn,$_POST['etunimi']);
      $Sukunimi = mysqli_real_escape_string($conn,$_POST['sukunimi']);
      $Sahkoposti = mysqli_real_escape_string($conn,$_POST['Sposti']);
      $Kayttajatunnus = mysqli_real_escape_string($conn,$_POST['kayttajatunnus']);
      
      $Salasana = mysqli_real_escape_string($conn,$_POST['salasana']);
      $Cryptaus = md5($Salasana);


      // Jos syöttäkenttä on tyhjä
      if((empty($_POST['etunimi'])) || (empty($_POST['sukunimi'])) || (empty($_POST['Sposti'])) || (empty($_POST['kayttajatunnus'])))
        {
          echo "<style>form{display:block;}</style>";
          echo "<style>.tahti{display:none;}</style>";
          echo "<style>.container > .row > .body > form >.row input[type=text],input[type=email]{border: 2px solid red;}</style>";
          echo "<style>.avaa{display:none;}</style>";
          echo "<style>.eka{display:block;}</style>";
          echo "<style>.toka{display:none;}</style>";
          echo "<style>.alert-success{display:none;}</style>";
        }
      else
        {
          //Jos vastaavanlaista asiakasnumero ja Sposti löytyy
          
          $Tarkista_AsSposti = "SELECT Sposti, Asiakasnumero FROM tbl_asiakkaat WHERE Asiakasnumero = '$Asiakasnumero' OR Sposti = '$Sahkoposti'";
          $result_Tarkista_AsSposti = mysqli_query($conn, $Tarkista_AsSposti);
            if ($result_Tarkista_AsSposti->num_rows > 0)
            {
              while($row = $result_Tarkista_AsSposti->fetch_assoc()) 
                {
                  $Tarkista_Asiakasnumero = $row['Asiakasnumero'];
                  $Tarkista_Sposti = $row['Sposti'];
                }
            }

          //JOS asiakasnumero täsmää
            if($Tarkista_Asiakasnumero == $Asiakasnumero)
              {
                echo "<script>location='RekisteröityminenError.php'</script>";
              }

          //JOS Sposti täsmää
            else if($Tarkista_Sposti == $Sahkoposti)
            {
              echo "<script>location='RekisteröityminenError.php'</script>";
            }
            else
            {
              $insert1 ="INSERT INTO tbl_asiakkaat (Asiakasnumero,Etunimi,Sukunimi,Sposti,LukuoikeusMyonnetty,LukuoikeusOSTETTU,LisattyAsiakas) 
              VALUES ('$Asiakasnumero','$Etunimi','$Sukunimi','$Sahkoposti','EI','EI','$Lisays_PVM')";
              $kysely1 = mysqli_query($conn, $insert1) or die (mysqli_error($conn));
              if($kysely1 == 1)
                {
                  $insert2 = "INSERT IGNORE INTO tbl_kayttajatunnus (Kayttajatunnus,Salasana,Password_Hash,Asiakasnumero,Rooli,LisattyKayttajatunnus) VALUES ('$Kayttajatunnus','$Salasana','$Cryptaus','$Asiakasnumero','Asiakas','$Lisays_PVM')";
                  $kysely2 = mysqli_query($conn, $insert2) or die (mysqli_error($conn));
                  if($kysely2==1)
                    {
                      //echo "Data inserted ".$Asiakasnumero;
                      // Email Functionality
                      date_default_timezone_set('Etc/UTC');
                      $mail = new PHPMailer();
                      $mail->IsSMTP();
                      $mail->CharSet = 'UTF-8';

                      $mail->Host       = 'smtp.titan.email';               // SMTP server example
                      $mail->SMTPDebug  = 0;                      // enables SMTP debug information (for testing)
                      $mail->SMTPAuth   = true;                   // enable SMTP authentication
                      $mail->Port       = 465; 
                      $mail->SMTPSecure = 'ssl';                     // set the SMTP port for the GMAIL server
                      $mail->Username   = 'system@chpc.fi';             
                      $mail->Password   = 'K_?eEdX=yW5Y';       // SMTP account password example

                      $header ="TUOTTAVUUSKLINIKAT - CHPC";
                      $header .="MIME-Version: 1.0\n\n";
                      $header .="Content-type text/html; charset=utf-8";
                      // Email ID from which you want to send the email
                      $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
                      $mail->addAddress($Sahkoposti);
                      $mail->Subject = 'Rekisteroityminen - Vaihe B';
                      $message = '<html><body>';
                      $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                      $message .= "<tr style='background: #eee;'><td><strong>KÄYTTÄJÄTUNNUS</strong> </td><td><strong>SALASANA</strong></td></tr>";
                      $message .= "<tr><td>".$Kayttajatunnus."</td><td>" .  $Salasana . "</td></tr>";
                      $message .= "</table>";
                      $message .= "<br/><br/>";
                      $message .= "NYT VOIT KIRJAUTUA JÄRJESTELMÄÄN <a href='https://chpc.fi/KirjauduVaiheB.php'>TÄSTÄ</a>";
                      $message .= "</body></html>";
                      $mail->Body = $message;
                      $mail->isHTML(true);

                      if ($mail->send())
                        {
                          //Katsotaan_Onko asikasliästty
                          $Hae_viimeisen_Asiakasnumero = "SELECT Asiakasnumero FROM tbl_asiakkaat WHERE Asiakasnumero = '$Asiakasnumero'";
                          $result_Hae_viimeisen_Asiakasnumero = mysqli_query($conn, $Hae_viimeisen_Asiakasnumero);
                          if ($result_Hae_viimeisen_Asiakasnumero->num_rows > 0)
                            {
                              while($row = $result_Hae_viimeisen_Asiakasnumero->fetch_assoc()) 
                              {
                                $Viimeinen_Asiakasnumero =$row["Asiakasnumero"];
                                if($Viimeinen_Asiakasnumero == $Asiakasnumero)
                                {
                                  echo "<style>form{display:none;}</style>";
                                  echo "<style>.error{display:none;}</style>";
                                  echo "<style>.avaa{display:none;}</style>";
                                  echo "<style>.eka{display:none;}</style>";
                                  echo "<style>.toka{display:block;}</style>";
                                  echo "<style>.alert-success{display:block;}</style>";
                                }
                              }
                            }
                        }
                      else
                      {

                      }
                    }
                }
            }
        }
      }
    else
      {
        echo "<style>.toka,.alert-success{display:none;}</style>";
      }
  ?>
        <p class="otsikko eka">Rekisteröityminen vaihe, B</p>
        <p class="otsikko toka" >Rekisteröityminen vaihe, B, etenee</p>
        <span class="error" style="font-size:18px;">* - Tähdellä merkityt kentät pakollisia</span>
        <br>
        <div class="alert alert-success">
          <h5><?php echo $Lause_Vahvistus; ?></h5>
          <a href="https://chpc.fi/KirjauduVaiheB.php"><h5>kirjaudu järjestelmään</h5></a>
          <br>
          <h5>HUOM! Jos et ole saanut lähettämämme sähköpostia saapuneet kansiosta, tarkista roskapostikansio </h5>
          <br>
          <h5>Mikäli et edelleenkään löydä, ota yhteys asiakaspalveluumme <a href="mailto:info@chpc.fi">info@chpc.fi</a></h5>
        </div>

                <form  id="rekisteroidyB" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 label" >Asiakasnumero</div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 input" >
                  <input type="text" id="Asiakasnumero" name="asiakasnumero" value="<?php echo $Asiakasnumero;?>"  readonly style="background-color:rgba(128,128,128,0.2);outline:none;border:none;">
                </div>
                 <br><br><br>

                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 label">Etunimet  <span class="error tahti">*</span></div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 input">
                  <input type="text" id="etunimi" name="etunimi" value="<?php echo $etunimi;?>">
                  </div>
                  <div class="container ErrorBox" style="margin-left:11.3em;margin-right:11.3em;margin-top:2px;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                          <strong ><?php  echo $etunimiErr; ?></strong>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 label"><br>Sukunimi <span class="error tahti">*</span></div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 input">
                  <input type="text" name="sukunimi" id="sukunimi" value="<?php echo $sukunimi;?>" ></div>
                  <div class="container ErrorBox" style="margin-left:11.3em;margin-right:11.3em;margin-top:2px;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php  echo $sukunimiErr; ?></strong>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 label"><br>Sähköpostiosoite <span class="error tahti">*</span></div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 input">
                  <input type="email" name="Sposti" id="Sposti" value="<?php echo $Sposti;?>"></div>
                  <div class="container ErrorBox" style="margin-left:11.3em;margin-right:11.3em;margin-top:2px;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo $SpostiErr; ?></strong>
                    </div>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 label"><br>Käyttäjätunnus</div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 input">
                  <input type="text" name="kayttajatunnus" readonly id="kayttajatunnus" value="<?php echo $KT_Sukunimi; ?>" style="background-color:rgba(128,128,128,0.2);outline:none;border:none; text-transform:none;!important" >
                  </div>
                  <div class="container ErrorBox" style="margin-left:11.3em;margin-right:11.3em;margin-top:2px;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo $KayttajatunnusbErr; ?></strong>
                    </div>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 label"><br>Salasana  </div>
                  <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 input">
                  <input type="text" name="salasana"  value="<?php echo $GeneroiSalasana; ?>" readonly style="background-color:rgba(128,128,128,0.2);outline:none;border:none; text-transform:none;!important"></div>

                </div>
            <br>

                <p class="KirjauduTeksti">Jos sinulla on tunnukset, kirjaudu<a href ="KirjauduVaiheB.php"> tästä</a></p>

                <button type="submit" name="rekisteroidyB" id="Rekisteroidy" onclick="myFunction()" style="outline:none;" class="Muokkaa btn btn-outline-primary text">Rekisteröidy</button>
            </form>

            <div class="container Tietoja">
                <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-12 col-xl-12 teksti"><?php
            if($resultCheck > 0){
              while($row=mysqli_fetch_assoc($result_9)){
               echo $row['Lause'];
              }
              }
          ?></div>

                </div>
            </div>


          
<p class="avaa" data-toggle="modal" data-target="#myModal"  >Lue tietosuojakäytännöstämme <strong>tästä</strong></p>
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

<script>
  $("#sukunimi").keyup(function(){
          update();
      });

      function update() {
        $("#kayttajatunnus").val($('#sukunimi').val()+"-B");
      }

const reloadtButton = document.querySelector("#reload");
// Reload everything:
function reload() {
    reload = location.reload();
}
// Event listeners for reload
reloadButton.addEventListener("click", reload, false);
</script>



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
</html>
<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
