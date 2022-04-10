
<?php session_start(); ?>
<?php
include_once '../PHP - Funktiot/Connect.php';

error_reporting(0);

if(!isset($_SESSION['Kayttajatunnus'])){
    echo "Olet Jo kirjautunut ulos";
      header('Location:../KirjauduVaiheB.php');
}


$KayttajaTunnus = $_SESSION['Kayttajatunnus'];

$Ytunnus = $_SESSION['YritysTunnus'];
$Ytnnus_GET = $_GET['Ytunnus'];
$Ytnnus_GET_EI = $_GET['Ytunnus_EI'];





$sql = "SELECT tbl_asiakkaat.Etunimi, tbl_asiakkaat.Sukunimi,tbl_kayttajatunnus.Rooli
FROM tbl_asiakkaat INNER JOIN tbl_kayttajatunnus ON tbl_kayttajatunnus.Asiakasnumero=tbl_asiakkaat.Asiakasnumero WHERE tbl_kayttajatunnus.Kayttajatunnus = '$KayttajaTunnus' AND tbl_kayttajatunnus.Rooli = 'Admin'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $etunimi = $row["Etunimi"];
        $sukunimi =$row["Sukunimi"];
        $Rooli = $row["Rooli"];
    }
} else {

}

//Haetaan yritysTietoja
$Haetaan_yritysTietoja = "SELECT Y_tunnus,YrityksNimi,Liiketoimintaryhma,Liiketoimintayksikko,Osoite,PostiNro,PostiTmiPaikka,Rakennusliike FROM tbl_yritykset WHERE Y_tunnus = '$Ytunnus' OR Y_tunnus = '$Ytnnus_GET' OR Y_tunnus = '$Ytnnus_GET_EI'";
$Haetaan_yritysTietoja_Tulos = $conn->query($Haetaan_yritysTietoja);

if ($Haetaan_yritysTietoja_Tulos->num_rows > 0) {
    // output data of each row
    while($row = $Haetaan_yritysTietoja_Tulos->fetch_assoc()) {
        $Y_tunnus = $row["Y_tunnus"];
        $YrityksenNimi =$row["YrityksNimi"];
        $Liiketoimintaryhma = $row["Liiketoimintaryhma"];
        $Liiketoimintayksikko = $row["Liiketoimintayksikko"];
        $Osoite =$row["Osoite"];
        $PostiNro = $row["PostiNro"];
        $PostiTmiPaikka = $row["PostiTmiPaikka"];
        $Rakennusliike =$row["Rakennusliike"];
    }
} else {

}

//Lasketaan yrityken Henkilöstö lukumäärä
$Lasketaan_Henkilöstöä = "SELECT count(Asiakasnumero) AS Hlkm FROM tbl_asiakkaat WHERE Y_tunnus = '$Ytunnus' OR Y_tunnus = '$Ytnnus_GET' OR Y_tunnus = '$Ytnnus_GET_EI'";
$Lasketaan_Henkilöstöä_Tulos = $conn->query($Lasketaan_Henkilöstöä);

if ($Lasketaan_Henkilöstöä_Tulos->num_rows > 0) {
    // output data of each row
    while($row = $Lasketaan_Henkilöstöä_Tulos->fetch_assoc()) {
        $LKM = $row["Hlkm"];
        
    }
} else {

}

//Haetaan yrityksen työntekijöitä
$Haetaan_TyöntekijäTietoja = "SELECT Asiakasnumero,Etunimi,Sukunimi,Titteli FROM 
	tbl_asiakkaat WHERE Y_tunnus = '$Ytunnus' OR Y_tunnus = '$Ytnnus_GET' OR Y_tunnus = '$Ytnnus_GET_EI'";
$Haetaan_TyöntekijäTietoja_Tulos = $conn->query($Haetaan_TyöntekijäTietoja);





?>


<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC - näytä</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../TyyliTiedostot/Style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <body class="w3-container w3-auto">

<style>
body
  {
  background-color:white;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
   }
.container>.row > .body
  {
  height:100%;
  }
.container > .row > .header > .container > .row >.Logo a
  {
  text-decoration:none;
  }
