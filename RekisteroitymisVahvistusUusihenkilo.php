<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Connect.php';

error_reporting(0);


//Haetaan vahvistusViesti
$Anro = $_SESSION['A_NRO'];
$e_nimi = $_SESSION['e_NIMI'];
$s_nimi = _SESSION['s_NIMI'];


?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Kirjaudu vaihe B</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>


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

.container > .row > .header > .container > .row > ul{
    text-align:right;
    margin-left:26em;
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
.container > .row > .header > .container > .row >.Logo a{
    text-decoration:none;
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
.vahvistusboksi{
    height:100%;
    width:80%;
    margin-left:6em;
    background-color: rgb(166,241,166,0.5);
    margin-bottom:1em;
    margin-top:1em;
}
.otsikko{
    text-align:center;
    font-size:25px;
    padding-top:10px;
    text-transform:uppercase;
    font-weight:bold;
    letter-spacing:0.2em;
}
.vahvistusboksi  p {
    padding-bottom:10px;
    margin-top:25px;
}
.vahvistusboksi h5{
    text-align:center;
    padding-bottom:10px;
}
.fa-check-circle{
    color:#28a745;
    font-size:8em;
    margin-top:10px;
  }
  i{
  width: 100px;
  position: relative;
  left: 48%;
  margin-left: -50px;
  top: 50%;
  margin-top: -50px;
  }

  .container-fluid .row
  {
    margin-top: 15px;
    font-size: 25px;
  }

  .container-fluid .row .data 
  {
    font-weight: bold;
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

<body>
<div class="container">
    <div class="row">
      <div class="col-xl body">
      <i class="fas fa-check-circle"></i>
      <h1 class="otsikko" style="font-size:35px;color:#28a745;">Onneksi Olkoon</h1><br>
        <div class="vahvistusboksi">

            <p>
            Uuden henkilöasiakkaan lisäys onnistui
            </p>
            <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3" ></div>
                <div class="col-sm-3" style="text-transform:uppercase;">Asiakasnumero:</div>
                <div class="col-sm-3 data" ><?php echo $Anro; ?></div>
                <div class="col-sm-3" ></div>
              </div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3" ></div>
                <div class="col-sm-3" style="text-transform:uppercase;">Nimi:</div>
                <div class="col-sm-3 data" ><?php echo $e_nimi." ".$s_nimi; ?></div>
                <div class="col-sm-3" ></div>
              </div>
            </div>


        <br>
        <h5 style="font-size:20px;" id="status" ></h5>
        </div>

      </div>
    </div>
  </div>
</body>
<script>

function countDown(secs,elem) {
	var element = document.getElementById(elem);
	element.innerHTML = "Sinut siirretään automaattisesti takaisin osotokoriin "+secs+" sekunnin kuluttua...";
	if(secs < 2) {
		clearTimeout(timer);
		window.location.href = "Ostoskori.php";
	}
	secs--;
	var timer = setTimeout('countDown('+secs+',"'+elem+'")',1500);
}

</script>
<script>countDown(5,"status");</script>
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
<?php

?>
