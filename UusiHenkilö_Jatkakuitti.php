<?php session_start(); ?>
<?php
  include_once 'PHP - Funktiot/Connect.php';
  include_once 'PHP - Funktiot/formValidation.php';
  require 'PHPMailer/PHPMailerAutoload.php';
  error_reporting(0);

//Generoidaan String salasana
$IsotAakkoset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$Pinetaakkoset = "abcdefghijklmnopqrstuvwxyz";
$Numerot = "1234567890";
$EroisMerkit ="!@$%&?-_";

//Sekoitetaan Ylläoleva String parametrit
$SekoitaIsotAakkoset = substr(str_shuffle($IsotAakkoset),0,2);
$SekoitaPienetAakkoset = substr(str_shuffle($Pinetaakkoset),0,2);
$SekoitaNumrot = substr(str_shuffle($Numerot),0,2);
$SekoitaEroismerkit = substr(str_shuffle($EroisMerkit),0,2);
//Yhdistetään ne yhteen
$Mixaus ="$SekoitaIsotAakkoset$SekoitaPienetAakkoset$SekoitaNumrot$SekoitaEroismerkit";

//generoidaan niistä salasana
$GeneroiSalasana = substr(str_shuffle($Mixaus),-10,10);

//Generoidaan Asiakasnumero
$AsiakasnumeroGenerointi= (rand(9999999,999999));
$Asiakasnumero = $AsiakasnumeroGenerointi;

$KuittiNumero = $_SESSION['K_Nro'];




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


?>
<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Lisaa Uusi Henkilö</title>
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
                            <li><a href="#" class="avaa_1" id="avaa">Missio</a></li>
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
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

    <div id="missioBOX" class="missioBOX">
            <h5 class="MISSIOOTSIKKO">MISSIOMME</h5>
            <h6 class="MISSIOTEKSTI"><?php echo $Lause; ?></h6>
            <h5 id="sulje" class="MISSIOOTSIKKO" style="font-size:15px;color:red;cursor:pointer;">PIILOTA TEKSTI</h5>
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
      <div class="col-xl body">
        <p class="otsikko">Lisää Uusi Henkilö</p>
            <span class="error" style="font-size:18px;">* - Tähdellä merkityt kentät pakollisia</span>

            <?php 
$Lisays_PVM = date('Y-m-d');


