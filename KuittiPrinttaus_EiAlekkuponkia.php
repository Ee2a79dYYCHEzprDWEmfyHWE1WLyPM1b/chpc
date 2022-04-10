  <?php

include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/Connect.php';
require 'Funktiot/Kuitti_LuoPDF_Ei_Etukuponki.php';
require 'Funktiot/Kuitti_LuoPDF_Ei_Etukuponki_Laheta_Sposti.php';

error_reporting(0);
$Lisays_PVM = date('Y-m-d');
$Kuittinumero = $_SESSION['Kuittinumero'];
$Loos_Sposti = $_SESSION['Sposti_2'];





?>
<?php

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }

}



//Hankitaan Ostoskoritiedot
$HaeOstoskoriSisalto = "SELECT Kuittinumero,Paivays,Vero_prosentti,A_hinta FROM tbl_kuitit WHERE Kuittinumero = '$Kuittinumero'";

$HaeOstoskoriSisalto_Tulos = $conn->query($HaeOstoskoriSisalto);

if ($HaeOstoskoriSisalto_Tulos->num_rows > 0) {

    while($row = $HaeOstoskoriSisalto_Tulos->fetch_assoc()) {
      $KuittiNRO = $row["Kuittinumero"];
      $PVM = $row["Paivays"];
      $Vero_Prosentti = $row["Vero_prosentti"];
      $Ahinta = $row["A_hinta"];

      //MUOKATAA Lukuoikeus PVM 
        $PVM_UUSI = date("d.m.Y", strtotime($PVM));
    }
}     



//Hankitaan Lukuoikeuden Ostajan Tiedot
$Hankitaan_LOstajan_Tiedot = "SELECT
tbl_asiakkaat.Asiakasnumero,
tbl_asiakkaat.Etunimi,
tbl_asiakkaat.Sposti,
tbl_asiakkaat.Sukunimi 
FROM tbl_asiakkaat 
  INNER JOIN tbl_kuitit ON tbl_kuitit.Asiakasnumero = tbl_asiakkaat.Asiakasnumero 
  WHERE tbl_kuitit.Kuittinumero = '$Kuittinumero' 
  AND tbl_kuitit.LukuoikeudenOSTAJA = 'KYLLA'";

$Hankitaan_LOstajan_Tiedot_Tulos = $conn->query($Hankitaan_LOstajan_Tiedot);

if ($Hankitaan_LOstajan_Tiedot_Tulos->num_rows > 0) {

    while($row = $Hankitaan_LOstajan_Tiedot_Tulos->fetch_assoc()) {
      $Lostaja_AsNro      =   $row["Asiakasnumero"];
      $Lostaja_ENimi      =   $row["Etunimi"];
      $Lostaja_SNimi      =   $row["Sukunimi"];
      $Lostaja_Sposti      =   $row["Sposti"];
    }
} 


//Hankitaan Lukuoikeuden Ostajan YritysTIEDOT
$Hankitaan_LOstajan_yritysTiedot = "SELECT 
tbl_yritykset.Y_tunnus,
tbl_yritykset.YrityksNimi 
FROM tbl_yritykset 
INNER JOIN tbl_asiakkaat ON tbl_yritykset.Y_tunnus = tbl_asiakkaat.Y_tunnus 
WHERE tbl_asiakkaat.Asiakasnumero = '$Lostaja_AsNro'";

$Hankitaan_LOstajan_yritysTiedot_Tulos = $conn->query($Hankitaan_LOstajan_yritysTiedot);

if ($Hankitaan_LOstajan_yritysTiedot_Tulos->num_rows > 0) {

    while($row = $Hankitaan_LOstajan_yritysTiedot_Tulos->fetch_assoc()) {
      $Lostaja_ytunnus   =   $row["Y_tunnus"];
      $Lostaja_yNIMI     =   $row["YrityksNimi"];
    }
} 



//Hankitaan kaikki Lukuoikeuden Haltjat
$Hankitaan_Lukuoikeuden_KaikkiHaktijat_Tiedot = "SELECT 
tbl_asiakkaat.Asiakasnumero, 
tbl_asiakkaat.Etunimi, 
tbl_asiakkaat.Sukunimi, 
tbl_lukuoikeudet.Alkaa, 
tbl_lukuoikeudet.Paattyy 
FROM tbl_asiakkaat 
INNER JOIN tbl_kuitit ON tbl_asiakkaat.Asiakasnumero = tbl_kuitit.Asiakasnumero 
INNER JOIN tbl_lukuoikeudet ON tbl_lukuoikeudet.Asiakasnumero = tbl_asiakkaat.Asiakasnumero 
WHERE tbl_kuitit.Kuittinumero = '$Kuittinumero' 
AND tbl_lukuoikeudet.Tila = 'Voimassa' 
GROUP BY tbl_asiakkaat.Asiakasnumero";

