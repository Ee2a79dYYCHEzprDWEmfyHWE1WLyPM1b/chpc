<?php session_start(); ?>
<?php 
include_once 'PHP - Funktiot/Connect.php';
$Loos_Sposti = $_SESSION['Sposti_2'];

error_reporting(0); 

$Kuittinumero = $_SESSION['Kuittinumero'];

$veroPROSENTTI = $_SESSION['VEROPROSENTTI'];
$Lisays_PVM = date('Y-m-d');
$Ahinta = $_SESSION['Ahinta'];

$Katsotaan_Onko_Kuponkia_Kaytetty = "SELECT Etukuponki,Asiakasnumero 
    FROM tbl_ostoskori WHERE KuittiNro = '$Kuittinumero' GROUP BY Etukuponki";
$result_Katsotaan_Onko_Kuponkia_Kaytetty = $conn->query($Katsotaan_Onko_Kuponkia_Kaytetty);
    
//Jos etukuponkia on käytetty
 if(isset($_POST['NaytaKuitti_Etukuponki']))
    {
        //Siirretään LukuoikeusTEIDOT OstoskoriTaulusta LukuoikeudetTauluun
        $SiirraLukuoikeusTiedot = "INSERT INTO tbl_lukuoikeudet (Asiakasnumero,Alkaa,Paattyy) 
        SELECT Asiakasnumero,Lukuoikeus_Alkaa,Lukuoikeus_Paattyy FROM tbl_ostoskori WHERE Aktiivinen_Lukuoikeus = 'EI' AND KuittiNro = '$Kuittinumero'";
        $SiirraLukuoikeusTiedot_kysely = mysqli_query($conn, $SiirraLukuoikeusTiedot) or die (mysqli_error($conn));
            if($SiirraLukuoikeusTiedot_kysely == 1)
                {
                    $HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA = "SELECT Asiakasnumero,Etukuponki,KuittiNro,Loppusumma,L_Ostaja,PVM FROM tbl_ostoskori WHERE KuittiNro = '$Kuittinumero'";
                    $result_HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA = $conn->query($HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA);
                        if ($result_HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA->num_rows > 0)
                            {
                                while($row = $result_HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA->fetch_assoc())
                                {
                                    $Asiakasnumero_Receipt =$row["Asiakasnumero"];
                                    $Kuitti_NRO_Receipt =$row["KuittiNro"];
                                    $LoppuSumma_Receipt =$row["Loppusumma"];
                                    $L_Ostaja_Receipt =$row["L_Ostaja"];
                                    $Paivays_Receipt =$row["PVM"];
                                    $Alekuponki_Receipt =$row["Etukuponki"];

                                    $Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA = "INSERT INTO tbl_kuitit 
                                    (Kuittinumero,Asiakasnumero,ValiSumma,LukuoikeudenOSTAJA,Kuponkinumero,Paivays,Vero_prosentti,A_hinta) 
                                    VALUES ('$Kuitti_NRO_Receipt','$Asiakasnumero_Receipt','$LoppuSumma_Receipt','$L_Ostaja_Receipt','$Alekuponki_Receipt','$Lisays_PVM','$veroPROSENTTI','$Ahinta')";
                                    $Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA_kysely = mysqli_query($conn, $Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA) or die (mysqli_error($conn));
                                    if($Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA_kysely == 1)
                                        {
                                            //Poistetaan Ei Lukuoikeuden ostajien kohdalta summa
                                            $Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta = "UPDATE tbl_kuitit SET ValiSumma = 'NULL' WHERE LukuoikeudenOSTAJA = 'EI'";
                                                        
                                            $Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta_kysely = mysqli_query($conn, $Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta) 
                                            or die (mysqli_error($conn));
                                            if($Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta_kysely == 1)
                                               {
                                                    //Poistetaan Etukuponki Muiden kuin Lostajan kohdalta
                                                    $Poista_KuponkiNumero_Ei_Lukuoikeuden_Ostajiilta = "UPDATE tbl_kuitit SET KuponkiNumero = 'NULL' WHERE LukuoikeudenOSTAJA = 'EI'";
                                                    $Poista_KuponkiNumero_Ei_Lukuoikeuden_Ostajiilta_kysely = mysqli_query($conn,$Poista_KuponkiNumero_Ei_Lukuoikeuden_Ostajiilta) or die (mysqli_error($conn));

                                                    if($Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta_kysely == 1)
                                                        {
                                                            $Tyhjenna_Ostokori = "DELETE FROM tbl_ostoskori WHERE KuittiNro = '$Kuitti_NRO_Receipt'";
                                                            $Tyhjenna_Ostokori_kysely = mysqli_query($conn, $Tyhjenna_Ostokori) or die (mysqli_error($conn));

                                                            if($Tyhjenna_Ostokori_kysely == 1)
                                                                {
                                                                    //Alustetaa Ostokori
                                                                    $Alusta_Ostokori = "ALTER TABLE tbl_ostoskori AUTO_INCREMENT = 1";
                                                                    $Alusta_Ostokori_kysely = mysqli_query($conn, $Alusta_Ostokori) or die (mysqli_error($conn));
                                                                    {
                                                                        echo "<script>location='KuittiPrinttaus.php'</script>";
                                                                    }

                                                                }
                                                        }
                                                }

                                        }
                                }
                            } 
                }
    } 
    else
    {

    }
 
