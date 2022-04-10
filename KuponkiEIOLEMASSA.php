<?php session_start(); ?>
<?php 
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Connect.php';
error_reporting(0); 

$Asiakasnumero =  $_SESSION['Asiakasnumero_2'];
$ETKR = $_SESSION['ETKNRO'];



if(!isset($_SESSION['Asiakasnumero_2'])){
  echo "Olet Jo kirjautunut ulos";
  header('Location:Ostoskori.php');
}

?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Virhe</title>
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
    width:90%;
    margin-left:4em;
    background-color: rgba(255, 0, 0, 0.5);
    margin-bottom:1em;
    margin-top:1em;
    border-radius: 10px;
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
    padding-left:2.8px;
    padding-right:2.8px;
}

  .fa-exclamation-triangle{
    color:rgba(255, 0, 0, 0.5);
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

  .body > .painikkeet > a >.Muokkaa,.Muokkaa_2
      {
        height:50px;
        width:300px;
        text-align:center;
        margin-left:25em;
        text-transform:uppercase;
        letter-spacing:5px;
        font-weight:600;
        background-color:rgb(135,206,250,0);
        outline:none;
      }
  .painikkeet >  a > .Muokkaa,.Muokkaa_2:hover
      {
        background-color:rgb(135,206,250,0.5);
      }
    .text{
      background-color:#0275d8;
      opacity:1;
    }
    .text:hover{
      color:red;
      box-shadow:0 0 2px red, 0 0 2px red;
    }
    .painikkeet {
      display:flex;
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
                    </a>
                    </div>
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
      <i class="fas fa-exclamation-triangle"></i>
      <h1 class="otsikko" style="font-size:35px;color:rgba(255, 0, 0, 0.5);">virhe</h1><br>
                <div class="vahvistusboksi" >
                    <h1 style="text-align:center;padding-top:15px;font-weight:bolder;">ETUKUPONKINUMERO VIRHEELLINEN / EI OLEMASSA </h1><BR>
                    <HR>
                    <p>
                    Antamasi etukuponki numerolla <strong><?php echo $ETKR; ?></strong> ei ole olemassa tai se on syötetty virheellisesti
                    </p>
                    <h5 style="font-size:20px;" id="status" ></h5>
                </div>
                            
      </div>
    </div>  
  </div>
</body>
<script>
function countDown(secs,elem) {
	var element = document.getElementById(elem);
	element.innerHTML = "Sinut siirretään automaattisesti takaisin ostoskorin näkymään "+secs+" sekunnin kuluttua..."+
  "<br><br>"+"VOIT SEN JÄLKEEN KOKEILLA UUDESTAAN SYÖTTÄMÄLLÄ OLEMASSAOLEVAN ERUKUPONKINUMERON";
	if(secs < 2) {
		clearTimeout(timer);
		window.location.href = "Ostoskori.php";
	}
	secs--;
	var timer = setTimeout('countDown('+secs+',"'+elem+'")',2000);
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
