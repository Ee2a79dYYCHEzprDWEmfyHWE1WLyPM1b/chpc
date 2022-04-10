<?php session_start(); ?>
<?php

include_once 'PHP - Funktiot/Connect.php';
error_reporting(0);

if(!isset($_SESSION['Kayttajatunnus'])){
    echo "Olet Jo kirjautunut ulos";
    header('Location:KirjauduVaiheB.php');
}

$KayttajaTunnus = $_SESSION['Kayttajatunnus'];
  $sql = "SELECT  tbl_kayttajatunnus.MuokattuKayttajatunnus,tbl_asiakkaat.MuokattuAsiakas,
                  tbl_asiakkaat.Asiakasnumero,tbl_asiakkaat.Etunimi,
                  tbl_asiakkaat.Sukunimi, tbl_asiakkaat.Sposti,tbl_kayttajatunnus.Kayttajatunnus,
                  tbl_kayttajatunnus.Salasana,tbl_asiakkaat.LisattyAsiakas
  FROM tbl_asiakkaat
  INNER JOIN tbl_kayttajatunnus ON tbl_kayttajatunnus.Asiakasnumero = tbl_asiakkaat.Asiakasnumero
  WHERE tbl_kayttajatunnus.Kayttajatunnus = '$KayttajaTunnus'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $asiakasnumero = $row["Asiakasnumero"];
        $etunimi = $row["Etunimi"];
        $sukunimi =$row["Sukunimi"];
        $sposti = $row["Sposti"];
        $käyttäjätunnus = $row["Kayttajatunnus"];
        $salasana = $row["Salasana"];
        $Lisätty = $row["LisattyAsiakas"];
        $MuokattuAsiakas = $row["MuokattuAsiakas"];
        $MuokattuKayttajatunnus = $row["MuokattuKayttajatunnus"];
    }

  }
  $_SESSION['Asiakasnumero'] = $asiakasnumero;
  $_SESSION['Enimi'] = $etunimi;
  $_SESSION['Snimi'] = $sukunimi;
  $_SESSION['Email'] = $sposti;

  $sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
  $result_Missio = $conn->query($sql_Missio);

  if ($result_Missio->num_rows > 0) {

      while($row = $result_Missio->fetch_assoc()) {
        $Lause =$row["Lause"];
      }

  }


//Haetaan viimeisin kirjautumsikerta
$sql_HaeViimeisin_Kirjautumiskerta = "SELECT Paivays FROM tbl_kirjautumiset WHERE Kayttajatunnus = '$KayttajaTunnus' ORDER BY Paivays DESC LIMIT 1";
$result_sql_HaeViimeisin_Kirjautumiskerta = $conn->query($sql_HaeViimeisin_Kirjautumiskerta);

  if ($result_sql_HaeViimeisin_Kirjautumiskerta->num_rows > 0) {

      while($row = $result_sql_HaeViimeisin_Kirjautumiskerta->fetch_assoc()) {
        $KirjautmisPAIVA =$row["Paivays"];
      }

  }




//Muutetaan Tietokannan Timestamp päiväysformatti vastamaman suomen standardi versiota

//Asiakkaan lisäys
$AikaLeimaLisatty = "$Lisätty";
$PaivaysLisatty = date("d.m.Y", strtotime($AikaLeimaLisatty));

//Asiakastietojen muokkausPVM
$AikaleimaMuokattuAsiakasTieto = $MuokattuAsiakas;
$MuokattuAsiakasTietoTulostus = date("d.m.Y", strtotime($AikaleimaMuokattuAsiakasTieto));

//Käyttäjätunnustietojen muokkausPVM
$AikaleimaMuokattuKayttajaTunnusTieto = $MuokattuKayttajatunnus;
$MuokattuKayttajatunnusTulostus = date("d.m.Y", strtotime($AikaleimaMuokattuKayttajaTunnusTieto));

//ViimeksiKirjautunut muokkausPVM
$AikaleimaViimeksiKirjautunut = $KirjautmisPAIVA;
$ViimeksiKirjautunutTulostus = date("d.m.Y", strtotime($AikaleimaViimeksiKirjautunut));



?>
<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- ASIAKASPROFIILI, B-vaihe</title>
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
				width:10%;
				position: relative;
		}
	.body > .Painikkeet >a .KU
		{
				position: relative;
				top:60px;
				right: 100%;
		}
	.body > .Painikkeet >a .VaiheB
		{
				position: relative;
				top:7.5em;
				right: 44em;
		}
		
	.body > .Painikkeet >a .sirryC
		{
				position: relative;
				top:6.7em;
				max-width:36%;
				height: 55px;
				
		}
		
	.container > .row > .body
		{
				height:100%;
				min-height: 80em;
		}
		.body .asiakasTiedot .otsikko
		{
				margin-left: 1.5em;
				margin-top: 15px;
		}
		
		.body .asiakasTiedot .data
		{
				margin-left: 1.5em;
				margin-top: -10px;
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
				width:10%;
				position: relative;
		}
	.body > .Painikkeet >a .KU
		{
				position: relative;
				top:60px;
				right: 100%;
		}
	.body > .Painikkeet >a .VaiheB
		{
				position: relative;
				top:7.5em;
				right: 44em;
		}
		
	.body > .Painikkeet >a .sirryC
		{
				position: relative;
				top:6.7em;
				max-width:36%;
				height: 55px;
				
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
	width:100%;
	margin:auto;
	padding: auto;
	border-radius: 0px 0px;

}
h6
{
	text-align: center;
	font-size: 15px;
	cursor: pointer;
	text-transform: uppercase;
	font-weight: bold;
	margin:auto;
	padding: auto;
}


