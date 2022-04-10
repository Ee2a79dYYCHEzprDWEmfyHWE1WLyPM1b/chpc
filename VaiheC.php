<?php session_start(); ?>
<?php

include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Connect.php';
error_reporting(0);
date_default_timezone_set('Europe/Helsinki'); // Set your default timezone

$KayttajaTunnus = $_SESSION['Kayttajatunnus'];
if(!isset($_SESSION['Kayttajatunnus'])){
    echo "Olet Jo kirjautunut ulos";
    header('Location:KirjauduVaiheC.php');
}

$HaeArtikkelit= "SELECT Artikkeli_Tunnus,Tyyppi,SisennysTyyppi,Vaihe_ID,Sisalto
            FROM tbl_artikkelit Where Vaihe_ID = '1002'";

$HaeArtikkelitTulos=mysqli_query($conn,$HaeArtikkelit);
$HaeArtikkelitTulostarkistus=mysqli_num_rows($HaeArtikkelitTulos);



$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }
}

$HaeKuva = mysqli_query($conn, "SELECT * FROM tbl_kayttajatunnus  where Rooli = 'Admin'");

$HaeNimiLause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-32'";
$result_HaeNimiLause = $conn->query($HaeNimiLause);

if ($result_HaeNimiLause->num_rows > 0) {

    while($row = $result_HaeNimiLause->fetch_assoc()) {
      $NimiLause =$row["Lause"];
    }
}

$HaeCHPClause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-33'";
$result_HaeCHPClause = $conn->query($HaeCHPClause);

if ($result_HaeCHPClause->num_rows > 0) {

    while($row = $result_HaeCHPClause->fetch_assoc()) {
      $HaeCHPClause =$row["Lause"];
    }
}

$HaeLYlause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-34'";
$result_HaeLYlause = $conn->query($HaeLYlause);

if ($result_HaeLYlause->num_rows > 0) {

    while($row = $result_HaeLYlause->fetch_assoc()) {
      $HaeLYlause =$row["Lause"];
    }
}

$HaePuhelinnumerolause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-35'";
$result_HaePuhelinnumerolause = $conn->query($HaePuhelinnumerolause);

if ($result_HaePuhelinnumerolause->num_rows > 0) {

    while($row = $result_HaePuhelinnumerolause->fetch_assoc()) {
      $HaePuhelinnumerolause =$row["Lause"];
    }
}


$HaeEspooLause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-4'";
$result_HaeEspooLause = $conn->query($HaeEspooLause);

if ($result_HaeEspooLause->num_rows > 0) {

    while($row = $result_HaeEspooLause->fetch_assoc()) {
      $EspooLause =$row["Lause"];
    }
}

$HaeSocial= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-10'";
$result_HaeSocial = $conn->query($HaeSocial);

if ($result_HaeSocial->num_rows > 0) {

    while($row = $result_HaeSocial->fetch_assoc()) {
      $Lause_sql_Jaa =$row["Lause"];
    }
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
  <title>CHPC- Vaihe C</title>
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
          background-image: url(Media/Appearance_of_sky_for_weather_forecast,_Dhaka,_Bangladesh.jpg);
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
       }
       header >.container >.row >.Logo span{
           margin-left:-15px;
       }
       .container > .row > .footer{
           margin-top:5px;
       }
       .header >.container >.row >.Logo span{
        text-align: center;
        font-size: 22px;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 5px;
        padding-top:15px;
      }
      .header >.container >.row >.Logo{
        margin-top:10px;
      }
       @media only screen and (min-width: 1024px) {
        .container > .row > .header{
            height:205px;
        }
        .header >.container >.row >.kirjaudu button{
            width:290px;
        }
       }

  .container > .row >.Logo i{
                  font-size:20px;
                  color:black;
                  margin-left:10px;
                  padding-top:5px;
  }

.Mustapallo{
  margin-top:-35px;
  margin-bottom:-30px;
  text-indent:-1.6em;
  margin-left:1em;

}
.Mustapallo > li{
  color:blck;
  font-size:18px;
  list-style:none;
  margin-top:-20px;
}
.Mustapallo > li:not(:last-child){
  margin-bottom:5px;
}
.Mustapallo > li:before{
  content:"\2B24";
  margin-right:10px;
  font-size:10px;
}

