<?php
session_start();
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/Connect.php';
error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// Include autoload.php file
require 'vendor/autoload.php';
// Create object of PHPMailer class
$mail = new PHPMailer(true);

$output = '';

if(!isset($_SESSION['Kayttajatunnus'])){
    echo "Olet Jo kirjautunut ulos";
    header('Location:KirjauduVaiheC.php');
}



$KayttajaTunnus = $_SESSION['Kayttajatunnus'];
$HaeAsiakasTietoja = "SELECT tbl_asiakkaat.Asiakasnumero,tbl_asiakkaat.Etunimi,tbl_asiakkaat.Sukunimi,tbl_asiakkaat.Sposti,
    tbl_asiakkaat.Puhelin,tbl_asiakkaat.Titteli,tbl_asiakkaat.Y_tunnus,
    tbl_kayttajatunnus_c.Kayttajatunnus,tbl_kayttajatunnus_c.Salasana,
    tbl_yritykset.YrityksNimi,tbl_yritykset.Liiketoimintaryhma,
    tbl_yritykset.Liiketoimintayksikko,tbl_yritykset.Osoite,tbl_asiakkaat.LukuoikeusMyonnetty,
    tbl_yritykset.PostiNro,tbl_yritykset.PostiTmiPaikka,
    tbl_yritykset.Rakennusliike,tbl_asiakkaat.LukuoikeusOSTETTU
FROM tbl_asiakkaat
    INNER JOIN tbl_kayttajatunnus_c ON tbl_kayttajatunnus_c.Asiakasnumero = tbl_asiakkaat.Asiakasnumero
    INNER JOIN tbl_yritykset  ON tbl_asiakkaat.Y_tunnus = tbl_yritykset.Y_tunnus
WHERE tbl_kayttajatunnus_c.Kayttajatunnus = '$KayttajaTunnus'";

$Tulos = $conn->query($HaeAsiakasTietoja);
  if ($Tulos->num_rows > 0)
    {
      while($row = $Tulos->fetch_assoc())
          {
            $asiakasnumero = $row["Asiakasnumero"];
            $etunimi = $row["Etunimi"];
            $sukunimi =$row["Sukunimi"];
            $sposti = $row["Sposti"];
            $Puhelin = $row["Puhelin"];
            $Titteli = $row["Titteli"];
            $Y_tunnus = $row["Y_tunnus"];
            $LukuoikeusMyonnetty = $row["LukuoikeusMyonnetty"];
            $Kayttajatunnus = $row["Kayttajatunnus"];
            $Salasana = $row["Salasana"];
            $YrityksNimi = $row["YrityksNimi"];
            $Liiketoimintaryhma = $row["Liiketoimintaryhma"];
            $Liiketoimintayksikko = $row["Liiketoimintayksikko"];
            $Osoite = $row["Osoite"];
            $PostiNro = $row["PostiNro"];
            $PostiTmiPaikka = $row["PostiTmiPaikka"];
            $Rakennusliike = $row["Rakennusliike"];
            $LukuoikeusOstettu = $row["LukuoikeusOSTETTU"];
          }
    }
    $_SESSION['Asiakasnumero_2'] = $asiakasnumero;
    $_SESSION['Etunimi_2'] = $etunimi;
    $_SESSION['Sukunimi_2'] = $sukunimi;
    $_SESSION['Sposti_2'] = $sposti;
    $_SESSION['Titteli_2'] = $Titteli;
    $_SESSION['Puhelin_2'] = $Puhelin;
    $_SESSION['YrityksNimi_2'] = $YrityksNimi;
    $_SESSION['Y_tunnus_2'] = $Y_tunnus;
    $_SESSION['Liiketoimintaryhma_2'] = $Liiketoimintaryhma;
    $_SESSION['Liiketoimintayksikko_2'] = $Liiketoimintayksikko;
    $_SESSION['Osoite_2'] = $Osoite;
    $_SESSION['PostiNro_2'] = $PostiNro;
    $_SESSION['PostiTmiPaikka_2'] = $PostiTmiPaikka;
    $_SESSION['Kayttajatunnus_2'] = $sposti;
    $_SESSION['Salasana_2'] = $Salasana;


$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {
  while($row = $result_Missio->fetch_assoc()) {
    $Lause =$row["Lause"];
    }
}

$sql_DB_16 = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-16'";
$result_DB_16 = $conn->query($sql_DB_16);

if ($result_DB_16->num_rows > 0) {
  while($row = $result_DB_16->fetch_assoc()) {
    $DB_16 =$row["Lause"];
    }
}

$sql_DB_17 = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-17'";
$result_DB_17 = $conn->query($sql_DB_17);

if ($result_DB_17->num_rows > 0) {
  while($row = $result_DB_17->fetch_assoc()) {
    $DB_17 =$row["Lause"];
    }
}

$sql_DB_18 = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-18'";
$result_DB_18 = $conn->query($sql_DB_18);

if ($result_DB_18->num_rows > 0) {
  while($row = $result_DB_18->fetch_assoc()) {
    $DB_18 =$row["Lause"];
    }
}


$sql_DB_39 = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-39'";
$result_DB_39 = $conn->query($sql_DB_39);

if ($result_DB_39->num_rows > 0) {
  while($row = $result_DB_39->fetch_assoc()) {
    $DB_39 =$row["Lause"];
    }
}


