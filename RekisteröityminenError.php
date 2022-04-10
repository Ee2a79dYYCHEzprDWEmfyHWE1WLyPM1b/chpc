<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Connect.php';
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Index_sql_query.php';
require 'PHPMailer/PHPMailerAutoload.php';

//Haetaan vahvistusViesti, ok
$sql1="SELECT Lause from tbl_lauseet WHERE Lause_Tunnus = 'W-DB-19'";
$result_1=mysqli_query($conn,$sql1);
$resultCheck=mysqli_num_rows($result_1);

      if($resultCheck > 0){
          while($row =mysqli_fetch_assoc($result_1)){
            $Lause_Vahvistus = $row['Lause'];
          }
      }

//Haetaan vahvistusViesti, virhe
$sql2="SELECT Lause from tbl_lauseet WHERE Lause_Tunnus = 'W-DB-20'";
$result_2=mysqli_query($conn,$sql2);
$resultCheck=mysqli_num_rows($result_2);

      if($resultCheck > 0){
          while($row =mysqli_fetch_assoc($result_2)){
            $Lause_Vahvistus_Error = $row['Lause'];
          }
      }

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }

}

$Lisays_PVM = date('Y-m-d');

?>


<!DOCTYPE html>
<html lang="fi-Fi">
<head>
  <title>CHPC- Rekisteröidy vaihe B</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  


<style>
  *{
    font-family: 'Maven Pro', sans-serif;   
}
 
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

  .container > .row > .body > form >.row
      {
        text-transform:uppercase;
        text-align:center;
      }
  .container > .row > .body > form >.row > div input[type=text],input[type=username],input[type=email],input[type=password]
      {
        padding-left:5px;
        text-align:center;
        width:750px;
        height:55px;
        outline:none;
        text-transform:none;
      }
  .container > .row > .body > form >.row  .label
      {
        text-align:center;
        font-size:20px;
        margin-bottom:5px;
        text-transform:none;
      }
  .body > .Muokkaa,.Muokkaa_2:hover
      {
        background-color:rgb(135,206,250,0.5);
      }
      .text{
      background-color:#0275d8;
      opacity:1;
    }
    .text:hover{
      color:#0275d8;
      box-shadow:0 0 2px #0275d8, 0 0 2px #0275d8;
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

  .alert-danger {
    width: 100%;
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
    position:   inherit;
    margin-right: 32px;
    color:black;
  }
  
  .container > .row > .body > form >.row  .label
  {
    margin-top:-15px;
  }
  
  .alert-danger
  {
    margin-left: 0em;
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
            </div>
            </div>
        <!-- Sidebar (hidden by default) -->

        </div>
      </div>
    </div>
</div>

</head>
<body>

<div class="container">
    <div class="row">

<style>

.alert-danger
    {
      height:100%;
      border-radius: 0% 0%;
      margin-top: 15px;
    }
.alert-danger > h5
    {
      text-align: center;
      font-size: 25px;
      text-transform: uppercase;
    }
.alert-danger > h5
    {
      text-align: center;
      font-size: 25px;
    }

.alert-danger a h5
    {
      text-align: center;
      font-size: 25px;
      margin-top: 1em;
      text-transform: uppercase;
      color:black;
      text-decoration: none;
      font-weight: bold;
    }

h6
{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
}
.btn-danger
{
    width: 100%;
    margin-top: 1em;
    height:3.5em;
    font-size: 25px;
    text-transform: uppercase;
    border-radius: 0% 0%;
    font-weight: bold;
    letter-spacing: 4px;
}
</style>
      <div class="col-xl body">
        <div class="alert alert-danger">
          <h5 style="letter-spacing: 5px;"><?php echo $Lause_Vahvistus_Error ; ?></h5>
          <br>
          <h5>Syynä saattaa olla jokin seuraavista:
            <br>
            <h6>- Olemassaoleva asiakasnumero</h6>
            <h6>- Olemassaoleva sähköpostiosoite</h6>
            <h6>- Olemassaoleva etu- ja sukunimi</h6>
            <h6>- Tai jokin muu</h6>
          </h5>
          <br>
          <h5>Mikäli et pääse rekisteröitymään, ota yhteys asiakaspalveluumme <a href="mailto:info@chpc.fi">info@chpc.fi</a></h5>
          <a href="RekisteroidyVaiheB.php"><button type="button" class="btn btn-danger">palaa takaisin ja kokeile uudestaan</button></a>
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
