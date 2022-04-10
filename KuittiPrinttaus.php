<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/Connect.php';
require 'Funktiot/Kuitti_LuoPDF_Etukuponki.php';
require 'Funktiot/Kuitti_LuoPDF_Laheta_Sposti.php';

$TamaPaiva = date("d.m.Y");
$Lisays_PVM = date('Y-m-d');
$TamaVuosi = date("Y");
$TamaKuukausi = date ("m");
error_reporting(0);

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
      $A_Hinta = $row["A_hinta"];

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
      $Lostaja_Sposti     =  $row["Sposti"];
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



//Hankitaan Etukuponki Tiedot
$Hankitaan_Etukuponki_Tiedot = "SELECT 
  tbl_asiakkaat.Asiakasnumero, 
  tbl_asiakkaat.Etunimi, 
  tbl_asiakkaat.Sukunimi, 
  tbl_etukupongit.KuponkiNumero, 
  tbl_etukupongit.Arvo, 
  tbl_etukupongit.LuotuPVM, 
  tbl_asiakas_etukupongit.LunastettuPVM 
    FROM tbl_asiakkaat 
   INNER JOIN tbl_kuitit ON tbl_asiakkaat.Asiakasnumero = tbl_kuitit.Asiakasnumero
   INNER JOIN tbl_asiakas_etukupongit ON tbl_asiakas_etukupongit.Asiakasnumero = tbl_asiakkaat.Asiakasnumero
   INNER JOIn tbl_etukupongit ON tbl_etukupongit.KuponkiNumero = tbl_asiakas_etukupongit.Kuponkinumero
   WHERE tbl_kuitit.Kuittinumero = '$Kuittinumero'";
$Hankitaan_Etukuponki_Tiedot_Tulos = $conn->query($Hankitaan_Etukuponki_Tiedot);  