.valkoinenPallo{
  margin-top:-35px;
  margin-bottom:-30px;
  text-indent:-1.6em;
  margin-left:3em;
}
.valkoinenPallo > li{
  color:blck;
  font-size:18px;
  list-style:none;
  margin-top:-20px;
}
.valkoinenPallo > li:not(:last-child){
  margin-bottom:5px;
}
.valkoinenPallo > li:before{
  content:"\2B58";
  margin-right:10px;
  font-size:10px;
}


.Tahti{
  margin-top:-25px;
  margin-bottom:-30px;
  margin-left:0.4em;
  text-indent:-1em;
}
.Tahti > li{
  color:blck;
  font-size:18px;
  list-style:none;
  margin-top:-20px;
}

.Tahti > li:before{
  content:"\066D";
  margin-right:10px;
}

.missioBOX{
    width:100%;
    background-color:RGB(244,160,0,0.7);
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
	.container > .row >.body >.artikkeli
	{
		font-size: 18px;
	}
	body .artikkeli.otsikko
	{
		font-size: 15px;
	}
	
	.container > .row > .footer
	{
		height: 100%;
	}
	
	.container > .row > .body p
	{
		font-size: 15px;
	}
	
	.ylanavbar1,.ylanavbar3
	{
		display: none;
	}
	
	.container > .row > .header
	{
		height:10%;
		min-height: 55px;
		z-index: 1;
	}
	
	.container > .row > .header .ylanavbar2
	{
		width: 100%;
		margin-top:10px;
	}
	
	.container > .row > .header .ylanavbar2 .Hamburger
	{
		text-align: right;
		display: inline-block;
		font-size:30px;
		margin-top:10px!important;
		
	}
	
	.container > .row > .header .ylanavbar2 .Logo span:nth-child(1)
	{
		color:RGB(244,160,0);
		text-transform: uppercase;
		font-size:20px;
	}
	.container > .row > .header .ylanavbar2 .Logo span:nth-child(2)
	{
		color:RGB(15,157,80);
		text-transform: uppercase;
		font-size:20px;
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
		margin-right: 50px;
		color:black;
	}
	
	.SideBarPainikkeet
	{
		position: inherit;
		margin-top: 4em;
		text-align: center;
		width:100%;
	}
	.SideBarPainikkeet .Missio
	{
		width:100;
		min-width: 15em;
		border-radius: 0px;
		color:black;
		border-color: black;
		text-transform: uppercase;
		margin-left: 50px !important;
	}
	
	.SideBarPainikkeet .Ostoskori,.UT,.KU
	{
		width:100;
		min-width: 15em;
		border-radius: 0px;
		color:black;
		border-color: black;
		text-transform: uppercase;
		margin-top: 5px;
		margin-left: 50px !important;
	}
	
	.container > .row > .footer
	{
		height:100%;
	}
	
	#mySidebar h7
	{
		text-transform: uppercase;
		width: 100%;
		margin-left: 7em;
		position: relative;
		top: -25px;
		font-weight: bold;
	}
	
	#mySidebar a i
	{
		margin-top: -1em;
		position: relative;
		text-align: center;
		display: inline-flex;
		font-size: 30px;
		margin-bottom: 0.5em;
		margin-left:2.5em !important;
		color:black;
	}
	
	.header #time
	{
		text-align: center;
		font-size: 20px;
	}
	
	
}
	
	
	
	

