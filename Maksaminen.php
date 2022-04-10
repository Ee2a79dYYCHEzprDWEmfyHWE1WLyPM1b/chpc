<?php 
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/Connect.php';
error_reporting(0); 
?>
<?php

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'Missio'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row = $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"]; 
    }
    
}



$conn->close();
?>
<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Maksaminen</title>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      .body > button{
        height:50px;
        width:450px;
        text-align:center;
        margin-left:20em;
        text-transform:uppercase;
        letter-spacing:5px;
        font-weight:600;
        background-color:rgb(135,206,250,0.1);
      }
      .body > button:hover{
        background-color:rgb(135,206,250,0.5);
      }
      .container > .row > .header > .container > .row > ul{
    text-align:right;
    margin-left:33em;
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
      .container > .row >.body hr{
        margin-top:2rem;
        
      }
      .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 4px 2px;
        cursor: pointer;
        width:280px;
}
      .Painikkeet{
        display:flex;
        column-gap: 5%;
        margin-left:4.5rem;
        margin-top:1rem;
        margin-bottom:1rem;
        text-transform:uppercase;
}
      .Painikkeet a{
       text-decoration:none;
        color:white;
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
    paddin-top:2px;
}
.MISSIOTEKSTI {
    margin-right:1em;
    padding-left:20px;
    text-align:center;
    font-size:18px;
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
                            <li><a href="#" id="avaa">Missio</a></li>
                            <li><a href="uutiskirjetilaus.php">uutiskirjeen tilaus</a></li>
                            <li><a href="Uutiskirjeet.php">Uutiskirjeet</a></li>
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
    <div id="missioBOX" class="missioBOX">
            <h5 class="MISSIOOTSIKKO">MISSIOMME</h5>
            <h6 class="MISSIOTEKSTI"><?php echo $Lause; ?></h6>
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
        <p class="otsikko">Valitse pankkiyhteys</p>
          <!-- TÄHÄN KOHTAAN TULEE PANKKI LOGOT -->
            <hr>
            <div class="Painikkeet">
            <a href="Ostoskori.php" class="button" style="background-color: #008CBA;">Takaisin ostoskoriin</a>
            <a href="Ostoskori.php" class="button" style="background-color: #f44336;">Peruuta</a>
            <a href="#" class="button" style="background-color: #4CAF50;">Vahvista maksu</a>
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
<script src="SweetAlert/jquery/jquery-3.3.1.min.js"></script>	 	
    <script src="SweetAlert/popper/popper.min.js"></script>	 	 	
    <script src="SweetAlert/bootstrap4/js/bootstrap.min.js"></script>
	  
    <!--    Plugin sweet Alert 2  -->
	  <script src="plugins/sweetAlert2/sweetalert2.all.min.js"></script>


  <script>
     
      $("#btn1").click(function(){
        Swal.fire({
            title: 'MISSIOMME',
            text: "<?php echo $Lause; ?>"
        });
    });
    
   
    
  
  </script>
</script>