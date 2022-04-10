<?php session_start(); ?>
<?php

include_once 'PHP - Funktiot/Connect.php';




$ANRO = $_GET['AN'];

$HAEASIAKKAANNIMI = "SELECT Etunimi,Sukunimi,Asiakasnumero FROM tbl_ostoskori WHERE Asiakasnumero = '$ANRO'";
$result_HAEASIAKKAANNIMI = $conn->query($HAEASIAKKAANNIMI);

if(mysqli_num_rows($result_HAEASIAKKAANNIMI)==1)
    {
        while($row = $result_HAEASIAKKAANNIMI->fetch_assoc())
            {
                $Enimi =$row["Etunimi"];
                $Snimi =$row["Sukunimi"];
                $Asiakasnumero =$row["Asiakasnumero"];
            }
    }

if(isset($_POST['POISTA_Henkilo_ostoskorista']))
    {
        //Poistetaan ostoskorista
        $Poista_Asiakas_Ostoskorista = "DELETE FROM tbl_ostoskori WHERE Asiakasnumero = '$Asiakasnumero'";
        $Alusta_Ostokori_kysely_AJO = mysqli_query($conn, $Poista_Asiakas_Ostoskorista) or die (mysqli_error($conn));
        if($Alusta_Ostokori_kysely_AJO == 1)
            {
                
                echo "<script>location='Ostoskori.php'</script>";
            }
    }






if(isset($_POST['POISTA_Henkilo_jarjestelmasta']))
    {
         //Kytketään viiteavaimen tarkistus pois
        $ViitAvainTarkistusOFF = "SET FOREIGN_KEY_CHECKS=0";
        $ViitAvainTarkistusKyselyAjo  = mysqli_query($conn,$ViitAvainTarkistusOFF);
        
        if($ViiteAvaimenTarkistusKysel = 1)
            {
              //Poistetaan koko asiakasta Asiakkaat taulusta
              $PoistaHenkilöAsiakkaatTaulusta = "DELETE FROM tbl_asiakkaat WHERE Asiakasnumero = '$Asiakasnumero'";
              $PoistaHenkilöAsiakkaatTaulustaKyselyAjo  = mysqli_query($conn,$PoistaHenkilöAsiakkaatTaulusta);
                if($PoistaHenkilöAsiakkaatTaulustaKyselyAjo = 1)
                    {
                        //Poistetaan asiakkaan käyttäjätunnusta
                        $PoistaHenkilöKayttajatunnusTaulusta = "DELETE FROM tbl_kayttajatunnus_c WHERE Asiakasnumero = '$Asiakasnumero'";
                        $PoistaHenkilöKayttajatunnusTaulustaKyselyAjo  = mysqli_query($conn,$PoistaHenkilöKayttajatunnusTaulusta);
                        if($PoistaHenkilöKayttajatunnusTaulustaKyselyAjo = 1)
                            {
                                //$HaeHenkilonKirjautumisHistoria
                                $PoistaHenkilöKirjautumisetTaulusta = "DELETE FROM tbl_kirjautumiset_c WHERE Kayttajatunnus_ID = '$Kayttajatunnus_ID'";
                                $PoistaHenkilöKirjautumisetTaulustaKyselyAjo = mysqli_query($conn,$PoistaHenkilöKirjautumisetTaulusta);
                                if($PoistaHenkilöKirjautumisetTaulustaKyselyAjo = 1)
                                    {
                                       //Poistetaan ostoskorista
                                        $Poista_Asiakas_Ostoskorista = "DELETE FROM tbl_ostoskori WHERE Asiakasnumero = '$Asiakasnumero'";
                                        $Alusta_Ostokori_kysely_AJO = mysqli_query($conn, $Poista_Asiakas_Ostoskorista) or die (mysqli_error($conn));
                                        if($Alusta_Ostokori_kysely_AJO == 1)
                                            {
                                                
                                                echo "<script>location='Ostoskori.php'</script>";
                                            } 
                                    }
                            }
                    }
            }

    }



?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Asiakkaan poistaminen</title>
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

.data
{
    margin-left: 1em;
    margin-right: 1em;
    height:5em;
    margin-bottom: 1em;
}
.col-sm-6
{
    text-align: center;
    font-size: 30px;
    margin-top: 15px;
}

.btn-outline-danger
{
    width: 100%;
    margin-top:5px;
    margin-bottom:10px;
    height: 3.5em;
    font-size: 25px;
    text-transform: uppercase;
    border-radius: 0% 0%;
    letter-spacing: 5px;
}
.alert-warning
{
    border-radius: 0% 0%;
    color:black;
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
      <p class="otsikko">henkilön poistaminen</p>

        

      <p class="otsikko" style="font-size:18px">
      <div class="alert alert-warning" style="text-align: center;font-size:20px;">
        Olet poistamassa seuraavan henkilön. <br>Painamalla 'Poista henkilö ostoskorista'- painiketta poistetaan asiakas ostokorista
        </div>
      
    <div class="container-fluid">
        <div class="row data">
            <div class="col-sm-6" >Asiakasnumero</div>
            <div class="col-sm-6" style="text-align: left;"><?php echo $ANRO; ?></div>
        </div>
        <div class="row data">
            <div class="col-sm-6" >Nimi</div>
            <div class="col-sm-6" style="text-align: left;"><?php echo $Enimi." ".$Snimi; ?> </div>
        </div>
    </div>
    <form method="POST">
        <button type="submit" name="POISTA_Henkilo_ostoskorista" class="btn btn-outline-danger">Poista henkilö ostoskorista</button>
        <button type="submit" name="POISTA_Henkilo_jarjestelmasta" class="btn btn-outline-danger">Poista henkilö järjestelmästä</button>
    </form>
    


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