$Hankitaan_Lukuoikeuden_KaikkiHaktijat_Tiedot_Tulos = $conn->query($Hankitaan_Lukuoikeuden_KaikkiHaktijat_Tiedot); 





/*HANKITAAN YRITYKSEN NIMI*/
$sql_HaeYrityksen_NIMI = "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-33'";
$result_sql_HaeYrityksen_NIMI = $conn->query($sql_HaeYrityksen_NIMI);

if ($result_sql_HaeYrityksen_NIMI->num_rows > 0) {

    while($row = $result_sql_HaeYrityksen_NIMI->fetch_assoc()) {
      $yrityksenNimi = $row["Lause"];
    }
}

/*HANKITAAN YRITYKSEN NIMI*/
$sql_HaeYrityksen_yTUNNUS = "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-34'";
$result_sql_HaeYrityksen_yTUNNUS = $conn->query($sql_HaeYrityksen_yTUNNUS);

if ($result_sql_HaeYrityksen_yTUNNUS->num_rows > 0) {

    while($row = $result_sql_HaeYrityksen_yTUNNUS->fetch_assoc()) {
      $yrityksenYTUNNUS = $row["Lause"];
    }
}

/*HANKITAAN YRITYKSEN PUHELINNUMERO*/
$sql_HaeYrityksen_PUHELINNUMERO = "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-35'";
$result_sql_HaeYrityksen_PUHELINNUMERO = $conn->query($sql_HaeYrityksen_PUHELINNUMERO);

if ($result_sql_HaeYrityksen_PUHELINNUMERO->num_rows > 0) {

    while($row = $result_sql_HaeYrityksen_PUHELINNUMERO->fetch_assoc()) {
      $yrityksenPUHELINNUMERO = $row["Lause"];
    }
}


/*HANKITAAN YRITYKSEN Osoite*/
$sql_HaeYrityksen_Osoite = "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-38'";
$result_sql_HaeYrityksen_Osoite = $conn->query($sql_HaeYrityksen_Osoite);

if ($result_sql_HaeYrityksen_Osoite->num_rows > 0) {

    while($row = $result_sql_HaeYrityksen_Osoite->fetch_assoc()) {
      $yrityksenOsoite = $row["Lause"];
    }
}

/*HANKITAAN YRITYKSEN INFO*/
$sql_HaeYrityksen_INFO = "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-37'";
$result_sql_HaeYrityksen_INFO = $conn->query($sql_HaeYrityksen_INFO);

if ($result_sql_HaeYrityksen_INFO->num_rows > 0) {

    while($row = $result_sql_HaeYrityksen_INFO->fetch_assoc()) {
      $yrityksenINFO = $row["Lause"];
    }
}





$conn->close();
?>
<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC - KUITTI </title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
      .body > button{
        height:50px;
        width:450px;
        text-align:center;
        margin-left:20em;
        text-transform:uppercase;
        letter-spacing:5px;
        font-weight:600;
        background-color:rgb(135,206,250,0.1);
      }
      .body > button:hover{
        background-color:rgb(135,206,250,0.5);
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
      .container > .row >.body hr{
        margin-top:2rem;

      }
      .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
        width:280px;
}
      .Painikkeet{
        display:flex;
        column-gap: 5%;
        margin-left:4.5rem;
        margin-top:1rem;
        margin-bottom:1rem;
        text-transform:uppercase;
}
      .Painikkeet a{
       text-decoration:none;
        color:white;
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
.btn-primary,.btn-danger
{
    margin-left: 17em;
    padding: 15px;
    border-radius: 0%;
    width: 50%;
    text-transform: uppercase;
    margin-top: 1em;
}

  </style>


<div class="container">
    <div class="row">
        <div class="col-xl header">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 Logo"><a style="text-decoration:none;" href="index.php">
                        <span style="color:RGB(244,160,0);">Tuottavuus</span>
                        <span style="color:RGB(15,157,88);">klinikat</span>
                      </a></div>
                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#myModal_2" >Missio</a></li>
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
<style>
.box {
  border: 2.5px solid black;
  width:300px;
  border-radius: 10px 10px 10px 10px;
  margin-left:3em;
  margin-top:2em;
}
.box:checked{
  border: 5px solid black;
}
.box:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);;
}
img{
  margin-left:15px;
  margin-top:15px;
  margin-bottom:15px;
}
.Kuitti{
  margin: auto;
  width: 80%;
  background-color: white;
  padding: 10px;
  height: auto;
}