.header >.container >.row >.Logo span
  {
  text-align: center;
  font-size: 20px;
  text-transform: uppercase;
  font-weight: 700;
  letter-spacing: 5px;
  padding-top:15px;
  }
.header >.container >.row >.Logo
  {
  margin-top:15px;
  text-align: left;
  }
.row > .Logo > a > .btn-outline-dark:hover
  {
  background-color: rgba(166,241,166,0.0);
  color:black;
  outline:none;
  }
.tabcontent h3
  {
  text-transform: uppercase;
  margin-top: 15px;
  margin-left: 0.6em;
  font-weight: bold;
  font-size: 2.5em;
  text-align: center;
  }
.menu
  {
    padding:0;
    margin-top: 0;
  }
.nav
    {
    list-style-type: none;
    display: -webkit-inline-flex;
    width:100%;
    margin-left: 10em;
    }
    .nav .active{
      font-weight: bold;
      letter-spacing: 2px;
    }
.nav li
   {
    text-align: center;
    height:50px;
    background: rgb(135,206,250,1);
    line-height: 50px;
    margin-top: 5px;
    width:185px;
    font-weight: normal;
   }
.nav li a
   {
    color: black;
    font-size: 15px;
    text-decoration: none;
   }
.sub-menu
 {
  display: none;
  position: absolute;
  list-style-type: none;
  margin-left: -2.5em;
  margin-top:-5px;
 }
.nav li:hover .sub-menu
   {
     display: block;
    background-color: rgb(135,206,250,1);
    width:225px;
    z-index:50;
   }
.nav li:hover .sub-menu li a
   {
    margin-right: 35px;
    text-align: center;
   }
.nav li:hover{
    background: rgb(135,206,250,1);
    font-weight: bold;
    cursor: pointer;
   }
.sub-sub-menu
  {
    display: none;
    list-style-type: none;
    margin-left: 9.4em;
    margin-top:-3.4em;
  }
.sub-menu li:hover .sub-sub-menu
   {
    display: block;
     background-color: rgb(135,206,250,1);
     width:250px;
     margin-left: 185px;
   }
.body > .Painikkeet >a button
  {
    height:50px;
    width:250px;
    text-align:center;
    margin-left:28em;
    text-transform:uppercase;
    letter-spacing:5px;
    font-weight:600;
    /*background-color:rgb(135,206,250,0.1);*/
  }
.Painikkeet
  {
      display:flex;
  }
.button3 
  {
  background-color: transparent; 
  color: red; 
  border: 2px solid #f44336;
  width:100px;
  font-size: 20px;
  text-transform: uppercase;
  position: absolute;
  top:105px;
  right:21em;
  }

.button3:hover 
  {
  border: 2px solid #f44336;
  color: red;
  font-weight:600;
  }
  .vaiheOtsikko
  {
    text-transform: uppercase;
    margin-bottom: 10px;
    color: blue;
    font-size: 21.5px;
  }
  
  table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
	background-color: rgb(135,206,250,1);
}
#Henkilöstö td a:hover {
    cursor: pointer;
    text-decoration: none;
    font-weight: bold;
    color: black;
}

</style>


