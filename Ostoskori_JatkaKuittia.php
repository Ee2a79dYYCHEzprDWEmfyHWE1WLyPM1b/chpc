<?php
session_start();
include_once 'PHP - Funktiot/Connect.php';
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
error_reporting(0);

if(!isset($_SESSION['Asiakasnumero_2'])){
  echo "Olet Jo kirjautunut ulos";
  header('Location:KirjauduVaiheC.php');
}

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }

}


$d=strtotime("+1 year");
$m=strtotime("+1 month");

 
$sql_Hae_KuponkiArvo = "SELECT Arvo FROM tbl_etukupongit";
$result_sql_Hae_KuponkiArvo = $conn->query($sql_Hae_KuponkiArvo);

if ($result_sql_Hae_KuponkiArvo->num_rows > 0) {

  while($row = $result_sql_Hae_KuponkiArvo->fetch_assoc()) {
    $Kuponki_Arvo =$row["Arvo"];
  }
}

$lukuoikeusALKAA = date("d.m.Y");
$lukuoikeusPAATTYY = date ("d.m.Y",$d);
$Loos_Sposti = $_SESSION['Sposti_2'];

$KuittiNro = $_SESSION['kekeytettyKUITTI'];
$Lostaja_Asiakasnumero = $_SESSION['Lostaja_Anro'];

$AvaaKuittia = "UPDATE tbl_ostoskori SET Kuitti_Tila='Avoin' WHERE KuittiNro = '$KuittiNro'";
$AvaaKuittiaAjo  = mysqli_query($conn,$AvaaKuittia);







/*Haetaan lukuoikuden A-hinta*/
$sql_HaeAhinta = "SELECT A_hinta FROM tbl_ostoskori WHERE KuittiNro = '$KuittiNro' AND L_Ostaja = 'KYLLA'";
$result_HaeAhinta = $conn->query($sql_HaeAhinta);

if ($result_HaeAhinta->num_rows > 0) {

    while($row = $result_HaeAhinta->fetch_assoc()) {
      $A_Hinta =$row["A_hinta"];

    }

}


//Hae Prosenttitiedot
$HaeProsenttiTiedot = "SELECT Vero_Prosentti FROM tbl_lukuoikeudethinta";
$HaeHaeProsenttiTiedot = $conn->query($HaeProsenttiTiedot);

if ($HaeHaeProsenttiTiedot->num_rows > 0) {
    // output data of each row
    while($row = $HaeHaeProsenttiTiedot->fetch_assoc()) {
        $Vero_Prosentti = $row["Vero_Prosentti"];
        
    }
} else {

}







?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- ostoskori
  </title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
.body > a button{
    height:50px;
    width:450px;
    text-align:center;
    margin-left:20em;
    text-transform:uppercase;
    letter-spacing:5px;
    font-weight:600;
    background-color:rgb(135,206,250,0.1);
}
.body > a button:hover {
  height:50px;
    width:450px;
    text-align:center;
    margin-left:20em;
    text-transform:uppercase;
    letter-spacing:5px;
    font-weight:600;
    background-color:rgb(135,206,250,0.1);
}
.container >.otsikko{
    font-size:18px;
}
.container >.data{
    font-weight:bold;
    font-size:20px;
}
.container >.data .fas{
    color:red;
    cursor:pointer;
}
.container >.LisääUusiHenkilö{
    text-align:center;
    margin-top:25px;
    text-transform:uppercase;
    font-size:18px;

    cursor:pointer;
}
.container >.LisääUusiHenkilö a{
    text-decoration:none;
    color:  green;
}
.ostoskori{
    border-top:1px solid gray;
    border-bottom:1px solid gray;
    border-left:1px solid gray;
    border-right:1px solid gray;
    font-size:20px;
    text-transform:uppercase;
    height:100%;
    padding-top:10px;
}

.ostoskori >.HintaerittelyboksiData{
    margin-top:20px;
}
.ostoskori >.ALV{
    margin-top:20px;
    text-align:left;
}
.ostoskori >.ALV-viiva{
    width:710px;
    margin-right:0px;
}
.ostoskori >.ALE{
    margin-top:20px;
    text-align:left;
    font-size:14px;
    text-transform: uppercase;
    font-weight:600;
}

.ostoskori >.ALE #popUP{
    color:blue;
    cursor:pointer;
}
.ostoskori >.ALE #popUP:hover{
    letter-spacing:2px;
    transition:1s;
}

.ostoskori >.ALE-viiva{
    width:710px;
    margin-right:0px;
}
.ostoskori >.Summa{
    margin-top:20px;
    text-align:left;
    font-weight:bold;
    margin-bottom:10px;
}
.ostoskori >.Summa-Viiva{
    width:710px;
    margin-right:0px;

}
.container > .row > .header > .container > .row > ul{
    text-align:right;
    margin-left:33em;
    margin-top:-30px;
}

.container > .row > .header > .container > .row > ul li{
    list-style:none;
    display:inline-block;
    margin-bottom:-25px;
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


/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 25em;
  right: 45em;
  border: 1px solid #f1f1f1;
}
.form-popup label{
    font-size:18px;
}
.form-container hr{
    padding-bottom:60px;
    padding-top:5px;
}

