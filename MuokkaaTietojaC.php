<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Connect.php';
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
require 'PHPMailer/PHPMailerAutoload.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- PERUSTIEDOT, vaihe C.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    *{
    font-family: 'Maven Pro', sans-serif;   
}
 
    body{

          background-color:white;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
       }
       .container>.row > .body{
           height:100%;
       }

    .container > .row > .body > form >.row{
    text-transform:uppercase;
}
.container > .row > .body > form >.row > div input[type=text],input[type=email],input[type=username],input[type=phone],input[type=password]{
    padding-left:5px;
    text-align:center;
    width:250px;
    height:37px;
    font-size:18px;
    outline:none;
}
.container > .row > .body > form >.row > div input[type=password]{
  font-size:22px;
  outline:none;

}
.container > .row > .body > form >.row > div input[type=text]:hover,input[type=email]:hover,input[type=username]:hover,input[type=phone]:hover,input[type=password]:hover{
  background-color:rgb(240, 240, 240);
  outline:none;

}
.container > .row > .header > .container > .row > ul{
    text-align:right;
    margin-left:33em;
    margin-top:-30px;
}

.container > .row > .header > .container > .row > ul li{
    list-style:none;
    display:inline-block;
    text-transform:uppercase;
    padding-left:5px;
    padding-right:5px;
    font-size:20px;
}
.container > .row > .header > .container > .row > ul li:hover{
    font-weight: bold;
}
.container > .row > .header > .container > .row > ul li a{
    display:block;
    text-decoration:none;
    color:black;
    letter-spacing:2px;
}
.header >.container >.row >.Logo span{
        text-align: center;
        font-size: 20px;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 5px;
        padding-top:15px;
      }
      .header >.container >.row >.Logo{
        margin-top:15px;
      }

.container > .row > .header > .container > .row >.Logo a{
    text-decoration:none;
}
.errorTeksti
  {
    font-size:18px;
    color:red;
    margin-left:1.2em;
  }