/*Jos näytön leveys on 900px tai pienempi*/
@media only screen and (max-width: 900px) and (min-width:600px)
{
	.container > .row > .header
	{
		height:100%;
		min-height: 55px;
	}
	
	body .artikkeli.otsikko
	{
		font-size: 15px;
	}
	
	.container > .row > .footer
	{
		height: 100%;
	}
	
	.container > .row > .body p
	{
		font-size: 15px;
	}
	
	.ylanavbar1,.ylanavbar3
	{
		display: none;
	}
	
	#mySidebar
	{
		height:100%;
		background-color: rgb(166,241,166,0.6);
		margin-top: 2.5px;
		width: 100%;
		display: none;
	}
	
	.container > .row > .header .ylanavbar2 .Logo
	{
		text-align: center;
		margin-top: 7px;
		text-align: left;
	}
	
	.container > .row > .header .ylanavbar2 .Logo span
	{
		font-size: 25px;
		display: inline-block;
		text-transform: uppercase;
	}
	.container > .row > .header .ylanavbar2 .Logo span:nth-child(1)
	{
		color:RGB(244,160,0);
	}
	.container > .row > .header .ylanavbar2 .Logo span:nth-child(2)
	{
		color:RGB(15,157,80);
	}
	.container > .row > .header .ylanavbar2 .Hamburger
	{
		text-align: right;
		display: block;
		display: inline-block;
		top:5px;
		font-size:30px;
		margin-top:10px !important;
	}
	
	#mySidebar a.suljeIkoni
	{
		font-size: 35px;
		float: right;
		position: 	inherit;
		margin-right: 50px;
		color:black;
	}
	
	.SideBarPainikkeet
	{
		position: inherit;
		margin-top: 4em;
		text-align: center;
		width:100%;
	}
	.SideBarPainikkeet .Missio
	{
		width:100;
		min-width: 25em;
		border-radius: 0px;
		color:black;
		border-color: black;
		text-transform: uppercase;
		margin-left: 50px !important;
		
	}
	
	.SideBarPainikkeet .Ostoskori,.UT,.KU
	{
		width:100;
		min-width: 25em;
		border-radius: 0px;
		color:black;
		border-color: black;
		text-transform: uppercase;
		margin-top: 5px;
		margin-left: 50px !important;
		
	}
	
	.container > .row > .footer
	{
		height:100%;
	}
	
	#mySidebar h7
	{
		text-transform: uppercase;
		width: 100%;
		margin-left: 14em;
		position: relative;
		top: -25px;
		font-weight: bold;
	}
	
	#mySidebar a i
	{
		margin-top: -1em;
		position: relative;
		text-align: center;
		display: inline-flex;
		font-size: 30px;
		margin-bottom: 0.5em;
		margin-left:3.5em;
		color:black;
	}
	
	.Alavalikko
	{
		display: none
	}
	
	.header #time
	{
		text-align: center;
		font-size: 20px;
	}
	
	
}
	
	

	
/*Jos näytön leveys on 950px tai suurempi*/
@media only screen and (min-width: 950px) 
{
	
	.container > .row > .header
	{
		height:100%;
		min-height:200px;
	}
	
	.container > .row > .header .ylanavbar1,.ylanavbar2,.ylanavbar3
	{
		height:100%;
		min-height: 50px;
	}
	
	.container > .row > .header .ylanavbar1
	{
		height: 70px;
	}
	.container > .row > .header .ylanavbar1 .Missio
	{
		margin-top:5px;
		width:300px;
		text-transform: uppercase;
		border-radius: 0px;
		font-size: 25px;
		float: left;
		margin-left: 5px;
		color:black;
		border-color: black;
		background-color: rgb(166,241,166,0.01);
	}
	
	.container > .row > .header .ylanavbar1 .Ostoskori:hover,.Missio:hover
	{
		font-weight: bold;
	}
	
	.container > .row > .header .ylanavbar1 .Ostoskori
	{
		margin-top:5px;
		width:300px;
		text-transform: uppercase;
		border-radius: 0px;
		font-size: 25px;
		float: left;
		margin-right: 20px;
		color:black;
		border-color: black;
		float: right;
		background-color: rgb(166,241,166,0.01);
	}
	
	.container > .row > .header .ylanavbar2
	{
		height: 70px;
	}
	
	.container > .row > .header .ylanavbar2 .Logo
	{
		text-align: center;
	}
	
	.container > .row > .header .ylanavbar2 .Logo span
	{
		font-size: 35px;
		display: inline-block;
		text-transform: uppercase;
	}
	.container > .row > .header .ylanavbar2 .Logo span:nth-child(1)
	{
		color:RGB(244,160,0);
	}
	.container > .row > .header .ylanavbar2 .Logo span:nth-child(2)
	{
		color:RGB(15,157,80);
	}
	.container > .row > .header .ylanavbar2 .Hamburger
	{
		text-align: right;
		display: none
	}
	
	.container > .row > .header .ylanavbar3
	{
		height: 70px;
	}
	
	.container > .row > .header .ylanavbar3 .UT
	{
		margin-top:5px;
		width:300px;
		text-transform: uppercase;
		border-radius: 0px;
		font-size: 25px;
		float: left;
		margin-left: 5px;
		color:black;
		border-color: black;
		background-color: rgb(166,241,166,0.01);
	}
	
	.container > .row > .header .ylanavbar3 .UT:hover
	{
		font-weight: bold;
	}
	
	.container > .row > .header .ylanavbar3 .KU
	{
		margin-top:5px;
		width:250px;
		text-transform: uppercase;
		border-radius: 0px;
		font-size: 25px;
		text-align: center;
		color:red;
		border-color: red;
		background-color: rgb(166,241,166,0.01);
	}
	
	.container > .row > .header .ylanavbar3 .KU:hover
	{
		font-weight: bold;
	}
	
	.container > .row > .header .ylanavbar3 .Some
	{
		display: inline-block;
		line-height: 65px;
		text-align: center;
	}
	
	.container > .row > .header .ylanavbar3 .Some i
	{
		font-size: 35px;
		margin-left: 30px;
		outline: none;
	}
	
	#mySidebar
	{
		
		display: none;
	}
	.header #time
	{
		text-align: center;
		font-size: 20px;
	}

	
	
}
  </style>