<div class="container">
    <div class="row">
        <div class="col-xl header" style="height:5em;">
            <div class="container">
                <div class="row">
                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-4 Logo ">
                        <span style="color:RGB(244,160,0);">Tuottavuus</span>
                        <span style="color:RGB(15,157,88);">klinikat</span>
                    </div>
                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-6">
                    <div class="" style="padding-top:1.4em;text-align:right;">
                        <p class="otsikko rooli" style="text-align:center;">Tervetuloa, <?php echo "<strong>".$etunimi." ".$sukunimi." </strong>(".$Rooli.")"; ?></p>
                    </div>
                    </div>
                    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 Logo ">
                    <a href="../KirjauduUlos.php" ><button class="Muokkaa btn btn-outline-dark" style="width:12em;margin-left:-2em;">KIRJAUDU ULOS <i class="fas fa-sign-out-alt" style="margin-left:10px;"></i></button></a>
                    </div>
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
  <div id="ETUSIVU" class="tabcontent">

    <div class="menu">
      <ul class="nav">
                        <li><a href="ADMIN_Index.php">ETUSIVU</a></li>
                        <li><a href="#">NÄYTÄ</a>
                            <ul class="sub-menu">
                                <li><a href="#">ASIAKKAAT</a>
                                    <ul class="sub-sub-menu">
                                      <li><a href="ADMIN_Nayta_Asiakkaat.php">HENKILÖT</a></li>
                                      <li><a href="ADMIN_Nayta_Yritykset.php">YRITYKSET</a></li>
                                    </ul>
                                </li>
                                <li><a href="ADMIN_Nayta_Artikkelit.php">ARTIKKELIT</a></li>
                                <li><a href="ADMIN_Nayta_Etukupongit.php">ETUKUPONGIT</a></li>
                                <li><a href="ADMIN_Nayta_Lukuoikeudet.php">LUKUOIKEUDET</a></li>
                                <li><a href="ADMIN_Nayta_Uutiskirjeet.php">UUTISKIRJEET</a></li>
                                <li><a href="ADMIN_Nayta_UutiskirjeenTilaajat.php">UUTISKIRJETILAAJAT</a></li>
                                <li><a href="ADMIN_Nayta_Lauseet.php">LAUSEET</a></li>
                                <li><a href="ADMIN_Nayta_Kuitit.php">KUITIT</a></li>
                                <li><a href="ADMIN_Nayta_Lukuoikeus_Hinta.php">LUKUOIKEUSHINTA</a></li>
                            </ul>
                        </li>
                        <li><a href="#">LISÄÄ</a>
                            <ul class="sub-menu">
                                <li><a href="ADMIN_Lisaa_Yritys.php">UUSI YRITYS</a></li>
                                <li><a href="ADMIN_Lisaa_Asiakas.php">UUSI ASIAKAS</a></li>
                                <li><a href="ADMIN_Lisaa_Etukuponki.php">UUSI ETUKUPONKI</a></li>
                                <li><a href="ADMIN_Lisaa_Uutiskirje.php">UUSI UUTISKIRJE</a></li>
                                <li><a href="ADMIN_Lisaa_Uutiskirjeentilaajia.php">UUTISKIRJEENTILAAJA</a></li>
                            </ul>
                        </li>
                        <li><a href="#">RAPORTIT</a>
                            <ul class="sub-menu">
                              <li><a href="ADMIN_RAPORTIT_MYYNTIRAPORTTI.php">MYYNTI</a></li>
                              <li><a href="ADMIN_RAPORTIT_KIRJAUTUMINEN.php">KIRJAUTUMISRAPORTTI</a></li>
                              <li><a href="ADMIN_RAPORTIT_VUOROKAUSIRAPORTTI.php">VUOROKAUSI</a></li>
                              <li><a href="ADMIN_RAPORTIT_KUUKAUSIRAPORTTI.php">KUUKAUSI</a></li>
                              <li><a href="ADMIN_RAPORTIT_VUOSIRAPORTTI.php">VUOSI</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

<div class="col-xl body">
    <p class="otsikko">Yritysprofiili</p>
<br>
    <h2 class="vaiheOtsikko">Yrityksen tiedot</h2>
        <div class="row asiakasTiedot">
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Y-tunnus
            </div>
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:7px;font-weight: bold;"><?php echo $Y_tunnus; ?>
            </div>
        </div>
        <div class="row asiakasTiedot">
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">yrityksen nimi
            </div>
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;font-weight: bold;"><?php echo $YrityksenNimi; ?>
        	</div>
        </div>
            <div class="row asiakasTiedot">
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Liiketoimintaryhmä
                </div>
                <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;font-weight: bold;"><?php echo $Liiketoimintaryhma; ?>
                </div>
        </div>
        <div class="row asiakasTiedot">
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Liiketoimintayksikkö
            </div>
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;font-weight: bold;">
                  <?php echo $Liiketoimintayksikko; ?>
            </div>
        </div>
        <div class="row asiakasTiedot">
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Osoite
            </div>
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;font-weight: bold;">
                  <?php echo $Osoite; ?>
            </div>
        </div>
        <div class="row asiakasTiedot">
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Postinumero
            </div>
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;font-weight: bold;">
                  <?php echo $PostiNro; ?>
            </div>
        </div>
		<div class="row asiakasTiedot">
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Postitoimipaikka
            </div>
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;font-weight: bold;">
                  <?php echo $PostiTmiPaikka; ?>
            </div>
        </div>
        <div class="row asiakasTiedot">
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Rakennusliike
            </div>
            <div class="col-sm-3 col-md-6 col-lg-4 col-xl-7 data" style="padding-left:0.6rem;font-weight: bold;">
                  <?php 
                  	if($Rakennusliike == 'KYLLA')
	                  	{
	                  		$Rakennusliike_EI_Kylla = "KYLLÄ";	
	                  	}
                    else
                        {
                            $Rakennusliike_EI_Kylla = "EI";
                        }


                  echo $Rakennusliike_EI_Kylla; ?>
            </div>
        </div>	