/* Add styles to the form container */
.form-container {
  max-width: 600px;
  padding: 10px;
  background-color: white;
  text-align:center;
  text-transform:uppercase;
}

/* Full-width input fields */
.form-container input[type=text]{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  text-align:center;
  font-family: 'Maven Pro', sans-serif;
  font-size:20px;
  outline:none;
}



/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
  border-radius: 0px 0px 0px 0px;
  text-transform:uppercase;
  font-size:15px;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
.body > .Muokkaa
    {
      height:50px;
      width:300px;
      text-align:center;
      margin-left:25em;
      text-transform:uppercase;
      letter-spacing:5px;
      font-weight:600;

    }
  .body > .Muokkaa:hover
    {
      background-color:rgba(135,206,250,0);
    }
.text{
      background-color:#0275d8;
      opacity:1;
    }
    .text:hover{
      color:#0275d8;
      box-shadow:0 0 2px #0275d8, 0 0 2px #0275d8;
    }
.infoboksi{
      width:100%;
      margin-top:5px;
      background-color:#fffcd1;
    }
    .infoboksi h5{
      font-size:15px;
      padding-left:5px;
      color:black;
      padding-top:10px;
      padding-bottom:10px;
      padding-left:10px;
      padding-right:10px;
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


.sisennys{
  margin-top:-35px;
  margin-bottom:-30px;
}
.sisennys2{
  color:blck;
  font-size:15px;
  list-style:none;
  margin-top:-20px;
  text-indent:-1.5em;
}

.sisennys2:not(:last-child){
  margin-bottom:5px;
}
.sisennys2:before{
  content:"\2714";
  margin-right:10px;
}
#suljeInfoTeksti{
  text-align:center;
  text-transform:uppercase;
  font-weight:bold;
  cursor:pointer;
  padding-bottom:5px;
  font-size:20px;
  color:red;
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
          <span style="text-transform: none;font-size: 18px;margin-left: 25em;">(Kuittinumero: 
              <?php 
                echo "<strong>".$KuittiNro."</strong>)";  
                $_SESSION['K_Nro'] =  $KuittiNro; 
              ?>
          </span>
          <br>
          <div class="infoboksi" style="display:block;">
              <h5 class="teksti">
                  <?php
                      $sql_Tarina1 = "SELECT Lause_ID,Lause_Tunnus,Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'Tarina-1'";
                      $result_Tarina1 = $conn->query($sql_Tarina1);

                        if ($result_Tarina1->num_rows > 0) {
                            while($row = $result_Tarina1->fetch_assoc())
                              {
                              $Tarina1 =$row["Lause"];
                              echo $Tarina1;
                              }
                        }

                      $sql_Tarina1Sisennykset = "SELECT * FROM tbl_lauseet WHERE Lause_Tunnus like 'Tarina-%,%' AND Lause_Tunnus > 'Tarina-1'";
                      $result_Tarina1Sisennykset = $conn->query($sql_Tarina1Sisennykset);

                        if($result_Tarina1Sisennykset > 0){
                            while($row =mysqli_fetch_assoc($result_Tarina1Sisennykset)){
                              echo "<br><br><br>";
                              echo "<ul class='sisennys'>";
                              echo "<li class='sisennys2'>".$row['Lause']."</li>"."<br>";
                              echo "</ul>";
                            }
                          }

                      $sql_LoputTarinat = "SELECT * FROM `tbl_lauseet` where Lause_Tunnus NOT LIKE 'W-DB-%' AND Lause_Tunnus NOT LIKE 'Tarina-1' AND Lause_Tunnus NOT LIKE 'Tarina-%,%' AND Lause_Tunnus NOT LIKE 'Tietosuoja%'";
                      $result_LoputTarinat = $conn->query($sql_LoputTarinat);

                        if($result_LoputTarinat > 0){
                            while($row =mysqli_fetch_assoc($result_LoputTarinat))
                              {
                                $LoputTarinat =$row["Lause"];
                                echo "<br>".$LoputTarinat."<br>";
                              }
                          }
                  ?>
              </h5>
              <h6 id="suljeInfoTeksti">piilota teksti</h6>
          </div>
          <script>
              $(document).ready(function(){
                $("#suljeInfoTeksti").click(function(){
                  $(".infoboksi").hide();
                });
              });

          </script>
    <br>


        <?php
          $Asiakasnumero =  $_SESSION['Asiakasnumero_2'];

          $HaetaanLukuOikeudet = "SELECT tbl_asiakkaat.Asiakasnumero,
                                         tbl_asiakkaat.Etunimi,
                                         tbl_asiakkaat.Sukunimi,
                                         tbl_lukuoikeudet.Tila,
                                         tbl_lukuoikeudet.Alkaa,
                                         tbl_lukuoikeudet.Paattyy
                                  FROM tbl_asiakkaat
                                  INNER JOIN tbl_lukuoikeudet ON tbl_asiakkaat.Asiakasnumero = tbl_lukuoikeudet.Asiakasnumero
                                  WHERE tbl_lukuoikeudet.Asiakasnumero = '$Asiakasnumero' ORDER BY tbl_lukuoikeudet.Paattyy DESC LIMIT 1";

        $HaetaanLukuOikeudetTulos = $conn->query($HaetaanLukuOikeudet);
        if ($HaetaanLukuOikeudetTulos->num_rows > 0 )
          {
            while($row = $HaetaanLukuOikeudetTulos->fetch_assoc())
                {
                  $Asiakasnumero_2 = $row["Asiakasnumero"];
                  $Etunimi = $row["Etunimi"];
                  $Sukunimi =$row["Sukunimi"];
                  $Tila = $row["Tila"];
                  $Alkaa = $row["Alkaa"];
                  $Paattyy = $row["Paattyy"];
                }
          }

           //Asiakastietojen muokkaus
           $lukuoikeusAlkaa = "$Alkaa";
           $lukuoikeusAlkaaMuokkaus = date("d.m.Y", strtotime($lukuoikeusAlkaa));

           //Asiakastietojen muokkaus
           $lukuoikeusPaattyy = "$Paattyy";
           $lukuoikeusPaattyyMuokkaus = date("d.m.Y", strtotime($lukuoikeusPaattyy));


           


        ?>

    <div class="container">
      <div class="alert alert-danger ilmoitus" style="margin-left:-15px;width:69.4em;">
      <h7 style="margin-left:-10px;">Hyvä<strong><?php echo ' '.$Etunimi.' '.$Sukunimi.', '; ?></strong>tellä on voimassaoleva lukuoikeus Tuottavuusklinikan sisältöön. Voitte ostaa uuden, kun nykyinen on erääntynyt</h7>
      </div>
      <div class="row otsikko" style="text-align:left;text-transform:none;">
        <div class="col-3 ">Asiakasnumero</div>
        <div class="col-4 ">lukuoikeuden haltija</div>
        <div class="col-2 ">alkaa</div>
        <div class="col-2 ">päättyy</div>
        <div class="col-1 "></div>
      </div>
    </div>
    <div class="container">
      <div class="row data" style="text-align:left;text-transform:none;">
      <?php
          if($Tila == 'Voimassa')
            {
                echo "<style>.ilmoitus{display:block;}</style>";
                //Muokkaa Aktiivinen lukuoikeuden haltijan tiedot
                $Muokkaa_Tiedot_Aktiivinen_LukuoikeudenHaltija= "UPDATE tbl_ostoskori SET Aktiivinen_Lukuoikeus = 'KYLLA' WHERE Asiakasnumero = '$Asiakasnumero_2'";
                $Muokkaa_Tiedot_Aktiivinen_LukuoikeudenHaltija_Tulos = $conn->query($Muokkaa_Tiedot_Aktiivinen_LukuoikeudenHaltija);
                  if ($Muokkaa_Tiedot_Aktiivinen_LukuoikeudenHaltija_Tulos->num_rows > 0) 
                    {
                      
                    }

                                 
            }
            else
            {
                echo "<style>.ilmoitus{display:none;}</style>";
            }
        ?>
<?php
  $PaaKayttaja = $Asiakasnumero;

    $TamaPaiva = date("d.m.Y");
    $sql = "SELECT *  FROM tbl_ostoskori WHERE KuittiNro = '$KuittiNro'";
    $result = $conn->query($sql);

      if ($result->num_rows > 0)
        {
          while($row = $result->fetch_assoc())
            {
              $Anro = $row['Asiakasnumero'];
              $Enimi = $row['Etunimi'];
              $Snimi = $row['Sukunimi'];
                if ($PaaKayttaja === $Anro)
                    {
                      echo "<div class='col-3 eka'>$Anro</div>";
                      echo "<div class='col-4 eka'>$Enimi, $Snimi</div>";
                      echo "<div class='col-2 eka'>$TamaPaiva</div>";
                      echo "<div class='col-2 eka'>$lukuoikeusPAATTYY</div>";
                    }
                    else
                    {
                      echo "<div class='col-3'>$Anro</div>";
                      echo "<div class='col-4'>$Enimi, $Snimi</div>";
                      echo "<div class='col-2'>$TamaPaiva</div>";
                      echo "<div class='col-2'>$lukuoikeusPAATTYY</div>";
                      echo "<div class='col-1'><a href='Poist_Asiakas_Ostoskori_jatka.php?AN=$row[Asiakasnumero]' <i style='margin-left:1em;' class='fas fa-trash' data-toggle='tooltip' data-placement='top' title='Poista henkilö'></i></a></div>";
                    }

            }
        }
        else
        {

        }

// Poitetaan näkyvistä Aktiivisen lukuoikeuden omaana
$Piilotetaan_Lukuoikeduen_ostaja_ja_Lukuoikeus_Omaava= "SELECT 
      tbl_asiakkaat.Asiakasnumero, 
      tbl_asiakkaat.Etunimi, 
      tbl_asiakkaat.Sukunimi, 
      tbl_ostoskori.Aktiivinen_Lukuoikeus, 
      tbl_lukuoikeudet.Tila 
  FROM tbl_asiakkaat 
  INNER JOIN tbl_ostoskori ON tbl_ostoskori.Asiakasnumero = tbl_asiakkaat.Asiakasnumero 
  INNER JOIN tbl_lukuoikeudet ON tbl_lukuoikeudet.Asiakasnumero = tbl_asiakkaat.Asiakasnumero 
  WHERE tbl_ostoskori.Aktiivinen_Lukuoikeus = 'KYLLA' AND tbl_lukuoikeudet.Tila = 'Voimassa'";


$Piilotetaan_Lukuoikeduen_ostaja_ja_Lukuoikeus_Omaava_Tulos = $conn->query($Piilotetaan_Lukuoikeduen_ostaja_ja_Lukuoikeus_Omaava);
  if ($Piilotetaan_Lukuoikeduen_ostaja_ja_Lukuoikeus_Omaava_Tulos->num_rows > 0)
      {
        while($row = $Piilotetaan_Lukuoikeduen_ostaja_ja_Lukuoikeus_Omaava_Tulos->fetch_assoc()) 
          {
              $Lukuoikeuden_Tila = $row['Tila'];
              $Lukuoikeuden_Aktiivinen = $row['Aktiivinen_Lukuoikeus'];
              
                if($Lukuoikeuden_Tila == 'Voimassa' && $Lukuoikeuden_Aktiivinen == 'KYLLA')
                  {
                    echo "<style>";
                    echo ".eka{display:none;};";
                    echo "</style>";
                  }
                else
                  {
                    echo "<style>";
                    echo ".eka{display:block;};";
                    echo "</style>";
                  }

              
          }
      }




$Lasketaanehenkiloita = "SELECT count(Asiakasnumero) As LKM, KuittiNro FROM tbl_ostoskori WHERE KuittiNro = '$KuittiNro'";
$LasketaanehenkiloitaTulos = $conn->query($Lasketaanehenkiloita);


   if ($LasketaanehenkiloitaTulos->num_rows > 0) 
      {
        while($row = $LasketaanehenkiloitaTulos->fetch_assoc()) 
          {
              $HloLKM = $row['LKM'];
              $Kuitti_NRO = $row['KuittiNro'];

              if ($HloLKM == 6 && $Kuitti_NRO == $KuittiNro)
                  {
                    echo "<style>";
                    echo ".LisääUusiHenkilö{display:none};";
                    echo "</style>";
                  }
              else
                  {
                  
                  }
          }
      }
      else 
      {
    }



  ?>

      </div>

      <br>
      <div class="row LisääUusiHenkilö">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 "><a href="UusiHenkilö.php"><i  class="fas fa-plus vasenplus"></i>&nbsp;&nbsp;&nbsp;Lisää uusi Henkilö</a> </div>
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 "><a href="UusiHenkilö_Ostoskori_KuitinJatko_1.php"><i  class="fas fa-plus vasenplus"></i>&nbsp;&nbsp;&nbsp;Lisää henkilö ostoskoriin</a> </div>
        </div>
    </div>
    <br>



    
<?php 



//Päivitetään Kuittinuemro ja LukuoikeudTiedot
//MUOKATAA Lukuoikeus PVM ALKAA
$TamaPaiva;
$TamaPaiva_UUSI = date("Y-m-d", strtotime($TamaPaiva));

//MUOKATAA Lukuoikeus PVM PAATTYY
$lukuoikeusPAATTYY;
$lukuoikeusPAATTYY_UUSI = date("Y-m-d", strtotime($lukuoikeusPAATTYY));


$Muokkaa_LuoikeusTiedot = "UPDATE tbl_ostoskori SET Lukuoikeus_Alkaa='$TamaPaiva_UUSI',Lukuoikeus_Paattyy='$lukuoikeusPAATTYY_UUSI'";

$Muokkaa_LuoikeusTiedot_Tulos = $conn->query($Muokkaa_LuoikeusTiedot);
    if ($Muokkaa_LuoikeusTiedot_Tulos->num_rows > 0) 
      {
        echo "Tiedot MUOKATTU";
      }




?>
<!-- Hintaerittelyboksi -->
<style type="text/css">
  .Hintaerittelyboksi_EiKUponkia
  {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    border: 1px solid black;
    margin-bottom: 10px;
  }
  .AsiakasTiedot_Otsikko .row
  {
    padding: 20px;
    text-transform: uppercase;
    font-size: 20px;
  }

  .AsiakasTiedot_Otsikko .row .otsikko
  {
    border-bottom: 1px solid black;
  }
  
  .AsiakasTiedot_Data .row
  {
    padding-left: 10px;
    font-size: 20px;
    font-weight: bold;
    padding-bottom: 10px;
  }

  .Hintaerittelyboksi_EiKUponkia #Hintaerittely,#EtukupokiLisays
  {
    text-align: left;
    margin-top: 2em;
    margin-left: 15px;
  }

  .alert-danger,.alert-info,.alert-warning,.alert-success
  {
    width: 80%;
    margin-left: 1.5%;
    text-align: center;
  }
  
  
  strong
  {
    text-transform: uppercase;
    
  }

</style>

<div class="Hintaerittelyboksi_EiKUponkia">
  
<!-- Asiakastidot-otsikko -->
<div class="AsiakasTiedot_Otsikko"> 
  <div class="row">
    <div class="col otsikko">Asiakasnumero</div>
    <div class="col otsikko">Nimi</div>
  </div>
</div>

<?php 

$Haetaan_Asiakkaat = "SELECT * FROM tbl_ostoskori WHERE KuittiNro = '$KuittiNro'";

$Haetaan_Asiakkaat_Tulos = $conn->query($Haetaan_Asiakkaat);
 
?>

<!-- Asiakastidot-data -->
<div class="AsiakasTiedot_Data"> 

<?php 
 if ($Haetaan_Asiakkaat_Tulos->num_rows > 0)
    {
      while($row = $Haetaan_Asiakkaat_Tulos->fetch_assoc())
          {
            $Asiakasnumero_erittely = $row["Asiakasnumero"];
            $Etunimi_erittely = $row["Etunimi"];
            $Sukunimi_erittely =$row["Sukunimi"];
            $Aktiivinen_Lukuoikeus_erittely =$row["Aktiivinen_Lukuoikeus"];


            

            if($PaaKayttaja === $Asiakasnumero_erittely)
              {
                echo " <div class='row'>
                  <div class='col EKA'>$Asiakasnumero_erittely</div>
                  <div class='col EKA'>$Etunimi_erittely $Sukunimi_erittely</div>
              </div>";

                if($Aktiivinen_Lukuoikeus_erittely == 'KYLLA')
                  {
                    echo "<style>";
                    echo ".EKA{display:none}";
                    echo "</style>";
                  }
              }
            else
              {
                echo " <div class='row'>
                  <div class='col'>$Asiakasnumero_erittely</div>
                  <div class='col'>$Etunimi_erittely $Sukunimi_erittely</div>
                </div>";
              }
            
          }
    }
?>



</div>

<?php 
//Lasketaan Lukuoikeuden Hinta Ilman alennusta

$Ahinta = $A_Hinta;
$ErotaTuhannet_Ahinta = $Ahinta;
$MuokattuTuhannet_ErotaTuhannet_Ahinta = number_format($ErotaTuhannet_Ahinta , 2, ',', ' ');

//Lasketaan veron määrää 24% - A-hinnasta
$ALV_Maara = $Vero_Prosentti * $Ahinta /100;

//Lasketaan lopullinnen maksettava summa sekä erotelalan tuhannesosat
$Loppusumma = $Ahinta + $ALV_Maara;

$ErotaTuhannet_Loppusumma = $Loppusumma;
$MuokattuTuhannet_Loppusumma = number_format($ErotaTuhannet_Loppusumma , 2, ',', ' ');



?>






<p id="Hintaerittely">Maksuerittely </p>
<!-- HintaTiedot-->
<div class="AsiakasTiedot_Otsikko" id="A_Hinta"> 
  <div class="row">
    <div class="col otsikko">A-Hinta (€)</div>
    <div class="col otsikko">Vero (%)</div>
    <div class="col otsikko">Vero (€)</div>
    <div class="col otsikko">Yhteensä + alv (€)</div>
  </div>
</div>

<!-- Asiakastidot-data -->
<div class="AsiakasTiedot_Data" id="A_Hinta"> 
  <div class="row">
    <div class="col "><?php echo $MuokattuTuhannet_ErotaTuhannet_Ahinta; ?></div>
    <div class="col "><?php echo $Vero_Prosentti; ?></div>
    <div class="col "><?php echo $ALV_Maara; ?></div>
    <div class="col "><?php echo $MuokattuTuhannet_Loppusumma; ?> €</div>
  </div>
</div>

<p id="EtukupokiLisays">Lunasta etukuponki</p>
  <form method="POST">
    <div class="container">
      <div class="row">
        <div class="col"><input type="text" class="form-control" placeholder="Syötä kuponkinumero" name="KuponkiKOODI" id="email"></div>
        <div class="col"><button type="submit" name="Lunasta_Kuponki" class="btn btn-primary">Lunasta</button></div>
      </div>
    </div>
</form>
<br>
<?php 
  if(isset($_POST['Lunasta_Kuponki']))
    {
       $ETKNRO = mysqli_real_escape_string($conn,$_POST['KuponkiKOODI']);
          
           if((empty($_POST['KuponkiKOODI'])))
              {
                echo "
                  <div class='alert alert-danger'>
                   <strong>ETUKUPONKINUMERO ON PAKOLLINEN</strong>
                  </div>";
              }
            else
              {
                  $HaeEtukuponkiTietoja = "SELECT tbl_asiakas_etukupongit.Tila,tbl_etukupongit.KuponkiNumero
                  FROM tbl_asiakas_etukupongit
                  INNER JOIN tbl_etukupongit ON tbl_asiakas_etukupongit.Kuponkinumero = tbl_etukupongit.KuponkiNumero
                  WHERE tbl_etukupongit.KuponkiNumero = '$ETKNRO'";

                  $Kuponki_Tarkistus_kysely_Tulos = mysqli_query($conn, $HaeEtukuponkiTietoja);
                  $Kuponki = mysqli_fetch_assoc($Kuponki_Tarkistus_kysely_Tulos);

                  if($Kuponki)
                    {
                        if($Kuponki['Tila'] === 'Lunastettu')
                          {

                             echo "
                                <div class='alert alert-info'>
                                 <strong>SYÖTETY ETUKUPONKI ON LUNASTETU</strong>
                                </div>";
                          }
                        else
                          {

                          }
                    }
                  else
                    {
                      
                      echo "
                          <div class='alert alert-warning'>
                           <strong>SYÖTETY ETUKUPONKI EI OLE OLEMASSA TAI SE ON VIRHEELLINEN</strong>
                          </div>";
                    }

                  if($Kuponki)
                    {
                        if (($Kuponki['KuponkiNumero'] === $ETKNRO) && ($Kuponki['Tila'] === 'Lunastamatta'))
                        {
                            echo "<div class='alert alert-success'>
                                  <strong>ALEKUPONKI ON LISÄTTY KUITILLE ONNISTUNEESTI
                                  <br><br>KUPONKINUMERO: $ETKNRO
                                  </strong>
                                 </div>";

                            //Haetaan Kupongin Arvo
                            $sql_HaeArvo = "SELECT Arvo FROM tbl_etukupongit WHERE KuponkiNumero = '$ETKNRO'";
                            $result_HaeArvo = $conn->query($sql_HaeArvo);

                            if ($result_HaeArvo->num_rows > 0) {

                                while($row = $result_HaeArvo->fetch_assoc()) {
                                  $Arvo =$row["Arvo"];

                                }

                            }


                          //Muokkaa Etukuponki tila
                          $Lisays_PVM = date('Y-m-d');
                          $Muokaa_Etukuponki_Tila = "UPDATE tbl_asiakas_etukupongit SET Tila='Lunastettu',LunastettuPVM='$Lisays_PVM' WHERE KuponkiNumero = '$ETKNRO'";

                          $result_Muokaa_Etukuponki_Tila = $conn->query($Muokaa_Etukuponki_Tila);


                          /* * * * * Suoritetaan Laskutoiminpide * * * * */
                            if($Arvo == '100')
                                {
                                    //Lasketaan Alennuksen määrä euroissa
                                    $Alennus_Euroissa = $Ahinta * $Arvo / 100;

                                    // Vähenentään alennus Alkuperäisestä hinnasta
                                    $Hinta_alennnuksen_Jalkeen = $Ahinta - $Alennus_Euroissa;
                                    $MuokattuTuhannet_Hinta_alennnuksen_Jalkeen = number_format($Hinta_alennnuksen_Jalkeen , 2, ',', ' ');

                                    $Veron_Maara_2 = $Vero_Prosentti * $Hinta_alennnuksen_Jalkeen;
                                    //Lasketaan lopullinen summa alv + alennus sekä erotellaan tuhannesosat

                                    $Loppusumma_2 = $Veron_Maara_2 + $Hinta_alennnuksen_Jalkeen;
                                    
                                    $ErotaTuhannet_Loppusumma_2 = $Loppusumma_2;
                                    $MuokattuTuhannet_Loppusumma_2 = number_format($ErotaTuhannet_Loppusumma_2 , 2, ',', ' '); 

                                    
                                    
                                }
                            else
                                {
                                    //Lasketaan Alennuksen määrä euroissa
                                    $Alennus_Euroissa = $Ahinta * $Arvo / 100;

                                    // Vähenentään alennus Alkuperäisestä hinnasta
                                    $Hinta_alennnuksen_Jalkeen = $Ahinta - $Alennus_Euroissa;
                                    $MuokattuTuhannet_Hinta_alennnuksen_Jalkeen = number_format($Hinta_alennnuksen_Jalkeen , 2, ',', ' ');

                                    //Lasketaan veron määrä euroissa alennetusta hinnasta
                                    $Veron_Maara_2 = $Vero_Prosentti * $Hinta_alennnuksen_Jalkeen / 100;

                                    //Lasketaan lopullinen summa alv + alennus sekä erotellaan tuhannesosat

                                    $Loppusumma_2 = $Veron_Maara_2 + $Hinta_alennnuksen_Jalkeen;
                                    
                                    $ErotaTuhannet_Loppusumma_2 = $Loppusumma_2;
                                    $MuokattuTuhannet_Loppusumma_2 = number_format($ErotaTuhannet_Loppusumma_2 , 2, ',', ' '); 
                                }
                            
                           


                           

                             




                    ?>
                          <p id="Hintaerittely" >Maksuerittely ( <strong>vähennyksen jälkeen</strong> )</p>
                              <!-- HintaTiedot-->
                              <div class="AsiakasTiedot_Otsikko" id="A_Hinta"> 
                                <div class="row">
                                  <div class="col otsikko">A-Hinta (€)</div>
                                  <div class="col otsikko">Ale- (%)</div>
                                  <div class="col otsikko">Ale- (€)</div>
                                  <div class="col otsikko">Alv-0% (€)</div>
                                  <div class="col otsikko">Vero (%)</div>
                                  <div class="col otsikko">Vero (€)</div>
                                  <div class="col otsikko">Yhteensä + alv (€)</div>
                                </div>
                              </div>


                              <!-- Asiakastidot-data -->
                              <div class="AsiakasTiedot_Data"  id="A_Hinta"> 
                                <div class="row">
                                  <div class="col "><?php echo $MuokattuTuhannet_ErotaTuhannet_Ahinta; ?></div>
                                  <div class="col "><?php echo $Arvo; ?></div>
                                  <div class="col "><?php echo $Alennus_Euroissa; ?></div>
                                  <div class="col "><?php echo $MuokattuTuhannet_Hinta_alennnuksen_Jalkeen; ?></div>
                                  <div class="col "><?php echo $Vero_Prosentti; ?></div>
                                  <div class="col "><?php echo $Veron_Maara_2; ?></div>
                                  <div class="col "><?php echo $MuokattuTuhannet_Loppusumma_2; ?> €</div>
                                </div>
                              </div>
                    <?php

                        }
                        else
                        {
  
                        }
                    }
                  else
                    {
                      
                    }


              }
    }


            
?>

</div>



<!-- 
  <a href="AsiakasprofiiliC.php"><button type="submit" name="submit" id="submit" style="outline:none;float:left;width:450px;margin-left:50px;" class="Muokkaa btn btn-outline-primary text">Palaa takaisin asiakasprofiilin</button></a>
  <a href="ValitsePankki.php"><button type="submit" name="submit" id="submit" style="outline:none;float:right;width:450px;margin-right:50px;margin-top:-48px;" class="Muokkaa btn btn-outline-primary text SIIRRYMAKSAMAAN">Siirry maksamaan</button></a>
  -->
  <?php 
    if(isset($_POST['asiakasprofiili']))
      {
        //Katsotaan ONKO kuitille tehty mitään
        $Tarkista_kuitin_tila = "SELECT Kuitti_Tila FROM tbl_ostoskori WHERE KuittiNro = '$KuittiNro'";
        $result_Tarkista_kuitin_tila = $conn->query($Tarkista_kuitin_tila);
          if ($result_Tarkista_kuitin_tila->num_rows > 0) 
            {
                  while($row = $result_Tarkista_kuitin_tila->fetch_assoc()) 
                  {
                    $Tila = $row['Kuitti_Tila'];
                  }
            }

      }
  
  ?>
  <div class="container">
  <div class="row" style="text-align:center;margin-top:20px;">
  <div class="col-sm-3">
    <form method ="POST">
      
    <a href="#"><button type="submit" name="asiakasprofiili" class="btn btn-outline-primary" style="width:200px;text-transform:uppercase;">asiakasprofiilin</button></a></div>
    <div class="col-sm-3">
    <a href="Keskeyta.php"><button type="button" name="keskeyta" class="btn btn-outline-secondary" style="width:200px;text-transform:uppercase;">keskeytä tapahtuma</button></a></div>
    <div class="col-sm-3">
    <a href="peruuta.php"><button type="button"  class="btn btn-outline-danger" style="width:200px;text-transform:uppercase;">peruuta tapahtuma</button></a></div>
    <div class="col-sm-3">
    <a href="ValitsePankki.php"><button type="button" class="btn btn-outline-success" style="width:200px;text-transform:uppercase;">maksamaan</button></a></div>
    </form>
    
  </div>
  
</div>
<?php 
    if($Tila == 'Avoin')
    { 

  ?>
      <br>
      <div class="alert alert-warning alert-dismissible w-100" style="margin-left:-0px;">
        <strong>HUOM!</strong> Palataaksesi takaisin asiakasprofiilin, sinun täytyy päättää avoimena oleva kuitti.
        <br>
        <a style="font-weight:bold;text-transform:uppercase;" href="keskayta_2.php"<strong>keskeytä kuitti ja siirry asiakasprofiilin </strong></a>
      </div>
  <?php
    }
  ?>
<?php 

if($Kuponki == NULL)
    {
      $_SESSION['MAKSETTAVAsumma'] = $Loppusumma;
      $_SESSION['VeroOsuus'] = $ALV_Maara;
      $_SESSION['Ahinta'] = $Ahinta;
      $_SESSION['Kuittinumero'] = $KuittiNro;
      $_SESSION['Lukuoikeus_Ostaja'] = $PaaKayttaja;



      $Muokkaa_LuoikeusTiedot = "UPDATE tbl_ostoskori SET Loppusumma='$Loppusumma' WHERE KuittiNro = '$KuittiNro' AND L_Ostaja = 'KYLLA'";

      $Muokkaa_LuoikeusTiedot_Tulos = $conn->query($Muokkaa_LuoikeusTiedot);
        if ($Muokkaa_LuoikeusTiedot_Tulos->num_rows > 0) 
          {
            
          }


      //Haetaan L_ostajan Asiakasnumero ja Merkataan Tietoihin K
       $sql_Lostaja = "SELECT Asiakasnumero,Etunimi,Sukunimi FROM tbl_ostoskori WHERE Asiakasnumero = '$PaaKayttaja' LIMIT 1";
       $result_Lostaja = $conn->query($sql_Lostaja);

          if ($result_Lostaja->num_rows > 0) {

              while($row = $result_Lostaja->fetch_assoc()) {
                $Lostaja_Asiakasnumero =$row["Asiakasnumero"];
                    if($Lostaja_Asiakasnumero === $PaaKayttaja)
                          {
                            // Merkitään Pääkäyttäjä eli Lukuoikeuden Ostajaksi 'K'
                            $Muokkaa_LuoikeusOstajan_Tiedot_K = "UPDATE tbl_ostoskori SET L_Ostaja = 'KYLLA',Vero_prosentti ='$Vero_Prosentti',A_hinta='$Ahinta' WHERE Asiakasnumero = '$PaaKayttaja'";
                              $_SESSION['VEROPROSENTTI'] = $Vero_Prosentti;

                            $Muokkaa_LuoikeusOstajan_Tiedot_K_Tulos = $conn->query($Muokkaa_LuoikeusOstajan_Tiedot_K);
                              if ($Muokkaa_LuoikeusOstajan_Tiedot_K_Tulos->num_rows > 0) 
                                  {
                                    

                                  }

                            // Merkitään EI Lukuoikeuden Ostajaksi 'EI'
                            $Muokkaa_LuoikeusOstajan_Tiedot_E = "UPDATE tbl_ostoskori SET L_Ostaja = 'EI' WHERE Asiakasnumero != '$PaaKayttaja'";
                            $Muokkaa_LuoikeusOstajan_Tiedot_E_Tulos = $conn->query($Muokkaa_LuoikeusOstajan_Tiedot_E);
                              if ($Muokkaa_LuoikeusOstajan_Tiedot_E_Tulos->num_rows > 0)
                                  {

                                  }
                          }
                          else
                          {

                          }

              }

          }


    }
  else
    {
      $_SESSION['MAKSETTAVAsumma'] = $MuokattuTuhannet_Loppusumma_2;
      $_SESSION['VeroOsuus'] = $ALV_Maara_2;
      $_SESSION['Ahinta'] = $Ahinta;
      $_SESSION['Kuittinumero'] = $KuittiNro;
      $_SESSION['Lukuoikeus_Ostaja'] = $PaaKayttaja;
      $_SESSION['KUponki_numero'] = $ETKNRO;


      $Muokkaa_LuoikeusTiedot = "UPDATE tbl_ostoskori SET Loppusumma='$Loppusumma_2',Etukuponki='$ETKNRO' WHERE KuittiNro = '$KuittiNro'";

      $Muokkaa_LuoikeusTiedot_Tulos = $conn->query($Muokkaa_LuoikeusTiedot);
        if ($Muokkaa_LuoikeusTiedot_Tulos->num_rows > 0) 
          {
            
          }


      //Haetaan L_ostajan Asiakasnumero ja Merkataan Tietoihin K
       $sql_Lostaja = "SELECT Asiakasnumero,Etunimi,Sukunimi FROM tbl_ostoskori WHERE Asiakasnumero = '$PaaKayttaja' LIMIT 1";
       $result_Lostaja = $conn->query($sql_Lostaja);

          if ($result_Lostaja->num_rows > 0) {

              while($row = $result_Lostaja->fetch_assoc()) {
                $Lostaja_Asiakasnumero =$row["Asiakasnumero"];
                    if($Lostaja_Asiakasnumero === $PaaKayttaja)
                          {
                            // Merkitään Pääkäyttäjä eli Lukuoikeuden Ostajaksi 'K'
                            $Muokkaa_LuoikeusOstajan_Tiedot_K = "UPDATE tbl_ostoskori SET L_Ostaja = 'KYLLA',Vero_prosentti ='$Vero_Prosentti',
                            A_hinta='$Ahinta' WHERE Asiakasnumero = '$PaaKayttaja'";
                            $_SESSION['VEROPROSENTTI'] = $Vero_Prosentti;

                            $Muokkaa_LuoikeusOstajan_Tiedot_K_Tulos = $conn->query($Muokkaa_LuoikeusOstajan_Tiedot_K);
                              if ($Muokkaa_LuoikeusOstajan_Tiedot_K_Tulos->num_rows > 0) 
                                  {
                                   
                                  }

                             // Merkitään EI Lukuoikeuden Ostajaksi 'EI'
                            $Muokkaa_LuoikeusOstajan_Tiedot_E = "UPDATE tbl_ostoskori SET L_Ostaja = 'EI' WHERE Asiakasnumero != '$PaaKayttaja'";
                            $Muokkaa_LuoikeusOstajan_Tiedot_E_Tulos = $conn->query($Muokkaa_LuoikeusOstajan_Tiedot_E);
                              if ($Muokkaa_LuoikeusOstajan_Tiedot_E_Tulos->num_rows > 0)
                                  {

                                  }
                          }
                          else
                          {

                          }
              }
          }
    }


?>

  <br>
            </div>
      </div>
    </div>
  </div>

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