if ($Hankitaan_Etukuponki_Tiedot_Tulos->num_rows > 0) {

    while($row = $Hankitaan_Etukuponki_Tiedot_Tulos->fetch_assoc()) {
      $Ekuponki_AsNro         =   $row["Asiakasnumero"];
      $Ekuponk_ENimi          =   $row["Etunimi"];
      $Ekuponk_SNimi          =   $row["Sukunimi"];
      $Ekuponk_Arvo           =   $row["Arvo"];
      $Ekuponk_Lunastettu     =   $row["LunastettuPVM"];
      $Ekuponk_Luotu          =   $row["LuotuPVM"];
      $Ekuponk_Kuponkinumero  =   $row["KuponkiNumero"];


      //Ekupogin LunastuPVM
      $Lunastetu_Muokkaus = $Ekuponk_Lunastettu;
      $Lunastetu_MuokkausTulostus = date("d.m.Y", strtotime($Lunastetu_Muokkaus));

      //Ekupogin LuomisPVM
      $Luotu_YMuokkaus = $Ekuponk_Luotu;
      $Luotu_YMuokkausTulostus = date("d.m.Y", strtotime($Luotu_YMuokkaus));

    }
} 



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
                    <p style="text-align:left;font-size:15px;text-transform:uppercase;">Arvoisa asiakas maksunne lukuoikeuksien hankkimisesta Tuottavuusklinikoiden sivuille onnistui. Kuitissa yrityksenne kirjanpitoa varten näette hankkimanne lukuoikeudet halutuille henkilöille. 
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
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $yrityksenOsoite;?></div>
                  </div>
                   <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Asiakaspalvelu</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $yrityksenINFO; ?></div>
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
                    if ($Hankitaan_Lukuoikeuden_KaikkiHaktijat_Tiedot_Tulos->num_rows > 0) {

                        while($row = $Hankitaan_Lukuoikeuden_KaikkiHaktijat_Tiedot_Tulos->fetch_assoc()) {
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
                
             

             


            <!-- AlennusKuponki Tiedot-->
              <div id="Etukuponki_OSUUS" >
                  <br><br>
                  <p class="kuittisisalto" style="text-align:left;margin-left:10px;font-size:25px;letter-spacing:2px;font-weight:bold;color:rgb(135,206,250,0.9);">Alennuskupongit</p>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Kuponkinumero</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Ekuponk_Kuponkinumero; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Arvo</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Ekuponk_Arvo." % -Alennus"; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Myönnetty</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Luotu_YMuokkausTulostus; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">Lunastettu</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Lunastetu_MuokkausTulostus; ?></div>
                  </div>
                  <div class="row" style="margin-top:5px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-6" style="text-transform:uppercase;">kohdehenkilö</div>
                      <div class="col-sm-6" style="font-weight:bold;text-transform:uppercase;"><?php echo $Ekuponk_ENimi." ".$Ekuponk_SNimi." ( ".$Ekuponki_AsNro." )"; ?></div>
                  </div>
              </div>
                              
                <?php 

                     if($Ekuponk_Arvo == '100')
                                {
                                    //Erotellaan ensin tuhanneosat
                                    $ErotaTuhannet_Yksikköhinta = $A_Hinta;
                                    $MuokattuTuhannet_Yksikköhinta = number_format($ErotaTuhannet_Yksikköhinta , 2, ',', ' ');

                                    //Lasketaan Alennuksen määrä euroissa
                                    $Alennus_Euroissa = $A_Hinta * $Ekuponk_Arvo / 100;

                                    // Vähenentään alennus Alkuperäisestä hinnasta
                                    $Hinta_alennnuksen_Jalkeen = $A_Hinta - $Alennus_Euroissa;
                                    $MuokattuTuhannet_Hinta_alennnuksen_Jalkeen = number_format($Hinta_alennnuksen_Jalkeen , 2, ',', ' ');

                                    $Veron_Maara_2 = $Vero_Prosentti * $Hinta_alennnuksen_Jalkeen;
                                    $Loppusumma_2 = $Veron_Maara_2;

                                    $ErotaTuhannet_Loppusumma_2 = $Loppusumma_2;
                                    $MuokattuTuhannet_Loppusumma_2 = number_format($ErotaTuhannet_Loppusumma_2 , 0, ' .', ' '); 

                                   
                                    
                                }
                            else
                                {
                                    //Erotellaan ensin tuhanneosat
                                    $ErotaTuhannet_Yksikköhinta = $A_Hinta;
                                    $MuokattuTuhannet_Yksikköhinta = number_format($ErotaTuhannet_Yksikköhinta , 2, ',', ' ');

                                    //Lasketaan Alennuksen määrä euroissa
                                    $Alennus_Euroissa = $A_Hinta * $Ekuponk_Arvo / 100;

                                    // Vähenentään alennus Alkuperäisestä hinnasta
                                    $Hinta_alennnuksen_Jalkeen = $A_Hinta - $Alennus_Euroissa;
                                    $MuokattuTuhannet_Hinta_alennnuksen_Jalkeen = number_format($Hinta_alennnuksen_Jalkeen , 2, ',', ' ');
                                    
                                    //Lasketaan veron määrä euroissa alennetusta hinnasta
                                    $Veron_Maara_2 = $Vero_Prosentti * $Hinta_alennnuksen_Jalkeen / 100;

                                    //Lasketaan lopullinen summa alv + alennus sekä erotellaan tuhannesosat

                                    $Loppusumma_2 = $Veron_Maara_2 + $Hinta_alennnuksen_Jalkeen;
                                    
                                    $ErotaTuhannet_Loppusumma_2 = $Loppusumma_2;
                                    $MuokattuTuhannet_Loppusumma_2 = number_format($ErotaTuhannet_Loppusumma_2 , 2, ',', ' ');
                                    
                                    
                                }

                ?>
                <!-- Hintaerittely, kun alekuponkia ei ole käytetty-->

                    <p class="otsikko" style="text-align:left;font-size:20px;margin-left:10px;font-weight:bold;letter-spacing:2px;margin-top:3em;margin-bottom:1em;color:rgb(135,206,250,0.9);">maksutiedot (ALV- eritelty)</p>
                
                <?php 
                  


                  //Suoritetaan laskutoiminpide
            
                  $_SESSION['KuponkiArvo'] = $Ekuponk_Arvo;          


                ?>
                <div id="Kylla_alekuponkia">
                    <div class="row" style="margin-bottom:-25px;margin-left:0px;margin-right:0px;">
                      <div class="col-sm-2" style="text-transform:none;">A-hinta (€)</div>
                      <div class="col-sm-2" style="text-transform:none;">Ale (%)</div>
                      <div class="col-sm-2" style="text-transform:none;">Ale (€)</div>
                      <div class="col-sm-2" style="text-transform:none;">Veroton (€)</div>
                      <div class="col-sm-1" style="text-transform:none;">Alv (%)</div>
                      <div class="col-sm-1" style="text-transform:none;">Alv (€)</div>
                      <div class="col-sm-2" style="text-transform:none;">Yhteensä (€)</div>
                    </div>
                    <hr style="border-top: 1px solid black;">
                      <div class="row" style="margin-top:20px;margin-left:0px;margin-right:0px;">
                        <div class="col-sm-2" style="text-transform:uppercase;"><?php echo $MuokattuTuhannet_Yksikköhinta; ?></div>
                        <div class="col-sm-2" style="text-transform:uppercase;"><?php echo $Ekuponk_Arvo;?></div>
                        <div class="col-sm-2" style="text-transform:uppercase;"><?php echo $Alennus_Euroissa;?></div>
                        <div class="col-sm-2" style="text-transform:uppercase;"><?php echo $MuokattuTuhannet_Hinta_alennnuksen_Jalkeen; ?></div>
                        <div class="col-sm-1" style="text-transform:uppercase;"><?php echo $Vero_Prosentti; ?></div>
                        <div class="col-sm-1" style="text-transform:uppercase;"><?php echo $Veron_Maara_2;?></div>
                        <div class="col-sm-2" style="text-transform:uppercase;padding-left: 4%;font-weight: bold;">
                          <?php echo $MuokattuTuhannet_Loppusumma_2;?> €</div>
                      </div>
                </div>
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

<script>

      $("#btn1").click(function(){
        Swal.fire({
            title: 'MISSIOMME',
            text: "<?php echo $Lause; ?>"
        });
    });

</script>