if(isset($_POST['SiisrryOstokoriin']))
  {
    //TarkistaOnko Asiaks kertalleen lisätty
    $TarkistaKertaLisays = "SELECT count(Asiakasnumero) AS LKM FROM tbl_ostoskori WHERE Asiakasnumero = '$asiakasnumero'";
    $result_TarkistaKertaLisays = $conn->query($TarkistaKertaLisays);
      if ($result_TarkistaKertaLisays->num_rows > 0) 
        {
              while($row = $result_TarkistaKertaLisays->fetch_assoc()) 
              {
                  $Lisatty_EI =$row["LKM"];
                      if($Lisatty_EI > 0)
                          {
                                  
                          }
                      else
                          {
                            $ForeignKeyCheck ="SET FOREIGN_KEY_CHECKS=0";
                            $ForeignKeyCheckkysely = mysqli_query($conn, $ForeignKeyCheck) or die (mysqli_error($conn));
                            
                            if($ForeignKeyCheckkysely == 1)
                               {
                                  $Lisays_PVM = date('Y-m-d');
                                  $LisaaOSTOSKORIIN = "INSERT INTO tbl_Ostoskori (Asiakasnumero,Etunimi,Sukunimi,PVM)
                                            VALUES ('$asiakasnumero','$etunimi','$sukunimi','$Lisays_PVM')";
                                  $LisaaOSTOSKORIIN_kysely = mysqli_query($conn, $LisaaOSTOSKORIIN) or die (mysqli_error($conn));

                                  if($LisaaOSTOSKORIIN_kysely == 1)
                                    {
                                      $RadomAlkuluku = rand(9,99);
                                      $KuittiNro = date($RadomAlkuluku."dmY");
                                      $_SESSION['KUITTINUMERO'] = $KuittiNro;

                                      
                                      $Muokkaa_Kuittinumero = "UPDATE tbl_ostoskori SET KuittiNro='$KuittiNro' WHERE Asiakasnumero= '$asiakasnumero'";

                                      $Muokkaa_Kuittinumero_Tulos = $conn->query($Muokkaa_Kuittinumero);
                                      
                                        if($Muokkaa_Kuittinumero_Tulos == 1)
                                          {
                                            echo "<script>location='Ostoskori.php'</script>";
                                          }

                                    }
                                }  
                            }
              }
        }
  }


//Tarkistetaan onko asiakkaalla keskeytettyjä kuitteja
$TarkistaKeskeytettyKuitti = "SELECT KuittiNro,Kuitti_Tila,COUNT(KuittiNro) AS Kuitti_LKM 
  FROM tbl_ostoskori 
  WHERE Asiakasnumero = '$asiakasnumero'";
$result_TarkistaKeskeytettyKuitti = $conn->query($TarkistaKeskeytettyKuitti);

if ($result_TarkistaKeskeytettyKuitti->num_rows > 0)
      {
        while($row = $result_TarkistaKeskeytettyKuitti->fetch_assoc())
            {
                $KuittiTila = $row["Kuitti_Tila"];
                $KuittiNRO  = $row["KuittiNro"];      
            }
      }


if(isset($_POST['JatkaKUITTIA']))
  {
        $_SESSION['Lostaja_Anro'] = $asiakasnumero;
        $_SESSION['kekeytettyKUITTI'] = $KuittiNRO;  
        echo "<script>location='Ostoskori_JatkaKuittia.php'</script>";
  }
	
?>




<script type="text/javascript">
    
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    
</script>
<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- ASIAKASPROFIILI, C-vaihe</title>
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
       .container>.row > .body > .asiakasTiedot > div{
        text-align:left;
        height:40px;
        padding-top:5px;
        font-size:18px;
    }
    .container>.row > .body > .asiakasTiedot >.data{
        font-weight:bold;
        padding-left:5em;
        text-align:left;
    }

    .body > .Painikkeet >a button{
    height:50px;
    width:250px;
    text-align:center;
    margin-left:28em;
    text-transform:uppercase;
    letter-spacing:5px;
    font-weight:600;
    /*background-color:rgb(135,206,250,0.1);*/
    }
      .Painikkeet{
          display:flex;
      }

    .container > .row > .header > .container > .row > ul{
        text-align:right;
    margin-left:26em;
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

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.5); /* Black w/ opacity */

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
		
/*RESPONSIIVISUUS*/
	/*Jos näytön leveys on 600px tai pienempi*/
