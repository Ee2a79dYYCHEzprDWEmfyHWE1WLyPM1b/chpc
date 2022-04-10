<?php
session_start();
include_once 'PHP - Funktiot/Connect.php';
require 'PHPMailer/PHPMailerAutoload.php';
error_reporting(0);


if(!isset($_SESSION['Kayttajatunnus'])){
  echo "Olet Jo kirjautunut ulos";
    header('Location:KirjauduVaiheB.php');
}

$HaeArtikkelit= "SELECT Artikkeli_Tunnus,Tyyppi,SisennysTyyppi,Vaihe_ID,Sisalto
            FROM tbl_artikkelit Where Vaihe_ID = '1001'";

$HaeArtikkelitTulos=mysqli_query($conn,$HaeArtikkelit);
$HaeArtikkelitTulostarkistus=mysqli_num_rows($HaeArtikkelitTulos);


$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }
}


$HaeLause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-31'";
$result_HaeLause = $conn->query($HaeLause);

if ($result_HaeLause->num_rows > 0) {

    while($row = $result_HaeLause->fetch_assoc()) {
      $TervetuloaLause =$row["Lause"];
    }
}

$HaeTuottavuusklinikatLause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-2'";
$result_HaeTuottavuusklinikatLause = $conn->query($HaeTuottavuusklinikatLause);

if ($result_HaeTuottavuusklinikatLause->num_rows > 0) {

    while($row = $result_HaeTuottavuusklinikatLause->fetch_assoc()) {
      $TuottavuusklinikatLause =$row["Lause"];
    }
}

$HaeNimiLause= "SELECT Lause FROM tbl_lauseet WHERE Lause_Tunnus = 'W-DB-3'";
$result_HaeNimiLause = $conn->query($HaeNimiLause);

if ($result_HaeNimiLause->num_rows > 0) {

    while($row = $result_HaeNimiLause->fetch_assoc()) {
      $NimiLause =$row["Lause"];
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
<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Vaihe B</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
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
       
    ul{
  margin-top:-35px;
  margin-bottom:-30px;
  text-indent:-1.6em;
  margin-left:1em;
}
li{
  color:blck;
  font-size:18px;
  list-style:none;
  margin-top:-20px;

}
li:not(:last-child){
  margin-bottom:5px;
}
li:before{
  content:"\2714";
  margin-right:10px;
}

.Nuoli{
  color:blck;
  font-size:18px;
  list-style:none;
  margin-top:-20px;
  margin-left:1em;
}
.Nuoli:not(:last-child){
  margin-bottom:5px;
}
.Nuoli:before{
  content:"\2B9A";
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
		height:100%;
		min-height: 55px;
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
		margin-top:-10px;
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
		margin-left:2em;
		color:black;
	}
	

}
	
	
	
	

/*Jos näytön leveys on 980px tai pienempi*/
@media only screen and (max-width: 900px) 
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
	
	
	
	
}
	
	

	
/*Jos näytön leveys on 768px tai suurempi*/
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
    
    footer
      {
          width: 100%;
      }
}
      

</style>


<div class="container">
    <div class="row">
      <div class="col-xl header">
        	<div class="row ylanavbar1">
				<div class="col Missio" >
					<button type="button" class="btn btn-outline-primary Missio" data-toggle="modal" data-target="#myModal_2">Missio</button></a>
				</div>

  			</div>
		  	<div class="row ylanavbar2">
				<div class="col Logo" ><span>Tuottavuus</span><span>klinikat</span></div>
				<div class="col Hamburger" onclick="w3_open()"><i class="fas fa-bars"></i></div>
  			</div>
		  	<div class="row ylanavbar3">
				<div class="col UT"><a href="uutiskirjetilaus.php"><button type="button" class="btn btn-outline-primary UT">Uutiskirjeen tilaus</button></a></div>
				<div class="col KU"><a href="index.php"><button type="button" class="btn btn-outline-primary KU">Kirjaudu Ulos </button></a></div>
				<div class="col Some">
					<a style="color:black;" href="mailto:?subject=TUOTTAVUUDEN PARANTAMINEN&amp;body=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>"><i class="fas fa-envelope"></i></a>
					
					<a style="color:black;" href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>"><i class="fab fa-facebook-f"></i></a>
					
					<a style="color:black;" href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause_sql_Jaa;?>"><i class="fab fa-twitter"></i></a>
					
					<a style="color:black;" href="https://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fi"><i class="fab fa-linkedin-in"></i></a>
				</div>
  			</div>
      </div>
</div>
<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" id="mySidebar" style="display:none;">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button suljeIkoni">x</a>
	<div class="SideBarPainikkeet">
		<div class="col Missio" >
				<button type="button" class="btn btn-outline-primary Missio" data-toggle="modal" data-target="#myModal_2">Missio</button>
		</div>
		<div class="col UT">
			<a href="uutiskirjetilaus.php">
				<button type="button" class="btn btn-outline-primary UT">Uutiskirjeen tilaus</button>
			</a>
		</div>
		<div class="col KU">
			<a href="KirjauduVaiheB.php">
				<button type="button" class="btn btn-outline-primary KU">Kirjaudu Ulos </button>
			</a>
		</div>
	</div>
	
	
	<br><br>
	<h7>Jaa sosiaalisessa mediassa</h7>
	<br>
	<a href="JaaKaverile.php">
		<button type="button" class="btn btn-outline-dark Email" >Email</button>
	</a>

	<a href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause_sql_Jaa.'.&nbsp;'.$Lause;?>">
		<i class="fab fa-facebook-f"></i>
	</a>

	<a href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause_sql_Jaa;?>">
		<i class="fab fa-twitter"></i>
	</a>

	<a href="http://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fi/">
		<i class="fab fa-linkedin-in"></i>
	</a>
	<br>
</nav>

    </div>
  </div>






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
      <p class="artikkeli" style="margin-top:0.2em;">

      <?php
            if($HaeArtikkelitTulostarkistus > 0){
                while($row =mysqli_fetch_assoc($HaeArtikkelitTulos)){
                $Artikkeli_Tunnus = $row['Artikkeli_Tunnus'];
                $Artikkeli_Tyyppi = $row['Tyyppi'];
                $Artikkeli_SisennysTyyppi = $row['SisennysTyyppi'];
                $Artikkeli_Sisaltö = $row['Sisalto']."<BR>";
                  //echo $Artikkeli_Tunnus."<br>".$Artikkeli_Tyyppi."<br>".$Artikkeli_Sisaltö."<br>";
                      if ($Artikkeli_Tyyppi == 'Sisennys' && $Artikkeli_SisennysTyyppi == 'OK'){
                          echo "<ul>";
                          echo "<br><li>$Artikkeli_Sisaltö</li><br><br>";
                          echo "</ul>";
                      }else if($Artikkeli_Tyyppi == 'Sisennys' && $Artikkeli_SisennysTyyppi == 'Nuoli'){
                        echo "<ul>";
                        echo "<br><li class='Nuoli'>$Artikkeli_Sisaltö</li><br><br>";
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
            echo "<br>".$TervetuloaLause.'<br><br>'.$TuottavuusklinikatLause.'<br>'.$NimiLause.'<br>'.$EspooLause;
            echo "</p>";
      ?>


        </p>
      </div>
    </div>
  </div>
</body>
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

</script>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-xl footer">
        <div class="container">
          <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  Logo"><span style="color:RGB(244,160,0);letter-spacing:1px;">Tuottavuus</span><span style="color:RGB(15,157,88);letter-spacing:1px;">klinikat</span> pidättää kaikki oikeudet kotisivuilla julkaistavaan aineistoon</div> </div>
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