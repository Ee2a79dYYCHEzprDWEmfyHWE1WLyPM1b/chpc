<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Connect.php';

error_reporting(0);


//Haetaan vahvistusViesti
$sql1="SELECT Lause from tbl_lauseet WHERE Lause_Tunnus = 'W-DB-19';";
$result_1=mysqli_query($conn,$sql1);
$resultCheck=mysqli_num_rows($result_1);
?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Kirjaudu vaihe B</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link rel="stylesheet" href="TyyliTiedostot/Responsive.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>


  <style>
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

  .vahvistusboksi h5{
    text-align:center;
    padding-bottom:10px;
}
.vahvistusboksi a
{
    text-decoration: none;
    color: black;
    font-weight: bold;
}
.vahvistusboksi a:hover
{
    text-decoration: underline;
}
.vahvistusboksi a h5
    {
       color: black;
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
        <p class="otsikko">Rekisteröityminen vaihe, B, etenee</p>
        <br>
                <div class="vahvistusboksi">
                    <p style="text-transform:none;font-size: 20px;padding: 5px;">
                    <?php
                            if($resultCheck > 0){
                                while($row =mysqli_fetch_assoc($result_1
                                )){
                                echo $row['Lause'];
                                }
                            }
                            ?>
                    </p>
                    <a href="KirjauduVaiheB.php"><h5>KIRJAUDU JÄRJESTELMÄÄN</h5></a>
                    <p style="text-transform:none;font-size: 20px;padding: 5px;">
                    HUOM! jos et löydä lähettämämme sähköpostia saapuneet kansiosta, tarkista roskapostikansio.
                    <br>
                    Mikäli et edelleenkään löydä, ota yhteys asiakaspalvelumme <a href="info@chpc.fi">info@chpc.fi</a> 
                    </p>
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
<div id="MissioBOX" style="display:none; margin-top:-35%;width:60%;margin-left:20%;">
                  <h3>Missiomme</h3>
                  <hr>
                      <p>
                      <?php
                              if($resultCheck > 0){
                                  while($row =mysqli_fetch_assoc($result_5)){
                                  echo $row['Lause'];
                                  }
                                }
                              ?>
                      </p>

                    <hr>
                    <h4 class="sulje_1">Sulje ikkuna</h4>
          </div>


</html>
<?php
?>
