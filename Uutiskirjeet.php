<?php

include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/Connect.php';

error_reporting(0);
?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Uutiskirjeet</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
       .container>.row > .body > .asiakasTiedot > div{
        text-align:left;
        height:40px;
        padding-top:5px;
        font-size:18px;
    }
    .container>.row > .body > .asiakasTiedot >.data{
        font-weight:bold;
        padding-left:5em;
        text-align:left;
    }
    .body > button{
    height:50px;
    width:250px;
    text-align:center;
    margin-left:28em;
    text-transform:uppercase;
    letter-spacing:5px;
    font-weight:600;
    background-color:rgb(135,206,250,0.1)
    }
    .body > button:hover{
        background-color:rgb(135,206,250,0.5);

    }
    .container > .row > .header > .container > .row > ul{
    text-align:right;
    margin-left:36em;
    margin-top:-30px;
}

.container > .row > .header > .container > .row > ul li{
    list-style:none;
    display:inline-block;
    margin-bottom:-25px;
    text-transform:uppercase;
    padding-left:5px;
    padding-right:5px;
    font-size:20px;
}
.container > .row > .header > .container > .row > ul li:hover{
    font-weight: bold;
    text-decoration:none;

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


      /********Accorrdion section*************************** */
      .accordion {
  width: 100%;
  max-width: 1000px;
  margin: 2rem auto;
}
.accordion-item {
  background-color: rgb(135,206,250,0.6);
  color: #111;
  margin: 1rem 0;
}
.accordion-item-header {
  padding: 0.5rem 3rem 0.5rem 1rem;
  min-height: 3.5rem;
  line-height: 1.25rem;
  font-weight: bold;
  display: flex;
  align-items: center;
  position: relative;
  cursor: pointer;
}
.accordion-item-header::after {
  content: "\002B";
  font-size: 2rem;
  position: absolute;
  right: 1.5rem;
}
.accordion-item-header.active::after {
  content: "\2212";
}
.accordion-item-body {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
.accordion-item-body-content {
  padding: 1rem;
  line-height: 1.5rem;
  border-top: 1px solid;
  border-image: linear-gradient(to right, transparent, #34495e, transparent) 1;
}
.accordion-item-body-content > p{
  margin-bottom:-0.9rem;
  margin-left:2rem;
}
.accordion-item-body-content > a,i{
  font-size:30px;
  display:flex;
  margin-top:15px;
  text-align:center;
  margin-left:15rem;
  color:black;
}
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.5); /* Black w/ opacity */

}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto ;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  border-radius: 0px 0px 0px 0px;
  border-style: solid;
  border-color:black;
  border-width:1px;
  overflow: auto; /* Enable scroll if needed */
}

/* The Close Button */
.modal-content a {
  color:red;
  font-size: 28px;
  font-weight: bold;
  height:50px;
  width:10em;
  text-align:center;
  text-decoration:none;
  margin-bottom:0.5rem;
  margin-top:1rem;
  margin-left:39rem;
  border-top: 1px solid red;
  border-left: 1px solid red;
  border-bottom: 1px solid red;
  border-right: 1px solid red;
}
.modal-content p{
  margin-top:2.8rem;
}
.modal-content a:hover{
  letter-spacing:2px;
}
.modal-content h3{
  text-align:center;
  text-transform:uppercase;
  letter-spacing:0.5rem;
  font-weight:bold;
  position:fixed;
  background-color:white;
  width:79%;
  height:3.5rem;
  margin-top:-1.25rem;
  margin-left:-1.2rem;
  background-attachment:fixed;
  padding-top:0.80rem;
  border-bottom:1px solid gray;
  box-shadow: 1px
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
.virheilmoitus_uutiskirje
{
  text-align: center;
  text-transform: uppercase;
  font-weight: bold;
  color:red;
}

  </style>
 <?php

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

    while($row= $result_Missio->fetch_assoc()) {
      $Lause =$row["Lause"];
    }
}

//Lasketaan Uutiskirjeiden LKM
$LaskeUutiskirjeita = "SELECT COUNT(Kirjenumero) AS LKM FROM tbl_uutiskirjeet";
$result_LaskeUutiskirjeita = $conn->query($LaskeUutiskirjeita);

if ($result_LaskeUutiskirjeita->num_rows > 0) {

    while($row= $result_LaskeUutiskirjeita->fetch_assoc()) {
      $LKM =$row["LKM"];
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
                        <ul style="padding-left: 11em;">
                            <li><a href="#" id="avaa" class="avaa_1">Missio</a></li>
                            <li><a href="uutiskirjetilaus.php">uutiskirjeen tilaus</a></li>
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
      <p class="otsikko">Uutiskirjeet</p>
      <h5 style="text-align:center;position: absolute;top:2.7em;left:34.5em;font-size:15px;">(Yhteensä: <?php echo $LKM; ?> kpl)</h5>
        <br>

<?php

// Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  
  $sql = "SELECT * FROM tbl_uutiskirjeet ORDER BY LisattyUutiskirje DESC";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while($rows = $result->fetch_assoc()) {
        //Muokataan lisäysPVM
        $UutiskirjeenlisäysPVM = $rows["LisattyUutiskirje"];
        $UutiskirjeenlisäysPVMuokkausTulostus = date("d.m.Y", strtotime($UutiskirjeenlisäysPVM));


            echo '<div class="accordion">';
              echo '<div class="accordion-item">';
                echo '<div class="row accordion-item-header">';
                  echo '<div class="col-sm-3 col-md-6 col-lg-10 col-xl-10">';
                  echo $rows["Otsikko"];
                  echo '</div>';
                  echo '<div class="col-sm-9 col-md-6 col-lg-2 col-xl-2">';
                  echo $UutiskirjeenlisäysPVMuokkausTulostus;
                  echo '</div>';
                echo '</div>';
                echo '<div class="accordion-item-body">';
                  echo '<div class="accordion-item-body-content">';
                  echo 'Tiedostonnimi';
                  echo $rows["SisaltoTeksti"];
                  echo '<br><br>';
                  echo '<p>Lataa uutiskirje</p>';
                  echo "<a href='Download.php?file=$rows[TiedostoNimi]'>

                  <i class='fas fa-download' data-toggle='popover' data-trigger='hover' data-content='$rows[TiedostoNimi]'></i></a>";
                  
                echo '</div>';
                echo '</div>';
              echo '</div>';
            echo '</div>';
      }
  } else {
    echo "<h3 class='virheilmoitus_uutiskirje'>Ei ole ladattavissa olevia uutiskirjeitä</h3>";
}
?>
        <br><br><br><br>
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

<script>

const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

accordionItemHeaders.forEach(accordionItemHeader => {
  accordionItemHeader.addEventListener("click", event => {


    accordionItemHeader.classList.toggle("active");
    const accordionItemBody = accordionItemHeader.nextElementSibling;
    if(accordionItemHeader.classList.contains("active")) {
      accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
    }
    else {
      accordionItemBody.style.maxHeight = 0;
    }

  });
});

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
</html>