//Jos etukuponkia ei ole käytetty
if(isset($_POST['NaytaKuitti_Ei_Etukuponki']))
    {
        //Siirretään LukuoikeusTEIDOT OstoskoriTaulusta LukuoikeudetTauluun
        $SiirraLukuoikeusTiedot = "INSERT INTO tbl_lukuoikeudet (Asiakasnumero,Alkaa,Paattyy) 
            SELECT Asiakasnumero,Lukuoikeus_Alkaa,Lukuoikeus_Paattyy FROM tbl_ostoskori WHERE Aktiivinen_Lukuoikeus = 'EI' AND KuittiNro = '$Kuittinumero'";
        $SiirraLukuoikeusTiedot_kysely = mysqli_query($conn, $SiirraLukuoikeusTiedot) or die (mysqli_error($conn));
                    
            if($SiirraLukuoikeusTiedot_kysely == 1)
                {
                    $HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA = "SELECT Asiakasnumero,KuittiNro,Loppusumma,L_Ostaja,PVM FROM tbl_ostoskori WHERE KuittiNro = '$Kuittinumero'";
                    $result_HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA = $conn->query($HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA);
                        if ($result_HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA->num_rows > 0) 
                            {
                                while($row = $result_HAETAAN_KUTTIEDTOT_OSTOSKORI_TAULUSTA->fetch_assoc()) 
                                    {
                                        $Asiakasnumero_Receipt =$row["Asiakasnumero"];
                                        $Kuitti_NRO_Receipt =$row["KuittiNro"];
                                        $LoppuSumma_Receipt =$row["Loppusumma"];
                                        $L_Ostaja_Receipt =$row["L_Ostaja"];
                                        $Paivays_Receipt =$row["PVM"];
                                                                    
                                        $Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA = "INSERT INTO tbl_kuitit (Kuittinumero,Asiakasnumero,ValiSumma,LukuoikeudenOSTAJA,Paivays,Vero_prosentti,A_hinta) 
                                            VALUES ('$Kuitti_NRO_Receipt','$Asiakasnumero_Receipt','$LoppuSumma_Receipt','$L_Ostaja_Receipt','$Lisays_PVM','$veroPROSENTTI','$Ahinta')";
                                                
                                        $Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA_kysely = mysqli_query($conn, $Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA) 
                                        or die (mysqli_error($conn));
                                                    
                                        if($Lisataan_KUTTIEDTOT_OSTOSKORI_TAULUSTA_kysely == 1)
                                            {
                                                //Poistetaan Ei Lukuoikeuden ostajien kohdalta summa
                                                $Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta = "UPDATE tbl_kuitit SET ValiSumma = 'NULL'WHERE LukuoikeudenOSTAJA = 'EI'";
                                                $Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta_kysely = mysqli_query($conn, $Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta) 
                                                or die (mysqli_error($conn));
                                                    if($Poista_valisumma_Ei_Lukuoikeuden_Ostajiilta_kysely == 1)
                                                        {
                                                            $Tyhjenna_Ostokori = "DELETE FROM tbl_ostoskori WHERE KuittiNro = '$Kuitti_NRO_Receipt'";
                                                            $Tyhjenna_Ostokori_kysely = mysqli_query($conn, $Tyhjenna_Ostokori) or die (mysqli_error($conn));
                                                                
                                                                if($Tyhjenna_Ostokori_kysely == 1)
                                                                    {
                                                                        //Alustetaa Ostokori
                                                                        $Alusta_Ostokori = "ALTER TABLE tbl_ostoskori AUTO_INCREMENT = 1";    
                                                                        $Alusta_Ostokori_kysely = mysqli_query($conn, $Alusta_Ostokori) or die (mysqli_error($conn));     
                                                                            {
                                                                                echo "<script>location='KuittiPrinttaus_EiAlekkuponkia.php'</script>";
                                                                            }
                                                                    }     
                                                        }
                                            }
                                    }       
                            }
                    }
    }
    else
    {

    } 
 

?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Maksun Vahvistus</title>
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
.container>.row > .body
{
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
}
     
.container > .row > .header > .container > .row >.Logo a{
    text-decoration:none;
}
.vahvistusboksi{
    height:100%;
    width:100%;
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

.btn-success
{
    width: 100%;
    height: 70px;
    border-radius: 0px;
    text-transform: uppercase;
    font-size: 25px;
    font-weight: bold;
    letter-spacing: 5px;
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
      <i class="fas fa-check-circle"></i>
      <h1 class="otsikko" style="font-size:35px;color:#28a745;">Onneksi Olkoon</h1><br>   
<div class="vahvistusboksi">
    <p>maksu on suoritettu onnistuneesti </p>
        <h5>Voit siirtyä nyt 'Näytä kuitti'- painikkeesta kuitit väililehdelle sekä luoda ja tulosta ALV-eriteltyn PDF- kuitin yrityksenne kirjanpitoa varten</h5>
    <br>
</div>

<?php 
if ($result_Katsotaan_Onko_Kuponkia_Kaytetty->num_rows > 0) 
    {
        while($row = $result_Katsotaan_Onko_Kuponkia_Kaytetty->fetch_assoc()) 
            {
                $KUPONKI_TILA =$row["Etukuponki"];

                if($KUPONKI_TILA !==NULL)
                    {
                        echo "<form method='POST'>";
                        echo "<button type='submit' name='NaytaKuitti_Etukuponki' class='btn btn-success'>Näytä Kuitti</button>";
                        echo "</form>";
                    }
                else
                    {
                        echo "<form method='POST'>";
                        echo "<button type='submit' name='NaytaKuitti_Ei_Etukuponki' class='btn btn-success'>Näytä Kuitti</button>";
                        echo "</form>";
                    }

            }
    }

?>
</form>
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
