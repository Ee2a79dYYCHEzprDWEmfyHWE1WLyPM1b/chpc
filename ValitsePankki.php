<?php
session_start();
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/Connect.php';

require 'vendor/autoload.php';

error_reporting(0);

$sql_HaeLoppusumma = "SELECT Loppusumma from tbl_ostoskori where L_Ostaja = 'KYLLA'";
$result_sql_HaeLoppusumma = $conn->query($sql_HaeLoppusumma);

if ($result_sql_HaeLoppusumma->num_rows > 0) {

    while($row = $result_sql_HaeLoppusumma->fetch_assoc()) {
      $L_Summa =$row["Loppusumma"];
      
    }

}


$VeroEuroissa = $_SESSION['VeroOsuus'];
$Yksikköhinta = $_SESSION['Ahinta'];
$Kuittinumero = $_SESSION['Kuittinumero'];
//$A_kponkiNumero = $_SESSION['KUponki_numero'];

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

$Katsotaan_Onko_Kuponkia_Kaytetty = "SELECT Etukuponki FROM tbl_ostoskori WHERE KuittiNro = '$Kuittinumero' GROUP BY Etukuponki ";
$result_Katsotaan_Onko_Kuponkia_Kaytetty = $conn->query($Katsotaan_Onko_Kuponkia_Kaytetty);



$conn->close();
?>
<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Valitse pankkiyhteys </title>
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
                            <li><a href="#" data-toggle="modal" data-target="#myModal_2">Missio</a></li>
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
  
  width:300px;
  border-radius: 10px 10px 10px 10px;
  margin-left:3em;
  margin-top:2em;
}
.box:checked{
  border: 5px solid black;
}
.box:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  border: 1px solid black;
}
img{
  margin-left:15px;
  margin-top:15px;
  margin-bottom:15px;
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
        <p class="otsikko">Valitse pankkiyhteys</p>
        <div class="w3-panel w3-pale-yellow w3-border">
            <h3 style="font-weight:normal;">MAKSETTAVA SUMMA</h3>
            <h3 style="font-weight:bold;float:right;margin-top:-35px;"><?php echo $L_Summa; ?><i style="margin-left:5px;" class="fas fa-euro-sign"></i></h3>
        </div>
          <!-- TÄHÄN KOHTAAN TULEE PANKKI LOGOT -->
          <div class="kaikkiBoxit" style="display:flex;">
                <div class="box">
                  <a href="MaksunVahvistus.php"><img src="Media\aktia.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
                <div class="box">
                  <a href="handelsbanken.fi"><img src="Media\alandsbanken.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
                <div class="box">
                  <a href="https://danskebank.fi/sinulle"><img src="Media\danske-bank.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
          </div>
          <div class="kaikkiBoxit" style="display:flex;">
                <div class="box">
                  <a href="https://www.handelsbanken.fi/fi/"><img src="Media\handelsbanken.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
                <div class="box">
                  <a href="https://www.nordea.fi/"><img src="Media\nordea.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
                <div class="box">
                  <a href="https://www.omasp.fi/fi"><img src="Media\oma-saastopankki.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
          </div>
          <div class="kaikkiBoxit" style="display:flex;">
                <div class="box">
                  <a href="https://www.op.fi/etusivu"><img src="Media\osuuspankki.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
                <div class="box">
                  <a href="https://www.poppankki.fi/"><img src="Media\pop-pankki.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
                <div class="box">
                  <a href="https://www.s-pankki.fi/"><img src="Media\s-pankki.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
          </div>

          <div class="kaikkiBoxit" style="display:flex;">
                <div class="box">
                  
                </div>
                <div class="box">
                  <a href="https://www.op.fi/etusivu"><img src="Media\saastopankki.svg" alt="Girl in a jacket" style="width:250px;height:120px;"></a>
                </div>
                <div class="box">
                  
                </div>
          </div>


          <br>
            <div class="Painikkeet" style="display:flex;margin-bottom: 15px;">
            <a href="Ostoskori.php">
              <button type="button" class="btn btn-outline-warning" style="width:25em;margin-left:8em;color:black;text-transform: uppercase;font-weight: bold;">Takaisin ostoskoriin
              </button>
            </a>
            <a href="AsiakasprofiiliC.php">
              <button type="button" class="btn btn-outline-danger" style="margin-left:3em;width:25em;color:black;text-transform: uppercase;font-weight: bold;">peruuta
              </button>
            </a>
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