if(isset($_POST['PalaaOstoskoriin'])) 
  {
      echo "<script>location='Ostoskori.php'</script>";
  }



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
    $Kayttajatunnus = mysqli_real_escape_string($conn,$_POST['Kayttajatunnus']);
    $Salasana = mysqli_real_escape_string($conn,$_POST['Salasana']);
    $Rakennusliike = mysqli_real_escape_string($conn,$_POST['Rakennusliike']);

    $Cryptaus = md5($Salasana);

    if((empty($_POST['asiakasnumero'])))
      {
          }else if((empty($_POST['etunimi']))){

          }else if((empty($_POST['sukunimi']))){

          }else if((empty($_POST['asemaYrityksessa']))){

          }else if((empty($_POST['Sposti']))){

          }else if((empty($_POST['puhelinnumero']))){

          }else if((empty($_POST['yrityksenNimi']))){

          }else if((empty($_POST['ytunnus']))){

          }else if((empty($_POST['liiketoimintaryhma']))){

          }else if((empty($_POST['liiketoimintayksikko']))){

          }else if((empty($_POST['osoite']))){

          }else if((empty($_POST['postinumero']))){

          }else if((empty($_POST['postitoimipaikka']))){

          }else if((empty($_POST['Rakennusliike']))){
      }
      else
      {
        $user_check_query = "SELECT tbl_asiakkaat.Asiakasnumero,tbl_asiakkaat.Etunimi, tbl_asiakkaat.Sukunimi, tbl_asiakkaat.Sposti,tbl_kayttajatunnus_c.Kayttajatunnus
        FROM tbl_asiakkaat INNER JOIN tbl_kayttajatunnus_c
        ON tbl_kayttajatunnus_c.Asiakasnumero=tbl_asiakkaat.Asiakasnumero
        WHERE tbl_asiakkaat.Asiakasnumero = '$Asiakasnumero_2'
        OR tbl_asiakkaat.Etunimi = '$Etunimi'
        OR tbl_asiakkaat.Sukunimi = '$Sukunimi'
        OR tbl_asiakkaat.Sposti = '$Sahkoposti'
        OR tbl_kayttajatunnus_c.Kayttajatunnus = '$Kayttajatunnus' LIMIT 1";

        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

          if ($user)
            {     // if user exists
                if (($user['asiakasnumero'] === $Asiakasnumero_2) || ($user['etunimi'] === $Etunimi) || 
                   ($user['sukunimi'] === $Sukunimi) || ($user['Sposti'] === $Sahkoposti) || 
                   ($user['kayttajatunnus'] === $Kayttajatunnus))
                {
                    $_SESSION['Asiakasnumero'] = $Asiakasnumero_2;
                    $_SESSION['Etunimi'] = $Etunimi;
                    $_SESSION['Sukunimi'] = $Sukunimi;
                    $_SESSION['Sähköposti'] = $Sahkoposti;
                    $_SESSION['Käyttäjätunnus'] = $Kayttajatunnus;
                    header("Location:RekisteroitymisVahvistusCError.php");
                }
            }

            else
              {
                $ViiteAvaimenTarkistus = "SET FOREIGN_KEY_CHECKS=0";
                $ViiteAvaimenTarkistusKysely = mysqli_query($conn, $ViiteAvaimenTarkistus) or die (mysqli_error($conn));
                if($ViiteAvaimenTarkistusKysel = 1)
                    {
                      $LisaaUusiAsiakas ="INSERT INTO tbl_asiakkaat 
                        (Asiakasnumero,Etunimi,Sukunimi,Sposti,Puhelin,Titteli,Y_tunnus,LukuoikeusMyonnetty,LukuoikeusOSTETTU,RekisteroitynytCVaihe)
                        VALUES ('$Asiakasnumero','$Etunimi','$Sukunimi','$Sahkoposti','$Puhelin','$Titteli','$Y_tunnus','KYLLA','EI','$Lisays_PVM')";
                           $LisaaUusiAsiakaskysely = mysqli_query($conn, $LisaaUusiAsiakas) or die (mysqli_error($conn));
                              if($LisaaUusiAsiakaskysely == 1)
                                {
                                  $LisaaKayttajatunnus = "INSERT INTO tbl_kayttajatunnus_c (Kayttajatunnus,Salasana,Password_Hash,Asiakasnumero,Rooli,LisattyKayttajatunnus_c)
                                    VALUES ('$Kayttajatunnus','$Salasana','$Cryptaus','$Asiakasnumero','Asiakas','$Lisays_PVM')";
                                      $LisaaKayttajatunnuskysely = mysqli_query($conn, $LisaaKayttajatunnus) or die (mysqli_error($conn));
                                          if($LisaaKayttajatunnuskysely==1)
                                            {
                                              $Lisaayritystiedot = "INSERT INTO tbl_yritykset (Y_tunnus ,YrityksNimi,Liiketoimintaryhma,Liiketoimintayksikko,Osoite,PostiNro,PostiTmiPaikka,Rakennusliike,LisattyYritys)
                                              VALUES ('$Y_tunnus','$YrityksNimi','$Liiketoimintaryhma','$Liiketoimintayksikko','$Osoite','$PostiNro','$PostiTmiPaikka','$Rakennusliike','$Lisays_PVM')";
                                                  $Lisaayritystiedotkysely = mysqli_query($conn, $Lisaayritystiedot) or die (mysqli_error($conn));
                                                     if($Lisaayritystiedotkysely==1)
                                                      {
                                                        $LisaaOstostoskoriin ="INSERT INTO tbl_ostoskori (Asiakasnumero,Etunimi,Sukunimi,Aktiivinen_Lukuoikeus,PVM) 
                                                          VALUES ('$Asiakasnumero','$Etunimi','$Sukunimi','EI','$Lisays_PVM')";
                                                        $LisaaOstostoskoriinKysely = mysqli_query($conn, $LisaaOstostoskoriin) or die (mysqli_error($conn));
                                                          if($LisaaOstostoskoriinKysely == 1)
                                                            {
                                                                //Muoataan asiakkaan kuittinumerotietoja ostoskoritaulussa
                                                                $Muokaka_KuittiNumero = "UPDATE tbl_ostoskori SET KuittiNro = '$KuittiNumero' WHERE Asiakasnumero = '$Asiakasnumero'";
                                                                $Muokaka_KuittiNumeroKysely = mysqli_query($conn, $Muokaka_KuittiNumero) or die (mysqli_error($conn));
                                                                if($Muokaka_KuittiNumeroKysely == 1)
                                                                  {
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
                                                                      $message = '<h3>Arvoisa asiakkaamme teille on luotu tunnukset TUOTTAVUUSKLINIKAN SIVUILLE. ALLA KÄYTTÄJÄTUNNUS</h3>';
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
                                                                            echo "<div class='alert alert-success' style='background-color: rgb(166,241,166,0.6);color:black;display:block;text-align: center;font-size: 18px;border-radius: 0px 0px 0px 0px;height:15em;'>
                                                                                  $Lause_Vahvistus
                                                                                  <br><br>
                                                                                  <strong>
                                                                                  <a href='Ostoskori_JatkaKuittia.php' style='text-transform:uppercase;text-decoration:none;'>Palaa ostoskoriin</a>
                                                                                  </strong>
                                                                                  <br><br>
                                                                                  <h5>HUOM! Jos et löydä lähettämämme sähköpostia saapuneet kansiosta, tarkista roskapostikansio</h5>
                                                                                  <h5>Mikä et edelleenkään löydä, ole yhteydessä asiaspalveluumme <a href='mailto:info@chpc.fi'>info@chpc.fi</a></h5>
                                                                                </div>";
                                                                            echo "<style>form,.error,.avaa{display:none;}</style>";           
                                                                          } 
                                                                        else 
                                                                          {
                                                                            
                                                                          }
                                                                  }
                                                            }
                                                      }
                                            }
                                }
                    }
              }                                 
      }
}