</style>


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
        <p class="otsikko" style="font-size:35px;letter-spacing:2px;">maksun vahvistus</p>
              <br>
              <div class="Kuitti">
                  <p class="otsikko" style="font-size:35px; font-weight:bold;letter-spacing:2px;color:rgb(135,206,250,0.9);">Kuitti</p>
                  <div class="kuittiInfo" style="text-align:left;margin-left:10px;">
                    <p style="text-align:left;font-size:15px;text-transform:uppercase;">arvoisa asiakas, maksunne lukuoikeuksien hankkimisesta Tuottavuusklinikan sivuille onnistui!
                      tässä kuitissa näette hankkimanne lukuoikeudet haluituille henkilöille. 
                      SAATTE MYÖS HETKEN KULUTTUA VASTAAVALAISEN PDF-TIEDOSTONA SÄHKÖPOSTIIN YRITYKSENNE KIRJANPITOA VARTEN.
                      
                    </p>
                  </div>
                    <br><br>
                    <!-- Kuittitiedot-->
                  <p class="kuittisisalto" style="text-align:left;margin-left:10px;font-size:25px;letter-spacing:2px;font-weight:bold;color:rgb(135,206,250,0.9);">Kuittitiedot</p>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Päiväys</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $PVM_UUSI; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">kuittinumero</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $KuittiNRO; ?></div>
                      <?php $_SESSION['Kuittinumero_100'] = $KuittiNRO;
                            $_SESSION['KuittiPVM_100'] = $PVM_UUSI; 
                      ?>
                  </div>

                 <!-- Yrityksentiedot-->
                  <br>
                  <p class="kuittisisalto" style="text-align:left;margin-left:10px;font-size:25px;letter-spacing:2px;font-weight:bold;color:rgb(135,206,250,0.9);">LASKUTTAJAN TIEDOT</p>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Nimi</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $yrityksenNimi; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Y-tunnus</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?PHP ECHO $yrityksenYTUNNUS; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Puhelin</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?PHP ECHO $yrityksenPUHELINNUMERO; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Osoite</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?PHP ECHO $yrityksenOsoite; ?></div>
                  </div>
                   <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Asiakaspalvelu</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?PHP ECHO $yrityksenINFO; ?></div>
                  </div>


                  <!-- Asiakastiedot-->
                  <br>
                  <p class="kuittisisalto" style="text-align:left;margin-left:10px;font-size:25px;letter-spacing:2px;font-weight:bold;color:rgb(135,206,250,0.9);">Asiakastiedot (Lukuoikeuden ostaja)</p>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Asiakasnumero</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Lostaja_AsNro; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Nimi</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Lostaja_ENimi." ".$Lostaja_SNimi; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Sähköposti</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Lostaja_Sposti; ?></div>
                      <?php 
                      $_SESSION['Lo_sposti'] = $Lostaja_Sposti; 
                      $_SESSION['Lo_nimi'] = $Lostaja_ENimi." ".$Lostaja_SNimi;
                      
                      ?>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Yritys</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Lostaja_yNIMI; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Y-tunnus</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Lostaja_ytunnus; ?></div>
                  </div>




                  <p class="otsikko" style="text-align:left;font-size:25px;margin-left:10px;font-weight:bold;letter-spacing:2px;margin-top:2em;margin-bottom:1em;color:rgb(135,206,250,0.9);">lukuoikeuden haltijat</p>
                  <div class="row" style="margin-bottom:-25px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-3" style="text-transform:uppercase;">Asiakasnumero</div>
                      <div class="col-sm-5" style="text-transform:uppercase;">nimi</div>
                      <div class="col-sm-2" style="text-transform:uppercase;">Alkaa</div>
                      <div class="col-sm-2" style="text-transform:uppercase;">Päättyy</div>
                  </div>
                  <hr style="border-top: 1px solid black;">
                  <div class="row" style="margin-top:25px;margin-left:0px;margin-right:0px;">

                  <?php 
                   if ($Hankitaan_Lukuoikeuden_KaikkiHaktijat_Tiedot_Tulos->num_rows > 0) 
                   {
                      while($row = $Hankitaan_Lukuoikeuden_KaikkiHaktijat_Tiedot_Tulos->fetch_assoc()) 
                        {
                          $Lukuikeus_AsNro       =   $row["Asiakasnumero"];
                          $Lukuikeus_ENimi       =   $row["Etunimi"];
                          $Lukuikeus_Sukunimi    =   $row["Sukunimi"];
                          $Lukuikeus_Alkaa       =   $row["Alkaa"];
                          $Lukuikeus_Paattyy     =   $row["Paattyy"];
                        
                          //Ekupogin LunastuPVM
                          $Lukuikeus_Alkaa_Muokkaus = $Lukuikeus_Alkaa;
                          $Lukuikeus_Alkaa_Muokkaus_Tulostus = date("d.m.Y", strtotime($Lukuikeus_Alkaa_Muokkaus));

                          //Ekupogin LuomisPVM
                          $Lukuikeus_Paattyy_Muokkaus = $Lukuikeus_Paattyy;
                          $Lukuikeus_Paattyy_Muokkaus_Tulostus = date("d.m.Y", strtotime($Lukuikeus_Paattyy_Muokkaus));



                          echo "<div class='col-sm-3' style='font-weight:bold;text-transform:uppercase;'>$Lukuikeus_AsNro</div>";
                          echo "<div class='col-sm-5' style='font-weight:bold;text-transform:uppercase;'>$Lukuikeus_ENimi $Lukuikeus_Sukunimi</div>";
                          echo "<div class='col-sm-2' style='font-weight:bold;text-transform:uppercase;'>$Lukuikeus_Alkaa_Muokkaus_Tulostus</div>";
                          echo "<div class='col-sm-2' style='font-weight:bold;text-transform:uppercase;'>$Lukuikeus_Paattyy_Muokkaus_Tulostus</div>";
                        }
                  }
                  
                  ?>
              </div>
              <br>
               
                <?php 
                  //Erotellaan ensin tuhanneosat
                      $ErotaTuhannet_Yksikköhinta = $Ahinta;
                      $MuokattuTuhannet_Yksikköhinta = number_format($ErotaTuhannet_Yksikköhinta , 2, ',', ' ');


                  

                      //Lasketaan veron määrää 24% - A-hinnasta
                      $ALV_Maara = $Vero_Prosentti * $Ahinta / 100;

                      //Lasketaan lopullinnen maksettava summa sekä erotelalan tuhannesosat
                      $Loppusumma = $Ahinta + $ALV_Maara;

                      $ErotaTuhannet_Loppusumma = $Loppusumma;
                      $MuokattuTuhannet_Loppusumma = number_format($ErotaTuhannet_Loppusumma , 2, ',', ' ');

                      $_SESSION['Summa_100'] = $MuokattuTuhannet_Loppusumma;

                ?>
                <!-- Hintaerittely, kun alekuponkia ei ole käytetty-->

                    <p class="otsikko" style="text-align:left;font-size:20px;margin-left:10px;font-weight:bold;letter-spacing:2px;margin-top:3em;margin-bottom:1em;color:rgb(135,206,250,0.9);">maksutiedot (ALV- eritelty)</p>
                <div id="Ei_alekuponkia">
                    <div class="row" style="margin-bottom:-25px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-3" style="text-transform:uppercase;">A-hinta ( € )</div>
                      <div class="col-sm-3" style="text-transform:uppercase;">ALV ( % )</div>
                      <div class="col-sm-4" style="text-transform:uppercase;">ALV ( € )</div>
                      <div class="col-sm-2" style="text-transform:uppercase;">yhteensä + ALV</div>
                    </div>
                    <hr style="border-top: 1px solid black;">
                      <div class="row" style="margin-top:20px;margin-left:0px;margin-right:0px;">
                        <div class="col-sm-3" style="text-transform:uppercase;"><?php echo $MuokattuTuhannet_Yksikköhinta; ?></div>
                        <div class="col-sm-3" style="text-transform:uppercase;"><?php echo $Vero_Prosentti; ?></div>
                        <div class="col-sm-4" style="text-transform:uppercase;"><?php echo $ALV_Maara; ?></div>
                        <div class="col-sm-2" style="text-transform:uppercase;padding-left: 4%;font-weight: bold;">
                            <?php echo $MuokattuTuhannet_Loppusumma; ?> €</div>
                      </div>
                </div>
                  <br>
              </div>
              <form method="POST">
                  <button type="submit" class="btn btn-danger" name="LUO_PDF">LUO PDF</button>
              </form>
                  <a href="KirjauduVaiheC.php"><button type="submit" class="btn btn-primary" >Siirry asiakasprofiilin sivuille</button></a>
          <br><br>
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
<script src="SweetAlert/jquery/jquery-3.3.1.min.js"></script>
    <script src="SweetAlert/popper/popper.min.js"></script>
    <script src="SweetAlert/bootstrap4/js/bootstrap.min.js"></script>

    <!--    Plugin sweet Alert 2  -->
	  <script src="plugins/sweetAlert2/sweetalert2.all.min.js"></script>


  <script>

      $("#btn1").click(function(){
        Swal.fire({
            title: 'MISSIOMME',
            text: "<?php echo $Lause; ?>"
        });
    });




  </script>
</script>
