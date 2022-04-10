<?php session_start(); ?>
<?php 
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Connect.php';
error_reporting(0); 



$Rooli = "";
$KirjautumisPaiva = date("Y-m-d");
if(isset($_POST['kirjauduB'])) {
    
      $KayttajaTunnus = $_POST['kayttajatunnus'];

      $Salasana = $_POST['salasana'];
      $Cryptaus_Salasana = md5($Salasana);

      if((empty($_POST['kayttajatunnus'])) || (empty($_POST['salasana'])))
        {
          // Virheilmoitukset tulostetaan lomakkeen jokaisen syöttökentän alapuolelle
        }
      else
        {

          $SqlKysely = "SELECT
		      	Kayttajatunnus_ID,
		      	Kayttajatunnus,
		      	Salasana,
		      	Rooli,
		      	Password_Hash 
		      		FROM 
		      	tbl_kayttajatunnus 
		      		WHERE 
		      	Kayttajatunnus =  '$KayttajaTunnus' AND Salasana = '$Salasana'";

          $Tulos = mysqli_query($conn,$SqlKysely);

          if(mysqli_num_rows($Tulos) > 0)
            {
              while($RiviTulos = mysqli_fetch_assoc($Tulos))
                {
                  $SALASAN_HASH_B = $RiviTulos["Password_Hash"];
                  $KAYTTAJATUNNUS_B = $RiviTulos["Kayttajatunnus"];


										if($Cryptaus_Salasana = $SALASAN_HASH_B && $RiviTulos["Rooli"] == "Admin")
												{
													$_SESSION['Kayttajatunnus'] = $KayttajaTunnus;
			   									echo "<script>location='ADMIN-Näkymä/ADMIN_Index.php'</script>";
												}
												else if($Cryptaus_Salasana = $SALASAN_HASH_B && $RiviTulos["Rooli"] == "Asiakas")
												{
													$Kayttajatunnus_ID = $RiviTulos['Kayttajatunnus_ID'];
                          $käyttäjätunnus = $RiviTulos['Kayttajatunnus'];
                              
                          $sql_2 = "SELECT Kayttajatunnus,Paivays 
                          		FROM tbl_kirjautumiset 
                          		WHERE Kayttajatunnus = '$KayttajaTunnus' 
                          		ORDER By Paivays DESC LIMIT 1";
                              $result_2 = $conn->query($sql_2);

                              if ($result_2->num_rows > 0) {
                                	while($row2 = $result_2->fetch_assoc()) {
                                    $ViimeksiKirjautunut = $row2["Paivays"]; 
                                    $_SESSION['ViimeksiKirjautunut'] = $ViimeksiKirjautunut;
                                	}
                            	} 

                          // Tallennetaan jokainen kirjautumiskerta kirjautumisen tauluun
                          $insert3 = "INSERT INTO tbl_kirjautumiset (Kayttajatunnus_ID,Kayttajatunnus,Paivays,Vaihe_ID) 
                          						VALUES ('$Kayttajatunnus_ID','$käyttäjätunnus','$KirjautumisPaiva','1001')";
                          $kysely2 = mysqli_query($conn, $insert3) or die (mysqli_error($conn));
                             
                          $_SESSION['Kayttajatunnus'] = $KayttajaTunnus;
                          echo "<script>location='AsiakasprofiiliB.php'</script>";

												}
												else
												{

												}
                }
            }
            else{
                  header('Location:KirjauduBError.php');
                  $_SESSION['Kayttajatunnus'] = $KayttajaTunnus;
                  $_SESSION['salasana'] = $Salasana;
            }
















        }
}

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"]; 
    }
    
}
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
   
    .container > .row > .body > form >.row{
    text-transform:uppercase;
    text-align:center;
}
.container > .row > .body > form >.row > div input[type=text],input[type=username],input[type=email],input[type=password]{
    padding-left:5px;
    text-align:center;
    width:750px;
    height:55px;
}
.container > .row > .body > form >.row  .label{
    text-align:center;
    font-size:20px;
    margin-bottom:5px;
}
.container > .row > .body > form >.row   input[type=text],input[type=username],input[type=email]{
    font-size:25px;
    outline:none;
}
.container > .row > .body > form >.row   input[type=password]{
    font-size:34px;
    letter-spacing:5px;
    outline:none;
}
.container >.row > .body >.KirjauduTeksti{
    font-size:20px;
}
.container >.row > .body >.KirjauduTeksti a{
    text-decoration:none;
    color:blue;
    font-weight:bold;
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

.errorTeksti
  {
    font-size:18px;
    color:red;
    margin-left:1.2em;
  }
.error
  {
    color:red;
    font-size:2em;
    position: absolute;
    margin-top: 10px;
    padding-left:9px;
  }

  .body > form>.Muokkaa
    {
      height:50px;
      width:300px;
      text-align:center;
      margin-left:25em;
      text-transform:uppercase;
      letter-spacing:5px;
      font-weight:600;
      background-color:rgb(135,206,250,0.1);
      outline:none;
    }
    .text{
      background-color:#0275d8;
      opacity:1;
    }
    .text:hover{
      color:#0275d8;
      box-shadow:0 0 2px #0275d8, 0 0 2px #0275d8;
    }
    .text{
      background-color:#0275d8;
      opacity:1;
    }
    .text:hover{
      color:#0275d8;
      box-shadow:0 0 2px #0275d8, 0 0 2px #0275d8;
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
#RespoIlmoitus
	 {
		text-align: center;
		 color:red;
		 text-transform: uppercase;
	 }


	  
/*RESPONSIIVISUUS*/
	/*Jos näytön leveys on 600px tai pienempi*/
@media only screen and (max-width: 600px) 
{
	
	.navbar .fa-bars
	{
		display: block;
	}	
	
	.navbar .fa-bars
	{
		font-size: 27px;
		margin-top:4px;
		float:right;
		color:black;
	}	
	
	.navbar .Missio, .UT
	{
		display: none;
	}
	
	.navbar .UT
	{
		display: none;
	}
	
	.navbar .Logo
	{
		font-size: 30px;
		margin-top: 10px;
	}
	
	#mySidebar
	{
		height:100%;
		background-color: rgb(166,241,166,0.6);
		margin-top: 2.5px;
		width: 100%;
		display: block;
	}
	
	#mySidebar .Missio,.UT
	{
		display: block;
		font-size:25px;
		width:500px;
	}
	
	
	#mySidebar .Missio,.UT
	{
		margin-left: 8em;
		margin-top:0.5em;
	}
	
	#mySidebar a.suljeIkoni
	{
		font-size: 35px;
		float: right;
		position: 	inherit;
		margin-right: 32px;
		color:black;
	}
	
	.container > .row > .body > form >.row input[type=text], input[type=username], input[type=password]	
	{
		width:100%;
		min-width: 300px;
    margin-left: 50px;
	}
	
	.body > form > .Muokkaa
	{
		width:100%;
		margin-left: 0!important;
	}
	
	.container > .row > .footer
	{
		height: 100%;
	}
}
	
	
	
	

/*Jos näytön leveys on 980px tai pienempi*/
@media only screen and (max-width: 900px) 
{
	.container > .row > .header
	{
		height: 100%;
		width:100%;
	}
	
	#RespoIlmoitus
	{
		display: block;
	}
	
	.container > .row > .body > form >.row input[type=text], input[type=username],input[type=password]
	{
		width:100%;
	}
	
	.body > form > .Muokkaa
	{
		width:100%;
		margin-left: 0!important;
	}
	
	.container > .row > .footer
	{
		height: 100%;
	}
	
	.navbar .fa-bars
	{
		display: block;
	}	
	
	.navbar .fa-bars
	{
		font-size: 27px;
		margin-top:4px;
		float:right;
		color:black;
	}	
	
	.navbar .Missio, .UT
	{
		display: none;
	}
	
	.navbar .UT
	{
		display: none;
	}
	
	.navbar .Logo
	{
		font-size: 30px;
		margin-top: 10px;
	}
	
	#mySidebar
	{
		height:100%;
		background-color: rgb(166,241,166,0.6);
		margin-top: 2.5px;
		width: 100%;
		display: none;
	}
	
	#mySidebar .Missio,.UT
	{
		display: block;
	}
	
	#mySidebar .Missio,.UT
	{
		font-size:25px;
	}
	
	#mySidebar .Missio,.UT
	{
		width:300px;
	}
	
	#mySidebar .Missio,.UT
	{
		margin-left: 5em;
		margin-top:0.5em;
	}
	
	#mySidebar a.suljeIkoni
	{
		font-size: 35px;
		float: right;
		position: 	inherit;
		margin-right: 32px;
		color:black;
	}
	
	.container > .row > .body > form >.row  .label
	{
		margin-top:-15px;
	}
	
	.alert-danger
	{
		margin-left: 8em;
		width: 100%;
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
	.NavButton
	{
		text-align: right;
	}
	
	.NavButton a
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
	
	.navbar .Missio, .UT
	{
		display: block;
		float:right;
		margin-left:10%;
	}
	
	
}		  
	  
</style>

<div class="container">
	<div class="row">
    	<div class="container">
    		<div class="row">
      			<div class="col-xl header">
        			<div class="row navbar">
						
						<div class="col Logo"><span style="color:RGB(244,160,0)";>Tuottavuus</span><span style="color:RGB(15,157,80)">klinikat</span></div>
						<div class="col NavButton">
							<a href="#">
								<button type="button" class="btn btn-outline-dark Missio" data-toggle="modal" data-target="#myModal">Missio</button>
							</a>
							<a href="#">
								<i class="fas fa-bars" onclick="w3_open()"></i>
							</a>
						</div>
  					</div>
      			</div>
				<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button suljeIkoni">x</a>
	<div class="Navigaatiopalkit">
		<br><br>
				<a href="#">
						<button type="button" class="btn btn-outline-dark Missio" data-toggle="modal" data-target="#myModal">Missio</button>
				</a>
		</div>
				<br>
</nav>
    		</div>
  		</div>
    </div>
</div>

	
	
	
	
	
</head>
<?php 

function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<body>
<script>
$(document).ready(function(){
  $("#Kirjaudu").click(function(){
    $("#sukunimiboksi").show("slow");
  });
});
</script>

<div class="container">
    <div class="row">
     <!-- The Modal -->
  <div class="modal fade" id="myModal">
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
        <p class="otsikko">Kirjautuminen vaihe, B</p>
		 <h6 id="RespoIlmoitus">Arvoisa asiakkaamme! taataksemme parhaan käyttökokemuksen, pyydämme teitä ystävällisesti käyttämään tablet- tai tietokone laitetta</h6>
                <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 label"><br>Käyttäjätunnus</div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 input"><input type="username" id="kayttajatunnus" name="kayttajatunnus" value="<?php echo  $KayttajatunnusBVaihe; ?>" ></div>
                  <div class="container ErrorBox" style="margin-right:11.3em;margin-left:11.3em;margin-top:2px;margin-bottom:5px;width:70em;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo  $KayttajatunnusVaiheBCerr; ?></strong> 
                    </div>
                  </div>


                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 label"><br>Salasana  </div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 input"><input type="password" id="salasana" name="salasana"  ></div>

                  <div class="container ErrorBox" style="margin-right:11.3em;margin-left:11.3em;margin-top:2px;margin-bottom:5px;width:70em;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo  $salasanaErr; ?></strong> 
                    </div>
                  </div>
                </div>
            <br>
            <button  type="submit" name="kirjauduB" id="kirjauduB" class="Muokkaa btn btn-outline-primary text" style="outline:none;">Kirjaudu</button>
            </form>
            <br>
                <p class="KirjauduTeksti">Jos sinulla ei ole tunnuksia, Rekisteröidy<a href ="RekisteroidyVaiheB.php"> tästä</a></p>
                <p class="KirjauduTeksti">Kirjaudu C-vaiheseen<a style="color:green;" href ="KirjauduVaiheC.php"> tästä</a></p>
                <p class="KirjauduTeksti" style="font-size:15px;">Jos olet unohtanut salsanan, tilaa uusi <a href ="NollaaSalasanaB.php"> tästä</a></p>
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