<div class="container">
    <div class="row">
      <div class="col-xl header" id="header">
        <div class="row ylanavbar1">
				<div class="col Missio" >
					<button type="button" class="btn btn-outline-primary Missio" data-toggle="modal" data-target="#myModal_2">Missio</button>
				</div>
				
  			</div>
		  	<div class="row ylanavbar2">
				<div class="col Logo" ><span>Tuottavuus</span><span>klinikat</span></div>
				<div class="col Hamburger" onclick="w3_open()"><i class="fas fa-bars"></i></div>
  			</div>
		  	<div class="row ylanavbar3">
				<div class="col UT"><a href="uutiskirjetilaus.php"><button type="button" class="btn btn-outline-primary UT">Uutiskirjeen tilaus</button></a></div>
				<div class="col KU"><a href="KirjauduVaiheC.php"><button type="button" class="btn btn-outline-primary KU">Kirjaudu Ulos </button></a></div>
				<div class="col Some">
				<a style="color:black;text-decoration:none;" href="mailto:?subject=TUOTTAVUUDEN PARANTAMINEN&amp;body=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>">
					<i class="far fa-envelope"></i>
				</a>
					<a style="color:black;" href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>"><i class="fab fa-facebook-f"></i></a>
					
					<a style="color:black;" href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause_sql_Jaa;?>"><i class="fab fa-twitter"></i></a>
					
					<a style="color:black;" href="https://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fi"><i class="fab fa-linkedin-in"></i></a>
				</div>
  			</div>
		   <div id="time"></div>

      </div>
		
				<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button suljeIkoni">x</a>
	<div class="SideBarPainikkeet">
		<div class="col Missio" >
				<button type="button" class="btn btn-outline-primary Missio" data-toggle="modal" data-target="#myModal_2" >Missio</button>
		</div>
		<div class="col UT">
			<a href="uutiskirjetilaus.php">
				<button type="button" class="btn btn-outline-primary UT">Uutiskirjeen tilaus</button>
			</a>
		</div>
		<div class="col KU">
			<a href="KirjauduVaiheC.php">
				<button type="button" class="btn btn-outline-primary KU">Kirjaudu Ulos </button>
			</a>
		</div>
	</div>
	
	
	<br><br>
	<h7>Jaa sosiaalisessa mediassa</h7>
	<br>
	<a href="mailto:?subject=TUOTTAVUUDEN PARANTAMINEN&amp;body=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>">
		<button type="button" class="btn btn-outline-dark Email" >Email</button>
	</a>

	<a style="color:black;" href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>"><i class="fab fa-facebook-f"></i></a>
					
	<a style="color:black;" href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause_sql_Jaa;?>"><i class="fab fa-twitter"></i></a>
					
	<a style="color:black;" href="https://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fi"><i class="fab fa-linkedin-in"></i></a>
	<br>
</nav>
    </div>
  </div>
</head>
<div>