.sisennys{
  margin-top:-25px;
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
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;" id="mySidebar">
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
	
	
</head>


<body>

<div class="container">
    <div class="row">
    <div id="missioBOX" class="missioBOX">
            <h5 class="MISSIOOTSIKKO">MISSIOMME</h5>
            <h4 class="MISSIOTEKSTI"><?php echo $Lause; ?></h4>
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
      <p class="otsikko">ASIAKASPROFIILI, B-vaihe</p>
				<h6 id="RespoIlmoitus">Arvoisa asiakkaamme! taataksemme parhaan käyttökokemuksen, pyydämme teitä ystävällisesti käyttämään tablet- tai tietokone laitetta</h6>
      <h6 style="padding-top:5em;position:absolute;left:50em;top:-4em;">Viimeksi kirjautunut:&nbsp;&nbsp;
	      	<?php 
	      		if($KirjautmisPAIVA == NULL)
	      			{
	      				echo " ";
	      			}
	      		else
	      			{
	      				echo $ViimeksiKirjautunutTulostus;
	      			}	
	      	?>
      		
      	</h6>
<div class="alert alert-warning">
<h6 id="naytaInfoTeksti" style="color:green;">Lue Minut</h6>
  		<div class="infoboksi" style="display:none;">
		  <h5 class="teksti" style="color:black;">
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
		</div>
<h6 id="suljeInfoTeksti" style="color:red; display:none;">piilota minut</h6>
</div>

<script>
	$(document).ready(function(){
		$("#naytaInfoTeksti").click(function(){
			$(".infoboksi").show();
			$("#suljeInfoTeksti").show();

		});
		
		
		$("#suljeInfoTeksti").click(function(){
			$(".infoboksi").hide();
		});
	});
</script>



                <br>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em">Asiakasnumero</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:5px;">&nbsp;&nbsp;<?php echo $asiakasnumero; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko">Nimi</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;">&nbsp;<?php echo $etunimi." ".$sukunimi; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko">Sähköpostiosoite</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;">&nbsp;<?php echo $sposti; ?></div>
            </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko">Käyttäjätunnus</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;">&nbsp;<?php echo $käyttäjätunnus; ?></div>
            </div>

            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko">Salasana</div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 data SalsanaDATA" style="padding-left:0.6rem;">&nbsp;<?php echo $salasana; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 data NaytaSalasanPainike" id="NaytaSS" style="padding-left:0.6rem;text-align: left;cursor: pointer;text-transform: uppercase;color:blue;">&nbsp;Näytä salasana</div>
            </div>
            <script>
				$(document).ready(function(){
				   $(".SalsanaDATA").hide();
				  $("#NaytaSS").click(function(){
				    $(".SalsanaDATA").show();
				    $(".NaytaSalasanPainike").hide();
				  });
				});
			</script>
            <br><br>
            <div class="row asiakasTiedot" >
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko">Rekisteröitynyt: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 data" style="padding-left:-0px;">&nbsp;<?php echo $PaivaysLisatty; ?></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 otsikko MV" style="margin-left:-0px;">Asiakastietoja muokattu viimeksi: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 data MVD" style="padding-left:0px;">&nbsp;
                	<?php 
                		if($MuokattuAsiakas == 'NULL' || $MuokattuAsiakas == NULL)
                			{
                				echo "<h7 style='text-transform:uppercase;color:red;'>Tietoja ei muokattu</h7>";
                			}	
                			else
                			{
                				echo $MuokattuAsiakasTietoTulostus;
                			}
                			 

            		?>
            			
            		</div>
            </div>
            <div class="row asiakasTiedot" >
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-2 otsikko"></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 data" style="padding-left:-0px;"></div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-4 otsikko" style="margin-left:-0px;">Käyttäjätunnustietoja muokattu viimeksi: </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 data" style="padding-left:0px;">&nbsp;
                	<?php 
                		if($MuokattuKayttajatunnus == 'NULL' || $MuokattuKayttajatunnus == NULL)
                			{
                				echo "<h7 style='text-transform:uppercase;color:red;'>Tietoja ei muokattu</h7>";
                			}	
                			else
                			{
                				echo $MuokattuKayttajatunnusTulostus;
                			}
                			 

            		?>		
                	</div>
            </div>

            <br>
            <hr>
            <br>
            <div class="Painikkeet">
              <a href="MuokkaaTietojaB.php" ><button class="Muokkaa MuokkaaB MKT btn btn-outline-primary" style="width:21em;margin-left:-0.1em;">Muokkaa tietoja <i class="fas fa-user-edit" style="margin-left:15px;"></i></button></a>
              <a href="KirjauduUlos.php" ><button class="Muokkaa MuokkaaB KU btn btn-outline-danger" style="width:21em;margin-left:1em;">Kirjaudu ULOS <i class="fas fa-sign-out-alt" style="margin-left:15px;font-size:17px;"></i></button></a>
		  	      <a href="VaiheB.php" ><button name="VaiheB" class="Muokkaa VaiheB btn btn-outline-success" style="width:25em;margin-left:1em;">LUE B-VAIHE <i class="fab fa-readme" style="margin-left:15px;font-size:17px;"></i></button></a>
            </div>
            <br>

            <div class="Painikkeet">
              <a href="RekisteroidyVaiheC.php" ><button  name="sirryC" class="Muokkaa MuokkaaB sirryC btn btn-outline-secondary" style="width:69em;margin-left:0.01em;">Rekisteröidy C - vaiheeseen <i class="fas fa-user-plus"></i></button></a>
		        </div>

            <br>
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