<br><br>
<h2 class="vaiheOtsikko">henkilöstötiedot</h2>
<div class="row asiakasTiedot">
    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">Henkilöstölukumäärä
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-7 data" style="padding-left:7px;font-weight: bold;"><?php echo $LKM."&nbsp;&nbsp;Henkilö (ä)"; ?>
     </div>
</div>
<br><br>
<div class="row asiakasTiedot">
    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-5 otsikko" style="padding-left:1em;text-transform: uppercase;">yrityksessä työskentelevät henkilöt
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-7 data" style="padding-left:7px;font-weight: bold;">
    </div>
</div>

<div class="row asiakasTiedot">
 <div class="col-sm-4 col-md-4 col-lg-4 col-xl-10 otsikko" style="padding-left:1em;text-transform: uppercase;">
    	<div style="overflow-x:auto;margin-top: 1em;">
<table id="Henkilöstö">
    <tr style="border-bottom:2px solid black;text-transform: uppercase;">
      <th>Asiakasnumero</th>
      <th style="padding-right: 13em;">Nimi</th>
      <th style="padding-right: 4em;">Titteli</th>
    </tr>
    

<?php 
	if ($Haetaan_TyöntekijäTietoja_Tulos->num_rows > 0) 
  {
		// output data of each row
		while($row = $Haetaan_TyöntekijäTietoja_Tulos->fetch_assoc()) 
      {
        $Asiakasnumero = $row["Asiakasnumero"];
        $Etunimi =$row["Etunimi"];
        $Sukunimi = $row["Sukunimi"];
        $Titteli = $row["Titteli"]; 
		    echo "
		    <tr>
		      <td><a href='ADMIN_AsiakasprofiiliC.php?ASIAKASNUMERO_C=$row[Asiakasnumero]'>$Asiakasnumero</a></td>
		      <td>$Etunimi $Sukunimi</td>
		      <td>$Titteli</td>
			  </tr>";
		  }    
	} 
	else 
  {
        
	}


    ?>
    



</table>
</div>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-2 data" style="padding-left:7px;font-weight: bold;">
    </div>
</div>
<script type="text/javascript">
	
	$(document).ready(function() {

    $('#Henkilöstö tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });

});
</script>





<br><br><br><br>           
<div class="Painikkeet">
    <a href="ADMIN_Muokkaa_AsiakasTiedot_B.php" >
    <button class="Muokkaa MuokkaaB btn btn-outline-primary" style="width:21em;margin-left:9em;" id="show">Muokkaa tietoja 
   	<i class="fas fa-user-edit" style="margin-left:15px;"></i>
   	</button>
	</a>
    
    <a href="ADMIN_AsiakasprofiiliB_POISTA.php" >
    <button class="Muokkaa MuokkaaB btn btn-outline-danger" style="width:21em;margin-left:5em;">POISTA ASIAKAS 
    <i class="far fa-trash-alt" style="margin-left:15px;font-size:17px;"></i>
	</button>
	</a>
              
 </div>

      </div>
<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<style type="text/css">
  
.form-group label
  {
    margin-left: 1em;
    text-transform: uppercase;
    font-size: 20px;
    text-align:  center;
  }
  .form-group input
  {
    height:55px;
    font-weight: bold;
    font-size: 25px;
    text-align: center;
  }
</style>




        <BR><BR>
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
</html>