</div>
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
        <p class="otsikko">
              <?php
                    if($HaeArtikkelitTulostarkistus > 0){
                        while($row =mysqli_fetch_assoc($HaeArtikkelitTulos)){
                        $Artikkeli_Tunnus = $row['Artikkeli_Tunnus'];
                        $Artikkeli_Tyyppi = $row['Tyyppi'];
                        $Artikkeli_SisennysTyyppi = $row['SisennysTyyppi'];
                        $Artikkeli_Sisaltö = $row['Sisalto']."<BR>";
                          //echo $Artikkeli_Tunnus."<br>".$Artikkeli_Tyyppi."<br>".$Artikkeli_Sisaltö."<br>";
                              if ($Artikkeli_Tyyppi == 'Sisennys' && $Artikkeli_SisennysTyyppi == 'MustaPallo'){
                                  echo "<ul class='MustaPallo'>";
                                  echo "<br><li>$Artikkeli_Sisaltö</li><br><br>";
                                  echo "</ul>";
                              }else if($Artikkeli_Tyyppi == 'SisaSisennys' && $Artikkeli_SisennysTyyppi == 'valkoinenPallo'){
                                echo "<ul class='valkoinenPallo'>";
                                echo "<br><li>$Artikkeli_Sisaltö</li><br><br>";
                                echo "</ul>";
                              }else if($Artikkeli_Tyyppi == 'Kappale' && $Artikkeli_SisennysTyyppi == 'Tahti'){
                                  echo "<ul class='Tahti'>";
                                  echo "<br><li>$Artikkeli_Sisaltö</li><br><br>";
                                  echo "</ul>";
                              }else if($Artikkeli_Tyyppi == 'Valiotsikko'){
                                  echo "<br>";
                                  echo "<hr style='margin-bottom:5px;width:90%;background-color:gray;'>";
                                  echo "<p class='otsikko'>$Artikkeli_Sisaltö</p>";
                                  echo "<hr style='margin-top:5px;width:90%;background-color:gray;'>";
                                  echo "<br><br>";
                              }else{
                                echo "<p class='artikkeli' style='margin-top:-1em;'>";
                                echo  $Artikkeli_Sisaltö.'<br>';
                                echo "</p>";
                              }
                        }
                    }

                    echo "<p class='artikkeli' style='margin-top:-1em;'>";
                    echo "<br><br>".$NimiLause.'<br>'.$HaeCHPClause.'<br>'.$HaeLYlause.'<br>'.$EspooLause.', '.$HaePuhelinnumerolause;
                    echo "</p>";
              ?>
              </p>
              <?php
                while ($row = mysqli_fetch_array($HaeKuva))
                    {
                      echo "<div id='img_div'>";
                      echo "<img src='Media/".$row['Kuva']."' style='height:300px;width:250px;margin-bottom:10px;margin-top:-2em;'>";
                      echo "</div>";
                    }
              ?>

      </div>
    </div>
  </div>
</body>
	<div class="container">
    <div class="row">
    	<div id="missioBOX_2" class="missioBOX">
            <h5 class="MISSIOOTSIKKO">MISSIOMME</h5>
            <h6 class="MISSIOTEKSTI"><?php echo $Lause; ?></h6>
            <h5 id="sulje_2" class="MISSIOOTSIKKO" style="font-size:15px;color:red;cursor:pointer;">PIILOTA TEKSTI</h5>
  		</div>
  	</div>
  </div>
  <script>
          $(document).ready(function(){
            $("#sulje_2").click(function(){
              $(".missioBOX").hide();
            });
            $("#avaa_2").click(function(){
              $("#missioBOX_2").show();
            });
            
          });
  </script>

