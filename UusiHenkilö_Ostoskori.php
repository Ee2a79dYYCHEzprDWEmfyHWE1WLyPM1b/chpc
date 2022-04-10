<?php session_start(); ?>

<?php
include_once 'PHP - Funktiot/ADMIN_LISAA_YRITYS_FORMVALIDATION.php';
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/Connect.php';
error_reporting(0);

$Anro = $_SESSION['anro'];
$KuittiNro_1 = $_SESSION['K_Nro'];
$Loppusumma = $_SESSION['MAKSETTAVAsumma'];
$Ahinta = $_SESSION['Ahinta'];


//Haetaan yritys
    $HaeYritykset="SELECT 
      tbl_asiakkaat.Asiakasnumero,
      tbl_asiakkaat.Etunimi,
      tbl_asiakkaat.Sukunimi 
        FROM tbl_asiakkaat 
      INNER JOIN tbl_yritykset ON tbl_asiakkaat.Y_tunnus = tbl_yritykset.Y_tunnus 
      INNER JOIN tbl_lukuoikeudet ON tbl_lukuoikeudet.Asiakasnumero = tbl_asiakkaat.Asiakasnumero 
        WHERE tbl_lukuoikeudet.Tila = 'EiVoimassa' GROUP BY tbl_asiakkaat.Asiakasnumero";

$HaeYritykset_result=mysqli_query($conn,$HaeYritykset);



if(isset($_POST['LisaaUusiTyontekija']))
{
    
    $Y_Tunnus_1 = mysqli_real_escape_string($conn,$_POST['Y_tunnus']);
    $Y_Tunnus_1_MUOKATTU = substr($Y_Tunnus_1,-7);
  
    //Hae asiakkaan tiedot 
    $HAE_ASIAKASTIEDOT = "SELECT Asiakasnumero, Etunimi, Sukunimi FROM tbl_asiakkaat WHERE Asiakasnumero = '$Y_Tunnus_1_MUOKATTU'";
    $HAE_ASIAKASTIEDOT_result=mysqli_query($conn,$HAE_ASIAKASTIEDOT);

    if($HAE_ASIAKASTIEDOT_result > 0)
    {
        while($Rivi_Tieto =mysqli_fetch_assoc($HAE_ASIAKASTIEDOT_result))
        {
          $Anro_Lisattava_Ostoskoriin = $Rivi_Tieto['Asiakasnumero'];
          $Enimi_Lisattava_Ostoskoriin = $Rivi_Tieto['Etunimi'];
          $Snimi_Lisattava_Ostoskoriin = $Rivi_Tieto['Sukunimi'];

        }
    }


    //Viiteavaimen tarkistus pois
    $ViiteAvaimenTarkistusPOIS = "SET FOREIGN_KEY_CHECKS = 0";
    $ViiteAvaimenTarkistusPOIS_kysely = mysqli_query($conn, $ViiteAvaimenTarkistusPOIS) or die (mysqli_error($conn));
      if($ViiteAvaimenTarkistusPOIS_kysely > 0)
          {
              //Lisaa Ostoskoriin
              $Lisaa_Ostoskoriin = "INSERT INTO tbl_ostoskori (Asiakasnumero,Etunimi,Sukunimi,KuittiNro) VALUES ('$Anro_Lisattava_Ostoskoriin','$Enimi_Lisattava_Ostoskoriin','$Snimi_Lisattava_Ostoskoriin','$KuittiNro_1')";
              $Lisaa_Ostoskoriin_kysely = mysqli_query($conn, $Lisaa_Ostoskoriin) or die (mysqli_error($conn));
                if($Lisaa_Ostoskoriin_kysely == 1)
                  {
                    echo "<script>location='Ostoskori.php'</script>";
                     
                  }
          }


          $Muokkaa_KUITIN_HINTA_TIEDOT = "UPDATE tbl_ostoskori SET Loppusumma='$Loppusumma',A_hinta='$Ahinta' WHERE KuittiNro = '$KuittiNro_1'";

          $Muokkaa_KUITIN_HINTA_TIEDOT_Tulos = $conn->query($Muokkaa_KUITIN_HINTA_TIEDOT);
            if ($Muokkaa_KUITIN_HINTA_TIEDOT_Tulos->num_rows > 0) 
              {
               
              }

                





}


$conn->close();
?>


<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC - LISÄÄ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link rel="stylesheet" href="TyyliTiedostot/ADMIN_Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">




<div class="container">
    <div class="row">
        <div class="col-xl header" style="height:5em;">
            <div class="container">
                <div class="row">
                    <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-4 Logo ">
                        <span style="color:RGB(244,160,0);">Tuottavuus</span>
                        <span style="color:RGB(15,157,88);">klinikat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
      <div class="col-xl body">
  <div id="ETUSIVU" class="tabcontent">

</head>
<style>

.nav
  {
  list-style-type: none;
  display: -webkit-inline-flex;
  width:100%;
  margin-left: 10em;
  }
  
 .sub-menu
 {
  display: none;
  position: absolute;
  list-style-type: none;
  margin-left: -2.5em;
  margin-top:-5px;
 }
</style>
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}

?>
<body>
<h3>lisää uusi asiakas</h3>


<form class="YritysLOMAKE" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  

<!--Valitse Yritys-->
<div class="container">
  <div class="row" style="margin-left: 4.2em;margin-right: 5.6em;">
    <h7 style="width:100%;margin-bottom: -10px;text-transform: uppercase;font-weight: bold;color:gray;text-align: center;">Valitse lisättävä henkilö</h7>
    <div class="col-sm-12" style="margin-top: 1em;">
      <select class="form-control" style="font-weight:bold;outline:none;width: 100%;height:4em; text-transform: uppercase;" id="Y_Tunnus" 
      name='Y_tunnus' >
          <option style="font-size:20px;font-weight:bold;">Valitse tästä lisättävä henkilö</option>

          <?php
              if($HaeYritykset_result > 0){
                
                  while($row =mysqli_fetch_assoc($HaeYritykset_result)){
                    $Asiakasnumero = $row['Asiakasnumero'];
                    $Etunimi = $row['Etunimi'];
                    $Sukunimi = $row['Sukunimi'];


                    echo "<option style='font-size:21px;color:gray;space-between:5px;'>";
                    echo $Etunimi." ".$Sukunimi." ".$Asiakasnumero;
                    echo "</option>";
                  }
                }
            ?>
      </select>
    </div>
  </div>
   <div class="row" style="margin-left: 4.2em;margin-right: 5.6em;margin-top: -1em;">
    <div class="col-sm-12" style="margin-top: 1em;">
      <span class="error" style="color:#FF0000;"><?php echo $Y_TunnusErr; ?></span>
    </div>
  </div>
</div>


<!--submit painike-->
<div class="container">
  <div class="row" style="margin-left: 7em;margin-right: 5.6em;">
    <div class="col-sm-12" style="margin-top:3em;">
      <button class="button button3 submit" type="submit"  
      name="LisaaUusiTyontekija">tallenna</button>
    </div>
  </div>
</div>
</form>

<br>
<body>
  

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