?>
        <br><br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 "><input type="text" name="asiakasnumero" id="asiakasnumero"  onkeypress="IsInputNumber(event)"  readonly style="width:100%;" placeholder="Asiakasnumero" value="<?php echo $Asiakasnumero; ?>">
                </div>

                <div class="container ErrorBox" style="margin-left:0em;margin-top:-5px;margin-bottom:5px;width:70em;">
                    <div class="alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                          <strong><?php echo $asiakasnumeroErr; ?></strong>
                    </div>
                </div>



                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input  type="text" value="<?php echo $Etunimi; ?>" id="etunimi" name="etunimi" placeholder="Etunimet" >
                    <span class="error">*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input value="<?php echo $Sukunimi; ?>" type="text"  id="sukunimi" name="sukunimi" placeholder="Sukunimi" >
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
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="email" value="<?php echo $Sposti; ?>" name="Sposti" id="Sposti" placeholder="Henkilön sähköpostiosoite yrityksessä"  ><span class="error">*</span></div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $asemaYrityksessaErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $SpostiErr; ?></strong>
                        </div>
                    </div>



                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Puhelin; ?>" id="puhelinnumero" name="puhelinnumero" onkeypress="IsInputNumber(event)" placeholder="Puhelinnumero" ><span class="error">*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $YrityksNimi; ?>"  onkeypress="IsInputString(event)" id="yrityksenNimi" name="yrityksenNimi" placeholder="Yrityksen nimi" ><span class="error">*</span></div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $puhelinnumeroErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $yrityksenNimiErr; ?></strong>
                        </div>
                    </div>





                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Y_tunnus; ?>" id="ytunnus" name="ytunnus" placeholder="Y-tunnus"><span class="error">*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Liiketoimintaryhma; ?>" id="liiketoimintaryhma" name="liiketoimintaryhma"  placeholder="Liiketoimintaryhmä"><span class="error">*</span></div>
                    <div class="container ErrorBox" style="margin-top:-5px;margin-bottom:5px;">
                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:left;float:left;background-color:transparent;text-align:center;padding-left:10em;" id="myAlert">
                              <strong><?php echo $ytunnusErr; ?></strong>
                        </div>

                        <div class="alert-danger AlertErrorBox hide" style="color:red;text-align:right;padding-right:10em;background-color:transparent;" id="myAlert">
                              <strong><?php echo $liiketoimintaryhmaErr; ?></strong>
                        </div>
                    </div>




                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 LTY"><input type="text" value="<?php echo $Liiketoimintayksikko; ?>" id="liiketoimintayksikko" name="liiketoimintayksikko" placeholder="Liiketoimintayksikkö" ><span class="error" >*</span></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" value="<?php echo $Osoite; ?>" id="osoite" name="osoite" placeholder="Edellä mainitun osoite" ><span class="error" >*</span></div>
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
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 " style="font-size:25px;">Onko yritys rakennusliike?</div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-2 "><label for="KYLLA">Kyllä</label></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-1 "><input type="radio" id="Rakennusliike" name="Rakennusliike"  value="Kyllä"></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-2 "><label for="EI">EI</label></div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-1 "><input type="radio" id="Rakennusliike" name="Rakennusliike"  value="EI"></div>
                    <div class="container ErrorBox" style="margin-left:0em;margin-top:-5px;margin-bottom:5px;width:70em;">
                        <div class="alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                              <strong><?php //echo $RakennusliikeErr; ?></strong>
                        </div>
                  </div>




                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6" style="display:flex;"><input value="<?php echo $Sposti; ?>" id="Kayttajatunnus" name="Kayttajatunnus"  style="width:27em;margin-right:5px;outline:none;border:none;background-color:rgba(128,128,128,0.2);" type="text" placeholder="Käyttäjätunus" readonly>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top" style="margin-right:0.2em;" title="Käyttäjätunnuksena toimii sähköposti" ></i>
                    </div>
                    <div class="col-sm-3 col-md-6 col-lg-12 col-xl-6 "><input type="text" name="Salasana" id="Salasana" placeholder="Salasana" style="background-color:rgba(128,128,128,0.2);width:26.1em;margin-right:5px;outline:none;border:none;" value="<?php echo $GeneroiSalasana; ?>" readonly>
                    <i class="fa fa-info" data-toggle="tooltip" data-placement="top"  title="Salasana generoidaan automaattisesti, voit muutta salasannasi myöhemmin."></i>
                    </div>


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
              <button name="rekisteroidyC" id="rekisteroidyC" style="outline:none;" class="Muokkaa btn btn-outline-primary text">Tallenna</button>
              <br/><br/>
              


              <button name="PalaaOstoskoriin" id="rekisteroidyC" style="outline:none;" class="Muokkaa btn btn-outline-primary text">Takaisin ostoskoriin</button>
              </form>



            <div class="container Tietoja">
                <div class="row">
                <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 teksti"><?php
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