@media only screen and (max-width: 600px) 
{
		.container > .row > .header
	{
		height: 100%;
		width:100%;
	}
	
	.Some .Missio
	{
		display: none;
	}
		
	.Some .UK
	{
		display: none;
	}
		
	.Some .UTK
	{
		display: none;
	}
		
		.Some .OK
	{
		display: none;
	}
	
	.navbar .Logo
	{
		font-size: 1.5em;
		text-transform: uppercase;
		margin-top: 0.5em;
	}
	
	.navbar .fa-bars
	{
		display: block;
	}	
	
	.navbar .fa-bars
	{
		font-size: 27px;
		margin-top:10px;
		float:right;
		color:black;
	}	
	
	#mySidebar
	{
		height:100%;
		background-color: rgb(166,241,166,0.6);
		margin-top: 2.5px;
		width: 100%;
		display: none;
	}
	
	#mySidebar a.suljeIkoni
	{
		font-size: 35px;
		float: right;
		position: 	inherit;
		margin-right: 32px;
		color:black;                  
	}
		
	#mySidebar .Navigaatiopalkit .Missio
		{
				position: relative;
				left:20%;
				width:50%;
				border-radius: 0px;
				text-transform: uppercase;
		}
	#mySidebar .Navigaatiopalkit .UTK
		{
				position: relative;
				width:50%;
				left:20%;
				border-radius: 0px;
				margin-top:2%;
				text-transform: uppercase;
		}
	#mySidebar .Navigaatiopalkit .UK
		{
				position: relative;
				width:50%;
				left:20%;
				border-radius: 0px;
				margin-top:2%;
				text-transform: uppercase;
		}
	#mySidebar .Navigaatiopalkit .OK
		{
				position: relative;
				width:50%;
				left:20%;
				border-radius: 0px;
				margin-top:2%;
				text-transform: uppercase;
		}
	
	h6
		{
				display: none;
		}
	.body > .Painikkeet >a button
		{
				display: block;
		}
	.body > .Painikkeet >a .MKT
		{
				width:5% !important;
				position: relative !important;
		}
	.body > .Painikkeet >a .KU
		{
				position: relative !important;
				top:60px !important;
				right: 100% !important;
		}
	.body > .Painikkeet >a .VaiheB
		{
				position: relative;
				top:7.5em;
				right: 44em;
		}
		
	.body > .Painikkeet >a .sirryC
		{
				position: relative !important;
				top:6.7em !important;
				max-width:36% !important;
				height: 55px !important;
				
		}
		
	.container > .row > .body
		{
				height:100%;
				min-height: 100em!important;
		}
		.body .asiakasTiedot .otsikko
		{
				margin-left: 1em;
				margin-top: 15px;
		}
		
		.body .asiakasTiedot .data
		{
				margin-left: 1em;
				margin-top: -10px;
			text-align: center;
		}
		
		.container > .row > .footer
	{
		height: 100%;
	}
		
		#RespoIlmoitus
		{
				display: block;
				text-align: center;
				color: red;
				text-transform: uppercase;
		}
	.body .asiakasTiedot .LukuoikeusTEksti
		{
			position: relative;
			left:5em;
		}
		
		
}
	
	
	
	

/*Jos näytön leveys on 980px tai pienempi*/
@media only screen and (max-width: 900px) and (min-width:600px)
{
			.container > .row > .header
	{
		height: 100%;
		width:100%;
	}
	
	.Some .Missio
	{
		display: none;
	}
		
	.Some .UK
	{
		display: none;
	}
		
	.Some .UTK
	{
		display: none;
	}
		
		.Some .OK
	{
		display: none;
	}
	
	.navbar .Logo
	{
		font-size: 1.5em;
		text-transform: uppercase;
		margin-top: 0.5em;
	}
	
	.navbar .fa-bars
	{
		display: block;
	}	
	
	.navbar .fa-bars
	{
		font-size: 27px;
		margin-top:10px;
		float:right;
		color:black;
	}	
	
	#mySidebar
	{
		height:100%;
		background-color: rgb(166,241,166,0.6);
		margin-top: 2.5px;
		width: 100%;
		display: block;
	}
	
	#mySidebar a.suljeIkoni
	{
		font-size: 35px;
		float: right;
		position: 	inherit;
		margin-right: 32px;
		color:black;                  
	}
		
			
	#mySidebar .Navigaatiopalkit .Missio
		{
				position: relative;
				left:20%;
				width:50%;
				border-radius: 0px;
				text-transform: uppercase;
		}
	#mySidebar .Navigaatiopalkit .UTK
		{
				position: relative;
				width:50%;
				left:20%;
				border-radius: 0px;
				margin-top:2%;
				text-transform: uppercase;
		}
	#mySidebar .Navigaatiopalkit .UK
		{
				position: relative;
				width:50%;
				left:20%;
				border-radius: 0px;
				margin-top:2%;
				text-transform: uppercase;
		}
	#mySidebar .Navigaatiopalkit .OK
		{
				position: relative;
				width:50%;
				left:20%;
				border-radius: 0px;
				margin-top:2%;
				text-transform: uppercase;
		}
	
	h6
		{
				display: none;
		}
		
	.body > .Painikkeet >a button
		{
				display: block;
		}
	.body > .Painikkeet >a .MKT
		{
				width:18em !important;
				position: relative;
		}
	.body > .Painikkeet >a .KU
		{
				width:16em !important;
			  position: relative;
		}
	.body > .Painikkeet >a .VaiheB
		{
				position: relative;
				top:7.5em;
				right: 44em;
		}
		
	.body > .Painikkeet >a .SIIRRYC
		{
				width:41em !important;
			 position: relative;
		}
	.body > .Painikkeet >a .OSTALUKUOIKEUS
	{
			 width:41em !important;
			 position: relative;
		
	}
	.container > .row > .body
		{
				height:100%;
				min-height: 60em;
		}
		.body .asiakasTiedot .otsikko
		{
				margin-left: 1.5em;
				margin-top: 15px;
		}
		
		.body .asiakasTiedot .data
		{
				margin-left: 2em;
				margin-top: 10px;
				width:100%;
		}
		
		.container > .row > .footer
	{
		height: 100%;
	}
		
		#RespoIlmoitus
		{
				display: block;
				text-align: center;
				color: red;
				text-transform: uppercase;
		}
		.body .asiakasTiedot .MV
		{
				top: 28em;
				position: absolute;
				left:1.2em;
		}
		
		.body .asiakasTiedot .MVD
		{
				top: 28em;
				position: absolute;
				left:9em;
		}
}
	
	

	
/*Jos näytön leveys on 768px tai suurempi*/
@media only screen and (min-width: 950px) 
{
	#RespoIlmoitus
	{
		display: none;
	}
	
	#mySidebar
	{
		display: none;
	}
	
	.navbar .Logo
	{
		font-size: 1.5em;
		text-transform: uppercase;
		margin-top: 0.5em;
	}
	.Some
	{
		text-align: right;
		margin-top:10px;
	}
	
	.Some a
	{
		text-decoration: none;
		
	}
	
	.navbar .fa-bars
	{
		display: none;
	}	
	
	.navbar .fa-bars
	{
		font-size: 27px;
		margin-top:4px;
		float:right;
		color:black;
	}	
	
	.navbar .Missio, .UK,.UTK,.OK
	{
		display: inline-block;
		text-transform: uppercase;
	}
	
	.Some .Missio,.UK,.UTK,.OK
	{
		border-radius: 0px;
	}
	.Some .Missio:hover,.UK:hover,.UTK:hover,.OK:hover
	{
		font-weight: bold;
	}
	
}

