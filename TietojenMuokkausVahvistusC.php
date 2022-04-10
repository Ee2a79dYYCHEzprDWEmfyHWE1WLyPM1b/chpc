<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Connect.php';
include_once 'PHP - Funktiot/Index_sql_query.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Tietojen muokkaus</title>
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
                    <?php
                    $sql_Muokattu = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-28'";
                    $result_Muokattu = $conn->query($sql_Muokattu);

                    if ($result_Muokattu->num_rows > 0) {
                        while($row = $result_Muokattu->fetch_assoc()) {
                          $Lause =$row["Lause"];
                          echo $Lause;
                        }

                    }
    
                    ?>
                    </p>
                    <style>

                    </style>

                        <div class="container" style="margin-left:1em;">
                            <div class="row">
                                <div class="col-sm-3" >ETUNIMI</div>
                                <div class="col-sm-3" style="font-weight:bold;margin-left:-50px;"><?php echo $_SESSION['Etunimi']; ?></div>
                                <div class="col-sm-2" >SUKUNIMI</div>
                                <div class="col-sm-4" style="font-weight:bold;padding-left:35px;"><?php echo $_SESSION['Sukunimi']; ?></div>
                            </div>
                            <div class="row" style="margin-top:1em;">
                                <div class="col-sm-3" >ASEMA YRITYKSESSÄ</div>
                                <div class="col-sm-3" style="font-weight:bold;margin-left:-50px;"><?php echo $_SESSION['asemaYrityksessa']; ?></div>
                                <div class="col-sm-2" >SÄHKÖPOSTIOSOITE</div>
                                <div class="col-sm-4" style="font-weight:bold;padding-left:35px;"><?php echo $_SESSION['Sposti']; ?></div>
                            </div>
                            <div class="row" style="margin-top:1em;">
                                <div class="col-sm-3" >PUHELINNUMERO</div>
                                <div class="col-sm-3" style="font-weight:bold;margin-left:-50px;"><?php echo $_SESSION['puhelinnumero']; ?></div>
                                <div class="col-sm-2" >OSOITE </div>
                                <div class="col-sm-4" style="font-weight:bold;padding-left:35px;"><?php echo $_SESSION['osoite']; ?></div>
                            </div>
                            <div class="row" style="margin-top:1em;">
                                <div class="col-sm-3" >POSTINUMERO</div>
                                <div class="col-sm-3" style="font-weight:bold;margin-left:-50px;"><?php echo $_SESSION['Postinumero']; ?></div>
                                <div class="col-sm-2" >POSTITOIMIPAIKKA </div>
                                <div class="col-sm-4" style="font-weight:bold;padding-left:35px;"><?php echo $_SESSION['Postitoimipaikka']; ?></div>
                            </div>
                            <div class="row" style="margin-top:1em;">
                                <div class="col-sm-3" >SALASANA</div>
                                <div class="col-sm-3" style="font-weight:bold;margin-left:-50px;"><?php echo $_SESSION['Salasana']; ?></div>
                                <div class="col-sm-2" ></div>
                                <div class="col-sm-4" ></div>
                            </div>
                        </div>
                    <?php session_destroy() ?>
                    <h5>
                   <h5 style="font-size:20px;" id="status" ></h5>
                </div>

      </div>
    </div>
  </div>
</body>
<script>

function countDown(secs,elem) {
	var element = document.getElementById(elem);
	element.innerHTML = "Sinut siirretään automaattisesti kirjautumissivulle "+secs+" sekunnin kuluttua...";
	if(secs < 2) {
		clearTimeout(timer);
		window.location.href = "AsiakasprofiiliC.php";
	}
	secs--;
	var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
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
//echo $_SESSION['asiakasnumero'];
?>
