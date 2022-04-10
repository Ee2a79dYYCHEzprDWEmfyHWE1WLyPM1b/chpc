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
  <title>CHPC- Uutiskirjeentilauksen peruuttaminen</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">	
 
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
    outline:none;
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
    margin-left:50em;
    margin-top:-30px;
}

.container > .row > .header > .container > .row > ul li{
    list-style:none;
    display:inline-block;
    text-transform:uppercase;
    padding-left:5px;
    padding-right:5px;
    font-size:25px;
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
  .body > .Muokkaa:hover
    {
      background-color:rgba(135,206,250,0.5);
    }
    .text{
      background-color:#0275d8;
      opacity:1;
    }
    .text:hover{
      color:#0275d8;
      box-shadow:0 0 2px #0275d8, 0 0 2px #0275d8;
    }
  </style>
<?php

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"]; 
    }
}


if(isset($_POST['PeruutaUutiskirjeenTilaus'])) {
      
  $Etunimi = mysqli_real_escape_string($conn,$_POST['Etunimi']);
  $Sukunimi = mysqli_real_escape_string($conn,$_POST['Sukunimi']);
  $Sposti = mysqli_real_escape_string($conn,$_POST['Sposti']);
  

    if((empty($_POST['Etunimi'])) || (empty($_POST['Sukunimi'])) || (empty($_POST['Sposti'])))
      {
        // Virheilmoitukset tulostetaan lomakkeen jokaisen syöttökentän alapuolelle
      }
    else
    {
      $user_check_query = "SELECT Etunimi,Sukunimi,Sposti FROM tbl_uutiskirjeentilaajat";
      $result = mysqli_query($conn, $user_check_query);
      $user = mysqli_fetch_assoc($result);
          if (!$user) 
            { // if user exists
                  if (($user['Etunimi'] === $Etunimi) || ($user['Sukunimi'] === $Sukunimi) || ($user['Sposti'] === $Sposti)) 
                  {
                    header("Location:UutiskirjeenTilauksenPeruutusError.php");
                    $_SESSION['Fname'] = $Etunimi;
                    $_SESSION['Lname'] = $Sukunimi;
                    $_SESSION['Email'] = $Sposti;
                  }
            }else
              {
                $PeruutaUutiskirjeenTilaus ="DELETE FROM tbl_uutiskirjeentilaajat WHERE Etunimi = '$Sukunimi' OR Sukunimi = '$Sukunimi' OR Sposti = '$Sposti'";
                $PeruutaUutiskirjeenTilausKysely = mysqli_query($conn, $PeruutaUutiskirjeenTilaus) or die (mysqli_error($conn));
                    if($PeruutaUutiskirjeenTilausKysely==1)
                        {         
                          header("Location:UutiskirjeenTilauksenPeruutusVahvistus.php");
                          $_SESSION['Sposti'] = $Sposti;
                        }
                        else{
                          echo "<script>alert('TEKNINEN VIKA, UUTISKIRJEEN TILAUS EPÄONNISTUI!');</script>";
                        }
              } 
    }    
}

?>

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
                            <li><a href="#" class="avaa_1" data-toggle="modal" data-target="#myModal_2" >Missio</a></li>
                            <li><a href="Ostoskori.php">Ostoskori</a></li>
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
<?php 
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<style>
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
</style>
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
        <p class="otsikko">Uutiskirjeentilauksen peruutus</p>

        
                <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="row">
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 label">Etunimi</div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 input"><input type="text" id="Etunimi" name="Etunimi" ></div>
                  <div class="container ErrorBox" style="margin-right:11.3em;margin-left:11.3em;margin-top:2px;margin-bottom:5px;width:70em;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo  $etunimiErr; ?></strong> 
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 label"><br>Sukunimi</div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 input"><input type="text" id="Sukunimi" name="Sukunimi" ></div>
                  <div class="container ErrorBox" style="margin-right:11.3em;margin-left:11.3em;margin-top:2px;margin-bottom:5px;width:70em;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo  $sukunimiErr; ?></strong> 
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 label"><br>Sähköpostiosoite</div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 input"><input type="email" id="Sposti" name="Sposti" ></div>
                  <div class="container ErrorBox" style="margin-right:11.3em;margin-left:11.3em;margin-top:2px;margin-bottom:5px;width:70em;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo  $SpostiErr; ?></strong> 
                    </div>
                  </div>
                 
                </div>
            <br>
            <button  type="submit" name="PeruutaUutiskirjeenTilaus" id="Kirjaudu" class="Muokkaa btn btn-outline-primary text" style="outline:none;">Peru tilaus</button>
            </form>
            
            
            <div class="container Tietoja">
                <div class="row">
              
                <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 teksti">
					<?php 
						if($resultCheck > 0){
							while($row=mysqli_fetch_assoc($result_9)){
							 echo $row['Lause'];
							}
			  			}
					?>
					</div>
                
                </div>
            </div>

<p class="avaa" data-toggle="modal" data-target="#myModal"  >Lue tietosuojakäytännöstämme <strong>tästä</strong></p>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header text-center" >
          <h4 class="modal-title w-100" style="text-transform:uppercase;">Tietosuojaseloste</h4>
        </div>
        <div class="modal-body">
          <ol>
            <?php 
                // Hankitaan LOPUT TIETOSUOJALASUEET
                $Hae_Tietosuoja = "SELECT * from tbl_lauseet WHERE Lause_Tunnus Like 'Tietosuoja%'";
                $result_Hae_Tietosuoja = $conn->query($Hae_Tietosuoja);

                if ($result_Hae_Tietosuoja->num_rows > 0) {

                    while($row = $result_Hae_Tietosuoja->fetch_assoc()) {
                      $Tietosuoja = $row["Lause"]; 
                      echo " <li>
                           $Tietosuoja
                            </li>";
                    }
                }
            ?>
            
            
        </ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" style="border:2px solid red;color:red;font-weight:bold;width:100%;" data-dismiss="modal">SULJE IKKUNA</button>
        </div>
      </div>
    </div>
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
</div>  
  </div>
</footer>