.alert-warning
  {
    border-radius:0px 0px;
    opacity: 1;
  }
  </style>


<div class="container">
	<div class="row">
    	<div class="container">
    		<div class="row">
      			<div class="col-xl header">
        			<div class="row navbar">
						<div class="col Logo"><span style="color:RGB(244,160,0)";>Tuottavuus</span><span style="color:RGB(15,157,80)">klinikat</span></div>
						<div class="col Some">
							<a href="#">
								<button type="button" class="btn btn-outline-dark Missio" id="avaa">Missio</button>
							</a>
							<a href="Uutiskirjeet.php">
								<button type="button" class="btn btn-outline-dark UK">Uutiskirjeet</button>
							</a>
							<a href="uutiskirjetilaus.php">
								<button type="button" class="btn btn-outline-dark UTK">Uutiskirjeen tilaus</button>
							</a>
							<a href="#">
								<i class="fas fa-bars" onclick="w3_open()"></i>
							</a>
						</div>
  					</div>
      			</div>
				<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" id="mySidebar" style="display:none;">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button suljeIkoni">x</a>
	<div class="Navigaatiopalkit">
		<br><br>
				<a href="#">
						<button type="button" class="btn btn-outline-dark Missio" id="avaa">Missio</button>
				</a>
				<a href="uutiskirjetilaus.php">
						<button type="button" class="btn btn-outline-dark UTK">Uutiskirjeen tilaus</button>
				</a>
				<a href="Uutiskirjeet.php">
						<button type="button" class="btn btn-outline-dark UK">Uutiskirjeet</button>
				</a>
		</div>
				<br>
</nav>
    		</div>
  		</div>
    </div>
</div>
<script>
//Pävitetään sivu jo 15.minuutin välein
window.setTimeout(function () {
  window.location.reload();
}, 900000);
</script>

</head>


<body>
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
        <p class="otsikko">ASIAKASPROFIILI, C-vaihe</p>