.error
  {
    color:red;
    font-size:2em;
    position: absolute;
    margin-top: 10px;
    padding-left:9px;
  }
  .body > form>.Muokkaa
    {
      height:50px;
      width:500px;
      text-align:center;
      margin-left:25em;
      text-transform:uppercase;
      letter-spacing:5px;
      font-weight:600;
      background-color:rgb(135,206,250,0.1);
      outline:none;
    }
 
    i
    {
        margin-left: 1em;
    }
  .body > .Muokkaa:hover
    {
      background-color:rgba(135,206,250,0.5);
    }
    .text{
      background-color:#5cb85c;
      opacity:1;
    }
    .text:hover{
      color:#5cb85c;
      box-shadow:0 0 2px #5cb85c, 0 0 2px #5cb85c;
    }
    .errorMESSAGE{
      color:red;
      font-weight:bold;
      text-align:center;
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
.alert-warning
  {
      border-radius: 0% 0%;
      color:black;
  }

  </style>


<?php

    $AsiakasNRO = $_SESSION['Asiakasnumero_2'];
    $Enimi = $_SESSION['Etunimi_2'];
    $Snimi = $_SESSION['Sukunimi_2'];
    $Sposti = $_SESSION['Sposti_2'];
    $Titteli = $_SESSION['Titteli_2'];
    $PNro = $_SESSION['Puhelin_2'];
    $Ynimi = $_SESSION['YrityksNimi_2'];
    $YNro = $_SESSION['Y_tunnus_2'];
    $LR = $_SESSION['Liiketoimintaryhma_2'];
    $LY = $_SESSION['Liiketoimintayksikko_2'];
    $Os = $_SESSION['Osoite_2'];
    $POSTINro = $_SESSION['PostiNro_2'];
    $PTMP = $_SESSION['PostiTmiPaikka_2'];
    $KT = $_SESSION['Kayttajatunnus_2'];
    $SS = $_SESSION['Salasana_2'];


$Muokkaus_PVM = date('Y-m-d');
  if(isset($_POST['MuokkaaC']))
    {

      $asiakasnumero = mysqli_real_escape_string($conn,$_POST['asiakasnumero']);
      $etunimi = mysqli_real_escape_string($conn,$_POST['etunimi']);
      $sukunimi = mysqli_real_escape_string($conn,$_POST['sukunimi']);
      $asemaYrityksessa = mysqli_real_escape_string($conn,$_POST['asemaYrityksessa']);
      $Sposti = mysqli_real_escape_string($conn,$_POST['Sposti']);
      $puhelinnumero = mysqli_real_escape_string($conn,$_POST['puhelinnumero']);
      $osoite = mysqli_real_escape_string($conn,$_POST['osoite']);
      $Postinumero = mysqli_real_escape_string($conn,$_POST['Postinumero']);
      $Postitoimipaikka = mysqli_real_escape_string($conn,$_POST['Postitoimipaikka']);
      
      $salasana = mysqli_real_escape_string($conn,$_POST['salasana']);
      $Kryptattu_Salasana = md5($salasana);

        if((empty($_POST['etunimi'])) || (empty($_POST['sukunimi'])) || (empty($_POST['asemaYrityksessa'])) ||
            (empty($_POST['Sposti'])) || (empty($_POST['osoite'])) || (empty($_POST['Postinumero'])) ||
            (empty($_POST['Postitoimipaikka'])) || (empty($_POST['salasana'])))
        {
            $ErrorMessage = " *** TÄYTÄ TYHJÄT KENTÄT ENSIN ***";
        }else
        {
          $Muokkaa1 ="UPDATE tbl_asiakkaat SET Etunimi='$_POST[etunimi]',Sukunimi='$_POST[sukunimi]',Sposti='$_POST[Sposti]',Titteli='$_POST[asemaYrityksessa]',Puhelin='$_POST[puhelinnumero]',MuokattuAsiakas= '$Muokkaus_PVM' WHERE Asiakasnumero = '$asiakasnumero'";
          $KyselyMuokkaa1 = mysqli_query($conn, $Muokkaa1) or die (mysqli_error($conn));
            if ($KyselyMuokkaa1 == 1)
                {
                  $Muokkaa2 ="UPDATE tbl_yritykset SET Osoite='$_POST[osoite]',PostiNro='$_POST[Postinumero]',PostiTmiPaikka='$_POST[Postitoimipaikka]',MuokattuYritys='$Muokkaus_PVM' WHERE Y_tunnus  = '$YNro'";
                  $KyselyMuokkaa2 = mysqli_query($conn, $Muokkaa2) or die (mysqli_error($conn));
                      if ($KyselyMuokkaa2 == 1)
                          {
                            $Muokkaa3 ="UPDATE tbl_kayttajatunnus_c SET Salasana='$_POST[salasana]',MuokattuKayttajatunnus_c = '$Muokkaus_PVM',Password_Hash = '$Kryptattu_Salasana' WHERE Asiakasnumero = '$asiakasnumero'";
                            $KyselyMuokkaa3 = mysqli_query($conn, $Muokkaa3) or die (mysqli_error($conn));
                                if ($KyselyMuokkaa3 == 1)
                                    {
                                      
                                      date_default_timezone_set('Etc/UTC');
                                      $mail = new PHPMailer();
                                      $mail->IsSMTP();
                                      $mail->CharSet = 'UTF-8';
                                      $mail->Host = 'smtp.titan.email';              // SMTP server example
                                      $mail->SMTPDebug  = 0;                      // enables SMTP debug information (for testing)
                                      $mail->SMTPAuth   = true;                   // enable SMTP authentication
                                      $mail->Port       = 465; 
                                      $mail->SMTPSecure = 'ssl';                     // set the SMTP port for the GMAIL server
                                      $mail->Username   = 'system@chpc.fi';             
                                      $mail->Password   = 'K_?eEdX=yW5Y';               // SMTP account password example

                                      $header ="TUOTTAVUUSKLINIKAT";
                                      $header .="MIME-Version: 1.0\n\n";
                                      $header .="Content-type text/html; charset=utf-8";
                                      // Email ID from which you want to send the email
                                      $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
                                      $mail->addAddress($Sposti);
                                      $mail->Subject = 'Perustietojen muokkuas - Vaihe C';
                                      $message = '<html><body>';
                                      $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                                      $message .= "<tr style='background: #eee;'><td><strong>KÄYTTÄJÄTUNNUS</strong> </td><td><strong>SALASANA</strong></td></tr>";
                                      $message .= "<tr><td>".$Sposti."</td><td>" .  $salasana . "</td></tr>";
                                      $message .= "</table>";
                                      $message .= "<br/><br/>";
                                      $message .= "NYT VOIT KIRJAUTUA JÄRJESTELMÄÄN <a href='https://chpc.fi/KirjauduVaiheC.php'>TÄSTÄ</a>";
                                      $message .= "</body></html>";
                                
                                      $mail->Body = $message;
                                      $mail->isHTML(true);
                                        if ($mail->send())
                                          {
                                            echo "<script>location='TietojenMuokkausVahvistus_C.php'</script>";
                                          }
                                    }
                          }
                }
                else
                  {
                    echo "Data Not Updated";
                  }
          
        }
    }
    
    if(isset($_POST['PalaaAsiakasprofiili']))
    {
       echo "<script>location='AsiakasprofiiliC.php'</script>"; 
    }

    $sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
    $result_Missio = $conn->query($sql_Missio);

    if ($result_Missio->num_rows > 0) {

        while($row = $result_Missio->fetch_assoc()) {
          $Lause =$row["Lause"];
        }
    }
?>

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
                            <li><a href="#" class="avaa_1" data-toggle="modal" data-target="#myModal_2" >Missio</a></li>
                            <li><a href="uutiskirjetilaus.php">uutiskirjeen tilaus</a></li>
                            <li><a href="Uutiskirjeet.php">Uutiskirjeet</a></li>
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

?>
<body>
<script>
$(document).ready(function(){
  $("#Kirjaudu").click(function(){
    $("#sukunimiboksi").show("slow");
  });
});
</script>
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
      <div class="col-xl body">
        <p class="otsikko">PERUSTIEDOT, vaihe C</p>
            <div class="alert alert-warning">
                Tietojen päivitystarpeissa, ole hyvä, informoi järjestelmän ylläpitäjää ja perustele tarvettasi myös vähän. <strong><a href="mailto:info@chpc.fi">info@chpc.fi</a></strong>.  
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <br>
            <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Asiakasnumero</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-9 "><input value="<?php echo $AsiakasNRO; ?>" type="text" id="asiakasnumero" name="asiakasnumero" readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;"></div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">ETUNIMI</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="etunimi" name="etunimi" value="<?php echo $Enimi; ?>"></div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Sukunimi  </div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="sukunimi" name="sukunimi" value="<?php echo $Snimi; ?>"></div>
                </div>

                <br>
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">ASEMA YRITYKSESSÄ</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="asemaYrityksessa" name="asemaYrityksessa" value="<?php echo $Titteli; ?>" ></div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Sähköpostisi yrityksessäsi <i class="fa fa-info">
                  <span class="tooltiptext">Jos olet uuden yrityksen palveluksessa, olet uusi asiakas. Silloin sinun tulee kirjautua uutena asiakkaana järjestelmään</span>
                      </i>
                  </div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="email" id="Sposti" name="Sposti" value="<?php echo $Sposti; ?>" ></div>
                </div>

                <br>
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">PUHELINNUMERO</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="phone" id="puhelinnumero" name="puhelinnumero" value="<?php echo $PNro; ?>"></div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">YRITYKSEN NIMI</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="yrityksenNimi" name="yrityksenNimi" readonly style="background-color:rgba(128,128,128,0.2);outline:none;border:none;" value="<?php echo $Ynimi; ?>"></div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Y-TUNNUS</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="ytunnus" name="ytunnus" readonly style="background-color:rgba(128,128,128,0.2);outline:none;border:none;" value="<?php echo $YNro; ?>"></div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">LIIKETOIMINTARYHMÄ </div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="liiketoimintaryhma" name="liiketoimintaryhma" readonly style="background-color:rgba(128,128,128,0.2);outline:none;border:none;" value="<?php echo $LR; ?>"></div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">LIIKETOIMINTAYKSIKKÖ</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="liiketoimintayksikko" name="liiketoimintayksikko" readonly style="background-color:rgba(128,128,128,0.2);outline:none;border:none;" value="<?php echo $LY; ?>"></div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">OSOITE</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="osoite" name="osoite" value="<?php echo $Os;?>"></div>
                </div>
                <br>
                  <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Postinumero </div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="Postinumero" name="Postinumero" value="<?php echo $POSTINro;?>" ></div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Postitoimipaikka </div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="Postitoimipaikka" name="Postitoimipaikka" value="<?php echo $PTMP;?>" ></div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Käyttäjätunnus</div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input readonly style="width:100%;background-color:rgba(128,128,128,0.2);outline:none;border:none;" type="text" id="KayttajatunnusBM" name="KayttajatunnusBM" value="<?php echo $KT; ?>" style="background-color:rgba(128,128,128,0.2);outline:none;border:none;" readonly></div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Salasana </div>
                  <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input type="text" id="salasana" name="salasana" value="<?php echo $SS;?>" ></div>
                </div>

            <br>
              <button type="submit" name="MuokkaaC" id="MuokkaaC" style="outline:none;" class="Muokkaa btn btn-outline-success text">Tallenna muutokset</button>
            <br><br>
            <button type="submit" name="PalaaAsiakasprofiili" style="outline:none;" class="Muokkaa btn btn-outline-success text">Takaisin asiakasprofiilin<i class="fas fa-arrow-right"></i></button>
            </form>

            <div class="container Tietoja">
                <div class="row">
                <div class="col-sm-3 col-md-6 col-lg-12 col-xl-8 teksti">
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
$(document).ready(function(){
  $(".sulje").click(function(){
    $("#SUHKOy").hide();
  });
  $(".avaa").click(function(){
    $("#SUHKOy").show();
  });
});
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