<div class="container Alavalikko">
    <div class="row">
      <div class="col-xl header">
        <div class="row ylanavbar1">
				<div class="col Missio" >
					<button type="button" class="btn btn-outline-primary Missio" data-toggle="modal" data-target="#myModal_2" >Missio</button>
				</div>
  			</div>
		  	<div class="row ylanavbar2">
				<div class="col Logo" ><span>Tuottavuus</span><span>klinikat</span></div>
				<div class="col Hamburger" onclick="w3_open()"><i class="fas fa-bars"></i></div>
  			</div>
		  	<div class="row ylanavbar3">
				<div class="col UT"><a href="Uutiskirjetilaus.php"><button type="button" class="btn btn-outline-primary UT">Uutiskirjeen tilaus</button></a></div>
				<div class="col KU"><a href="KirjauduVaiheC.php"><button type="button" class="btn btn-outline-primary KU">Kirjaudu Ulos </button></a></div>
				<div class="col Some">
					<a style="color:black;text-decoration:none;" href="mailto:?subject=TUOTTAVUUDEN PARANTAMINEN&amp;body=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>">
						<i class="far fa-envelope"></i>
					</a>
					<a style="color:black;" href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>"><i class="fab fa-facebook-f"></i></a>
					
					<a style="color:black;" href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause_sql_Jaa;?>"><i class="fab fa-twitter"></i></a>
					
					<a style="color:black;" href="https://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fi"><i class="fab fa-linkedin-in"></i></a>
				</div>
  			</div>
      </div>
				<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button suljeIkoni">x</a>
	<div class="SideBarPainikkeet">
		<div class="col Missio" >
				<button type="button" class="btn btn-outline-primary Missio" data-toggle="modal" data-target="#myModal_2">Missio</button>
		</div>
		<div class="col UT">
			<a href="Uutiskirjetilaus.php">
				<button type="button" class="btn btn-outline-primary UT">Uutiskirjeen tilaus</button>
			</a>
		</div>
		<div class="col KU">
			<a href="KirjauduVaiheC.php">
				<button type="button" class="btn btn-outline-primary KU">Kirjaudu Ulos </button>
			</a>
		</div>
	</div>
	
	
	<br><br>
	<h7>Jaa sosiaalisessa mediassa</h7>
	<br>
	<a style="color:black;text-decoration:none;" href="mailto:?subject=TUOTTAVUUDEN PARANTAMINEN&amp;body=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>">
		<i class="far fa-envelope"></i>
	</a>

	<a style="color:black;" href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>"><i class="fab fa-facebook-f"></i></a>
					
	<a style="color:black;" href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause_sql_Jaa;?>"><i class="fab fa-twitter"></i></a>
					
	<a style="color:black;" href="https://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fit"><i class="fab fa-linkedin-in"></i></a>
	<br>
</nav>
    </div>
</div>



<script type = "text/javascript">


window.addEventListener('contextmenu', function (e) {

  alert('\n'
            +'SISÄLLÖN KOPIONTI ON ESTETTY!');
  e.preventDefault();
}, false);

$(document).ready(function(){
   $('body').bind('copy paste', function (e)
   {
    alert('\n'
            +'SISÄLLÖN KOPIONTI ON ESTETTY!');
      e.preventDefault();
   });
});


// Lasketaan aikarajaus c-vaiheen istunnolle
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
            window.location.href = "KirjauduVaiheC.php";
        }
    }, 1000);
}

jQuery(function ($) {
    var fiveMinutes = 60 * 60,
        display = $('#time');
    startTimer(fiveMinutes, display);
});


/*
function startTimer(duration, display) {
var timer = duration, minutes, seconds;
setInterval(function () {
    minutes = parseInt(timer / 60, 10)
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = minutes + " : " + seconds;

    if (--timer < 0) {
        window.location.href = "KirjauduVaiheC.php";
    }
      console.log(parseInt(seconds))
      window.localStorage.setItem("seconds",seconds)
      window.localStorage.setItem("minutes",minutes)
}, 1000);
}

window.onload = function () {
  sec  = parseInt(window.localStorage.getItem("seconds"))
  min = parseInt(window.localStorage.getItem("minutes"))

  if(parseInt(min*sec)){
    var fiveMinutes = (parseInt(min*60)+sec);
  }else{
    var fiveMinutes = 60 * 60;
  }
    // var fiveMinutes = 60 * 5;
  display = document.querySelector('#time');
  startTimer(fiveMinutes, display);
};

// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
*/
</script>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-xl footer">
        <div class="container">
          <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  Logo"><span style="color:RGB(244,160,0);letter-spacing:1px;">Tuottavuus</span><span style="color:RGB(15,157,88);letter-spacing:1px;">klinikat</span> pidättää kaikki oikeudet kotisivuilla julkaistavaan aineistoon</div>        </div>
      </div>
    </div>
  </div>
</div>
</footer>
</html>