<h6 id="RespoIlmoitus">Arvoisa asiakkaamme! taataksemme parhaan käyttökokemuksen, pyydämme teitä ystävällisesti käyttämään tablet- tai tietokone laitetta</h6>	
                <br>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Asiakasnumero:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" >&nbsp;<?php echo $asiakasnumero; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Nimi:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:2rem;"><?php echo $etunimi." ".$sukunimi; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Asema yritykessä:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" >&nbsp;<?php echo $Titteli; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Sähköpostiosoite:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:2rem;"><?php echo $sposti; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Puhelinnumero:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" >&nbsp;<?php echo $Puhelin; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Yrityksen nimi:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:2rem;"><?php echo $YrityksNimi; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Y-tunnus:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" >&nbsp;<?php echo $Y_tunnus; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Liiketoimintaryhmä:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:2rem;"><?php echo $Liiketoimintaryhma; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Liiketoimintayksikkö:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" >&nbsp;<?php echo $Liiketoimintayksikko; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Osoite:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:2rem;"><?php echo $Osoite.", ".$PostiNro." ".$PostiTmiPaikka; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 otsikko">Onko yritys rakennusliike?</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-1 data" style="padding-left:0px;">
                    <?php 
                    if($Rakennusliike = 'KYLLA')
                        {
                            echo "KYLLÄ";
                        }
                        
                    
                    ?>
                </div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Käyttäjätunnus:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" ><?php echo $Kayttajatunnus; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Salasana:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 data SalsanaDATA" style="padding-left:2rem;"><?php echo $Salasana; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 data NaytaSalasanPainike" id="NaytaSS" style="padding-left:1rem;text-align: left;cursor: pointer;text-transform: uppercase;color:blue;">&nbsp;Näytä salasana</div>

                <script>
				$(document).ready(function(){
				   $(".SalsanaDATA").hide();
				  $("#NaytaSS").click(function(){
				    $(".SalsanaDATA").show();
				    $(".NaytaSalasanPainike").hide();
				  });
				});
			</script>
            </div>
            <br><br>
            <hr>
            <br>

            <?php
                $HaeMuutosLokeja = "SELECT  tbl_kirjautumiset_c.Paivays,tbl_kayttajatunnus_c.LisattyKayttajatunnus_c,
                                            tbl_asiakkaat.MuokattuAsiakas, tbl_kayttajatunnus_c.MuokattuKayttajatunnus_c,
                                            tbl_yritykset.MuokattuYritys
                                    FROM tbl_asiakkaat
                                            INNER JOIN tbl_kayttajatunnus_c ON tbl_kayttajatunnus_c.Asiakasnumero = tbl_asiakkaat.Asiakasnumero
                                            INNER JOIN tbl_kirjautumiset_c ON tbl_kayttajatunnus_c.Kayttajatunnus_ID = tbl_kirjautumiset_c.Kayttajatunnus_ID
                                            INNER JOIN tbl_yritykset ON tbl_asiakkaat.Y_tunnus = tbl_yritykset.Y_tunnus
                                    WHERE tbl_asiakkaat.Asiakasnumero = '$asiakasnumero' ORDER BY tbl_kirjautumiset_c.Paivays DESC LIMIT 1 ";

                $HaeMuutosLokejaTulos = $conn->query($HaeMuutosLokeja);
                if ($HaeMuutosLokejaTulos->num_rows > 0)
                  {
                    while($row = $HaeMuutosLokejaTulos->fetch_assoc())
                        {
                          $ViimeksiKirjautunut = $row["Paivays"];
                          $Rekisteroitynyt = $row["LisattyKayttajatunnus_c"];
                          $AsiakasTiedotMuokattu = $row["MuokattuAsiakas"];
                          $KayttajatunnusTiedotMuokattu = $row["MuokattuKayttajatunnus_c"];
                          $YritysTiedotMuokattu = $row["MuokattuYritys"];

                        }
                  }
                //ViimeksiKirjautunut muokkausPVM
                $AikaleimaViimeksiKirjautunut = $ViimeksiKirjautunut;
                $ViimeksiKirjautunutTulostus = date("d.m.Y", strtotime($AikaleimaViimeksiKirjautunut));

                //Rekisteröitynyt muokkausPVM
                $Rekisteröitynyt = $Rekisteroitynyt;
                $RekisteröitynytTulostus = date("d.m.Y", strtotime($Rekisteröitynyt));

                //Asiakastietojen muokkaus
                $AsiakasTietojenMuokkaus = "$AsiakasTiedotMuokattu";
                $AsiakasTietojenMuokkausTulostus = date("d.m.Y", strtotime($AsiakasTietojenMuokkaus));

                //Asiakastietojen muokkaus
                $KäyttäjätunnustietojenMuokkaus = "$KayttajatunnusTiedotMuokattu";
                $KäyttäjätunnustietojenMuokkausTulostus = date("d.m.Y", strtotime($KäyttäjätunnustietojenMuokkaus));

                //Asiakastietojen muokkaus
                $YritystietojenMuokkaus = "$YritysTiedotMuokattu";
                $YritystietojenMuokkausTulostus = date("d.m.Y", strtotime($YritystietojenMuokkaus));

            ?>

            <p class="otsikko">MUUTOSLOKIT</p>
            <div class="row asiakasTiedot" >
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-8 otsikko" >Viimeksi kirjautunut: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:30px;"><?php echo $ViimeksiKirjautunutTulostus; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-8 otsikko">Rekisteröitynyt: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:30px;"><?php echo $RekisteröitynytTulostus; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-8 otsikko" >Asiakastietoja muokattu viimeksi: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:30px;">
                        <?php
                                $AsiakasTietojaEiMuokattu ="Asiakastietoja ei ole vielä muokattu";

                                if ($AsiakasTietojenMuokkaus == NULL){
                                  echo $AsiakasTietojaEiMuokattu;
                                }else{
                                  echo $AsiakasTietojenMuokkausTulostus;
                                }
                        ?>
                </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-8 otsikko" >Käyttäjätunnustietoja muokattu viimeksi: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:30px;">
                    <?php
                        $KayttajatunnusTietojaEiMuokattu ="Käyttäjätunnusta ei ole vielä muokattu";

                          if ($KäyttäjätunnustietojenMuokkaus == NULL){
                                echo $KayttajatunnusTietojaEiMuokattu;
                          }else{
                                echo $KäyttäjätunnustietojenMuokkausTulostus;
                            }
                    ?>
                </div>

                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-8 otsikko" >Yritystietoja muokattu viimeksi: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data" style="padding-left:30px;">
                    <?php
                        $YritysTietojaEiMuokattu = "Yritystietoja ei ole vielä muokattu";

                          if ($YritystietojenMuokkaus == NULL){
                                echo $YritysTietojaEiMuokattu;
                          }else{
                                 echo  $YritystietojenMuokkausTulostus;
                            }
                    ?>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 otsikko">Lukuoikeus Myönnetty:</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-1 data LukuoikeusTEksti" style="margin-left:-5.5em;">
									<?php
										$KYlla = "KYLLÄ";
										$EI = "EI";
										if($LukuoikeusMyonnetty == 'KYLLA')
												{
													echo $KYlla;
													echo "<style>";
													echo ".LukuoikeusTEksti{color:green;}";
													echo "</style>";
												}else{
													echo $EI;
													echo "<style>";
													echo ".LukuoikeusTEksti{color:red;}";
													echo "</style>";
												}

                  ?>
							</div>
                   
				<div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" >
          <form method="POST">
              <?php 
                if($KuittiTila == 'Keskeytetty')
                    {
              ?>
              <button type="submit" name="JatkaKUITTIA" class="Muokkaa VaiheB btn btn-outline-success OSTALUKUOIKEUS" style="font-weight:bold;text-transform: uppercase;font-size:17px;margin-top:-10px;width:43.3em;">Jatka ostotapahtuma<i class="fas fa-shopping-basket" style="margin-left:15px;font-size:17px;"></i>
				        </button>
              <?php
                  }
                else 
                {
              ?>
              <button type="submit" name="SiisrryOstokoriin" class="Muokkaa VaiheB btn btn-outline-success OSTALUKUOIKEUS" style="font-weight:bold;text-transform: uppercase;font-size:17px;margin-top:-10px;width:43.3em;">Osta lukuoikeus<i class="fas fa-shopping-basket" style="margin-left:15px;font-size:17px;"></i>
				        </button>
              <?php
                }
              
              ?>




            
          </form>
				</div>
        

        <div class="col-sm-3 col-md-6 col-lg-4 col-xl-12 otsikko">
            <div class="alert alert-warning PIILOTAVIESTI">
               <?php echo $DB_39;?>
            </div>
        </div>
            </div>
            <br class="tilat">
            <br class="tilat">
            <hr>
            <br >
            <div class="Painikkeet">
              <a href="MuokkaaTietojaC.php" >
					<button class="Muokkaa MuokkaaB btn btn-outline-primary MKT" style="width:30em;margin-left:-0.1em;">Muokkaa tietoja <i class="fas fa-user-edit" style="margin-left:15px;"></i></button></a>
							
              <a href="KirjauduUlos_C.php" ><button class="Muokkaa MuokkaaB btn btn-outline-danger KU" style="width:32em;margin-left:7em;">Kirjaudu ULOS <i class="fas fa-sign-out-alt" style="margin-left:25px;font-size:17px;"></i></button></a>
            </div>
            <br>
            <div class="Painikkeet VaiheC">
              <a href="VaiheC.php" style="text-decoration:none;"><button  name="sirryC" class="Muokkaa MuokkaaB btn btn-outline-secondary SIIRRYC" style="width:69em;margin-left:0.01em;">LUE C-VAIHE<i class="fab fa-readme" style="margin-left:15px;font-size:17px;"></i></button></a>
            </div>
            <?php
                if ($LukuoikeusMyonnetty == 'KYLLA' )
                    {
                      echo "<style>";
                      echo ".OSTALUKUOIKEUS{display:block;}";
                      echo ".PIILOTAVIESTI,.tilat{display:block;}";
                      echo "</style>";
                    }else{
                      echo "<style>";
                      echo ".OSTALUKUOIKEUS{display:none;}";
                      echo ".PIILOTAVIESTI,.tilat{display:none;}";
                      echo "</style>";
                    }

                    

            ?>

            <br>
            <hr class="LUKUOIKEUDET">
            <br class="LUKUOIKEUDET">
            <p class="otsikko LUKUOIKEUDET">LUKUOIKEUDET</p>


            <H6 class="LUKUOIKEUDET AKTIIVINEN" style="text-align:center;margin-top:10px;">AKTIIVINEN</H6>
            <?php

               $HaeAktiivisiaLukuoikeuksia = "SELECT Alkaa,Paattyy,Tila FROM tbl_lukuoikeudet WHERE Asiakasnumero = '$asiakasnumero'";
               $HaeAktiivisiaLukuoikeuksiaKyselyTulos = $conn->query($HaeAktiivisiaLukuoikeuksia);

               //Lukuoikeuden Aloitus
               if ($HaeAktiivisiaLukuoikeuksiaKyselyTulos->num_rows > 0) {
                   while($row = $HaeAktiivisiaLukuoikeuksiaKyselyTulos->fetch_assoc()) {
                     $LukuoikeusAktiivinenAlkaa = $row['Alkaa'];
                     $LukuoikeusAktiivinenAlkaaMuokattu = date("d.m.Y", strtotime($LukuoikeusAktiivinenAlkaa));

                     //Lukuoikeuden Päättyminen
                     $LukuoikeusAktiivinenPaattyy = $row['Paattyy'];
                     $LukuoikeusAktiivinenPaattyyMuokattu = date("d.m.Y", strtotime($LukuoikeusAktiivinenPaattyy));

                     $Tila = $row['Tila'];
                             if ($Tila == 'Voimassa')
                               {
                                 echo "<div class='row asiakasTiedot LUKUOIKEUDET' style='display:flex; margin-left:2.5em;'>";
                                 echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko LUKUOIKEUDET'>Alkanut:</div>";
                                 echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-4 data LUKUOIKEUDET'>";
                                 echo  $LukuoikeusAktiivinenAlkaaMuokattu;
                                 echo "</div>";
                                 echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko LUKUOIKEUDET'>Päättyy:</div>";
                                 echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-4 data LUKUOIKEUDET paattyy'>";
                                 echo  $LukuoikeusAktiivinenPaattyyMuokattu;
                                 echo "</div>";
                                 echo "</div>";
                               }
                   }

               } else {

             }

             $HaeAktiivisiaLukuoikeuksia_2 = "SELECT Paattyy FROM tbl_lukuoikeudet WHERE Asiakasnumero = '$asiakasnumero' and Tila='Voimassa'";
             $HaeAktiivisiaLukuoikeuksia_2KyselyTulos = $conn->query($HaeAktiivisiaLukuoikeuksia_2);
             if ($HaeAktiivisiaLukuoikeuksia_2KyselyTulos->num_rows > 0){
                  while($row = $HaeAktiivisiaLukuoikeuksia_2KyselyTulos->fetch_assoc()) {
                    $EraantymisPAIVA = $row['Paattyy'];
                  }
             }

              //Lukuoikeuden Päättyminen
              $MUOKKAAERAANTYMISPAIVA = $EraantymisPAIVA;
              $MUOKKAAERAANTYMISPAIVAMuokattu = date("d.m.Y", strtotime($MUOKKAAERAANTYMISPAIVA));
              $pvm = Date("d.m.y");
              $TamaPaiva = strtotime("$pvm");
              $EraantyPiva = strtotime("$MUOKKAAERAANTYMISPAIVAMuokattu");
              $Erotuksenlasku = abs($EraantyPiva - $TamaPaiva);
              $numeropäivät = $Erotuksenlasku/86400;
              $numeropäivät = intval($numeropäivät);


            /*
              $SpostiLähetysAika = ('09:00');
              $SpostiLähetysPaattyAika = ('18:00');
            */
                  if($numeropäivät == 0)
                  {

                    $Muokkaa2 = "UPDATE tbl_lukuoikeudet SET Tila='EiVoimassa' WHERE Paattyy = '$EraantymisPAIVA' AND Tila='Voimassa'";
                    $KyselyMuokkaa2 = mysqli_query($conn, $Muokkaa2) or die (mysqli_error($conn));
                        if($KyselyMuokkaa2 == 1)
                            {
                              $Muokkaa3 = "UPDATE tbl_asiakkaat SET LukuoikeusOSTETTU='EI' WHERE Asiakasnumero  = '$asiakasnumero'";
                              $KyselyMuokkaa3 = mysqli_query($conn, $Muokkaa3) or die (mysqli_error($conn));
                                if($KyselyMuokkaa3 == 1)
                                    {
                                        
	                                     try
	                                          {

	                                          	date_default_timezone_set('Etc/UTC');
                                              $mail = new PHPMailer();
                                              $mail->IsSMTP();
                                              $mail->CharSet = 'UTF-8';
                                              $mail->Host = 'mail.chpc.fi';               // SMTP server example
                                              $mail->SMTPDebug  = 0;                      // enables SMTP debug information (for testing)
                                              $mail->SMTPAuth   = true;                   // enable SMTP authentication
                                              $mail->Port       = 465; 
                                              $mail->SMTPSecure = 'ssl';                     // set the SMTP port for the GMAIL server
                                              $mail->Username   = 'system@chpc.fi';             
                                              $mail->Password   = 'K_?eEdX=yW5Y'; 
	                                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	                                            $mail->Port = 587;
	                                            $header ="TUOTTAVUUSKLINIKAT";
	                                            $header .="MIME-Version: 1.0\n\n";
	                                            $header .="Content-type text/html; charset=utf-8";

	                                            // Email ID from which you want to send the email
	                                            $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
	                                            // Recipient Email ID where you want to receive emails
	                                            $mail->addAddress($sposti);

	                                            $mail->Subject = 'TUOTTAVUUSKLINIKAT - MUISTUTUS';
	                                            $mail->Body = "
	                                                        <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
	                                                        <div style='width:50%;background-color:#A6F1A6;height:50px;padding-left:0.5em;'>
	                                                        <h1 style='padding-top:0.2em;'><span style='color:#F4A000;'>TUOTTAVUUS</span><span style='color:#0F9D58;'>KLINIKAT</span></h1>
	                                                        </div>
	                                                        <div style='width:50%;background-color:#87CEFA;height:150px;padding-left:0.5em;'>
	                                                        <h3 style='padding-left:0.5em;padding-top:1em;'>$DB_18 </h3>
	                                                        </div>
	                                              ";
	                                            $mail->isHTML(true);
	                                            $mail->send();
	                                            
	                                      }catch (Exception $e)
	                                      {
	                                          $output = '<div class="alert alert-danger">
	                                                    <h5>' . $e->getMessage() . '</h5>
	                                                    </div>';
	                                      }     
                                    }
                            }
                  }else if($numeropäivät == 8)
                  {
                            try {
                                  date_default_timezone_set('Etc/UTC');
                                  $mail = new PHPMailer();
                                  $mail->IsSMTP();
                                  $mail->CharSet = 'UTF-8';
                                  $mail->Host = 'mail.chpc.fi';               // SMTP server example
                                  $mail->SMTPDebug  = 0;                      // enables SMTP debug information (for testing)
                                  $mail->SMTPAuth   = true;                   // enable SMTP authentication
                                  $mail->Port       = 465; 
                                  $mail->SMTPSecure = 'ssl';                     // set the SMTP port for the GMAIL server
                                  $mail->Username   = 'system@chpc.fi';             
                                  $mail->Password   = 'K_?eEdX=yW5Y'; 
                                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                  $mail->Port = 587;
                                  $header ="TUOTTAVUUSKLINIKAT";
                                  $header .="MIME-Version: 1.0\n\n";
                                  $header .="Content-type text/html; charset=utf-8";

                                  // Email ID from which you want to send the email
                                  $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
                                  // Recipient Email ID where you want to receive emails
                                  $mail->addAddress($sposti);

                                  $mail->Subject = 'TUOTTAVUUSKLINIKAT - MUISTUTUS';
                                  $mail->Body = "
                                      <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
                                      <div style='width:50%;background-color:#A6F1A6;height:50px;padding-left:0.5em;'>
                                        <h1 style='padding-top:0.2em;'><span style='color:#F4A000;'>TUOTTAVUUS</span><span style='color:#0F9D58;'>KLINIKAT</span></h1>
                                      </div>
                                      <div style='width:50%;background-color:#87CEFA;height:150px;padding-left:0.5em;'>
                                          <h3 style='padding-left:0.5em;padding-top:1em;'>$DB_17 </h3>
                                      </div>
                                          ";
                                  $mail->isHTML(true);
                                  $mail->send();
                                  
                              } catch (Exception $e) {
                                  $output = '<div class="alert alert-danger">
                                          <h5>' . $e->getMessage() . '</h5>
                                        </div>';
                              }
                          }

                  else if ($numeropäivät == 30)
                  {
                        try {
                          date_default_timezone_set('Etc/UTC');
                          $mail = new PHPMailer();
                          $mail->IsSMTP();
                          $mail->CharSet = 'UTF-8';
                          $mail->Host = 'mail.chpc.fi';               // SMTP server example
                          $mail->SMTPDebug  = 0;                      // enables SMTP debug information (for testing)
                          $mail->SMTPAuth   = true;                   // enable SMTP authentication
                          $mail->Port       = 465; 
                          $mail->SMTPSecure = 'ssl';                     // set the SMTP port for the GMAIL server
                          $mail->Username   = 'system@chpc.fi';             
                          $mail->Password   = 'K_?eEdX=yW5Y'; 
                          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                          $mail->Port = 587;
                          $header ="TUOTTAVUUSKLINIKAT";
                          $header .="MIME-Version: 1.0\n\n";
                          $header .="Content-type text/html; charset=utf-8";

                          // Email ID from which you want to send the email
                          $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
                          // Recipient Email ID where you want to receive emails
                          $mail->addAddress($sposti);

                          $mail->Subject = 'TUOTTAVUUSKLINIKAT - MUISTUTUS';
                          $mail->Body = "
                              <meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />
                              <div style='width:50%;background-color:#A6F1A6;height:50px;padding-left:0.5em;'>
                                <h1 style='padding-top:0.2em;'><span style='color:#F4A000;'>TUOTTAVUUS</span><span style='color:#0F9D58;'>KLINIKAT</span></h1>
                              </div>
                              <div style='width:50%;background-color:#87CEFA;height:150px;padding-left:0.5em;'>
                                  <h3 style='padding-left:0.5em;padding-top:1em;'>$DB_16 </h3>
                              </div>
                                  ";
                          $mail->isHTML(true);
                          $mail->send();
                          
                        } catch (Exception $e) {
                          $output = '<div class="alert alert-danger">
                                      <h5>' . $e->getMessage() . '</h5>
                                    </div>';
                        }
                    }
                    else
                    {

                  }

                    if($numeropäivät < 8){
                      echo "<style>";
                      echo ".paattyy{color:red};";
                      echo "</style>";
                    }

                    if($numeropäivät > 8 && $numeropäivät < 30 || $numeropäivät == 30 ){
                      echo "<style>";
                      echo ".paattyy{color:orange};";
                      echo "</style>";
                    }
              ?>
            <H6 class="LUKUOIKEUDET" style="text-align:center;margin-top:10px;">ERÄÄNTYNEET</H6>
           <?php

            $HaeEraantyneitaLukuoikeuksia = "SELECT Alkaa,Paattyy,Tila FROM tbl_lukuoikeudet WHERE Asiakasnumero = '$asiakasnumero' ORDER BY Paattyy DESC";
            $HaeEraantyneitaLukuoikeuksiaKyselyTulos = $conn->query($HaeEraantyneitaLukuoikeuksia);

            //Lukuoikeuden Aloitus
            if ($HaeEraantyneitaLukuoikeuksiaKyselyTulos->num_rows > 0) {
                while($row = $HaeEraantyneitaLukuoikeuksiaKyselyTulos->fetch_assoc()) {
                  $EraantyLukuoikeusAlkaa = $row['Alkaa'];
                  $EraantyLukuoikeusAlkaaMuokattu = date("d.m.Y", strtotime($EraantyLukuoikeusAlkaa));

                  //Lukuoikeuden Päättyminen
                  $EraantyLukuoikeusPaattyy = $row['Paattyy'];
                  $EraantyLukuoikeusPaattyyMuokattu = date("d.m.Y", strtotime($EraantyLukuoikeusPaattyy));

                  $Tila = $row['Tila'];
                          if ($Tila == 'EiVoimassa')
                            {
                              echo "<div class='row asiakasTiedot'> </div>";
                              echo "<div class='row asiakasTiedot LUKUOIKEUDET eraantyneet' style='display:flex; margin-left:2.5em;'>";
                              echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko LUKUOIKEUDET'>Alkanut:</div>";
                              echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-4 data LUKUOIKEUDET'>";
                              echo  $EraantyLukuoikeusAlkaaMuokattu;
                              echo "</div>";
                              echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko LUKUOIKEUDET '>Päättynyt:</div>";
                              echo "<div class='col-sm-3 col-md-6 col-lg-4 col-xl-4 data LUKUOIKEUDET'>";
                              echo  $EraantyLukuoikeusPaattyyMuokattu;
                              echo "</div>";
                              echo "</div>";
                            }
                }
            } else {
          }


        $HaeAktiivinenLKM = "SELECT Count(Lukuoikeus_ID) AS LKM 
          	FROM tbl_lukuoikeudet 
          	WHERE Asiakasnumero = '$asiakasnumero' AND Tila = 'Voimassa'";
        $HaeAktiivinenLKMTulos = $conn->query($HaeAktiivinenLKM);
          if ($HaeAktiivinenLKMTulos->num_rows > 0) {
            	while($row = $HaeAktiivinenLKMTulos->fetch_assoc()) {
                $LKM = $row['LKM'];
            	}
          	}

	        if ($LKM == 0 || $LKM < 0 && $LukuoikeusOstettu == 'EI' && $Tila == 'EiVoimassa')
	            {
	                echo "<style>";
	                echo ".SIIRRYC{display:none;}";
	                echo "</style>";
	            }
	        else
	            {
	                echo "<style>";
	                echo ".SIIRRYC{display:block;}";
	                echo "</style>";
	            }


            if($LKM == 0 || $LKM < 0 && $LukuoikeusOstettu == 'EI')
            	{
	              echo "<style>";
	              echo ".LUKUOIKEUDET{display:block;}";
	              echo "</style>";
            	}
            else
	            {

	            }


	            /*
	        if($Tila == 'EiVoimassa')
		        {
		        	$LisaaOSTOSKORIIN = "INSERT INTO tbl_Ostoskori (Asiakasnumero,Etunimi,Sukunimi)
		        							VALUES ('$asiakasnumero','$etunimi','$sukunimi')";
		        	$LisaaOSTOSKORIIN_kysely = mysqli_query($conn, $LisaaOSTOSKORIIN) or die (mysqli_error($conn));
                        
		        }
		        */



           ?>

           <br>
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
</html>
<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>