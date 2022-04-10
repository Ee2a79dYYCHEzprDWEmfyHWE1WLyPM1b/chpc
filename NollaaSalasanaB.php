<?php 
include_once 'PHP - Funktiot/Connect.php';
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
include_once 'PHP - Funktiot/Index_sql_query.php';
require 'PHPMailer/PHPMailerAutoload.php';


error_reporting(0); 
?>

<?php
$Lisays_PVM = date('Y-m-d');

if(isset($_POST['NollaaSalasanaB']))
{
    $Sposti = mysqli_real_escape_string($conn,$_POST['Sposti']);
    $Salasana = $GeneroiSalasana;
    $Cryptaus = md5($Salasana);
      
    if((empty($_POST['Sposti'])))
    {
              
    }
    else
    {
        $HaeKayttis = "SELECT tbl_kayttajatunnus.Kayttajatunnus from tbl_kayttajatunnus INNER JOIN tbl_asiakkaat ON tbl_kayttajatunnus.Asiakasnumero = tbl_asiakkaat.Asiakasnumero WHERE tbl_asiakkaat.Sposti = '$Sposti'";
        $result_HaeKayttis = $conn->query($HaeKayttis);

        if ($result_HaeKayttis->num_rows > 0) {
            while($row = $result_HaeKayttis->fetch_assoc()) {
            $Kayttis =$row["Kayttajatunnus"]; 
            } 
                $LuoUusiSalasanaKysely = "UPDATE tbl_kayttajatunnus SET Salasana='$Salasana',MuokattuKayttajatunnus='$Lisays_PVM',Password_Hash='$Cryptaus' WHERE Kayttajatunnus = '$Kayttis'";
                $LuoUusiSalasanaKyselyTulos = mysqli_query($conn, $LuoUusiSalasanaKysely) or die (mysqli_error($conn));
                if($LuoUusiSalasanaKyselyTulos == 1)
                    {
                      // Email Functionality
                      date_default_timezone_set('Etc/UTC');
                      $mail = new PHPMailer();
                      $mail->IsSMTP();
                      $mail->CharSet = 'UTF-8';

                      $mail->Host = 'smtp.titan.email'; 
                      $mail->SMTPDebug  = 0;                      // enables SMTP debug information (for testing)
                      $mail->SMTPAuth   = true;                   // enable SMTP authentication
                      $mail->Port       = 465;                     // set the SMTP port for the GMAIL server
                      $mail->SMTPSecure = 'ssl';                     // set the SMTP port for the GMAIL server
                      $mail->Username   = 'system@chpc.fi';             
                      $mail->Password   = 'K_?eEdX=yW5Y';            // SMTP account password example

                      $header ="TUOTTAVUUSKLINIKAT";
                      $header .="MIME-Version: 1.0\n\n";
                      $header .="Content-type text/html; charset=utf-8";
                      // Email ID from which you want to send the email
                      $mail->setFrom('system@chpc.fi','Tuottavuusklinikat - CHPC');
                      $mail->addAddress($Sposti);
                      $mail->Subject = 'UUSI SALASANA - Vaihe B';
                      $message = '<html><body>';
                      $message = '<h3>Arvoisa asiakkaamme alla on uusi salasanasi järjestelmäämme</h3>';
                      $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                      $message .= "<tr style='background: #eee;'><td><strong>KÄYTTÄJÄTUNNUS</strong> </td><td><strong>SALASANA</strong></td></tr>";
                      $message .= "<tr><td>".$Kayttis."</td><td>" .  $Salasana . "</td></tr>";
                      $message .= "</table>";
                      $message .= "<br/><br/>";
                      $message .= "NYT VOIT KIRJAUTUA JÄRJESTELMÄÄN <a href='https://chpc.fi/KirjauduVaiheB.php'>TÄSTÄ</a>";
                      $message .= "</body></html>";
                
                      $mail->Body = $message;
                
                      $mail->isHTML(true);

                      $mail->send();

                        if($mail->send())
                    {
                        echo "<script>location='SalasananNollausVahvistus.php'</script>";
                    }
                    }
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="fi-FI">
<head>
  <title>CHPC- Nollaa Salasana vaihe B</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
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
.container > .row > .body > form >.row > div input[type=username],input[type=email],input[type=password]{
    padding-left:5px;
    text-align:center;
    width:500px;
    height:55px;
    outline:none;
}
.container > .row > .body > form >.row  .label{
    text-align:center;
    font-size:20px;
    margin-bottom:5px;
}
.container > .row > .body > form >.row   input[type=username],input[type=email]{
    font-size:25px;
    outline:none;
}
.container > .row > .body > form >.row  input[type=password]{
    letter-spacing:10px;
    font-size:35px;
    outline:none;
}
.container > .row > .header > .container > .row > ul{
    text-align:right;
    margin-left:45em;
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
.container > .row > .header > .container > .row >.Logo a{
    text-decoration:none;
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
<?php 

function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

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
        <p class="otsikko">Tilaa uusi salasana, Vaihe B</p>
<br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="row">
                
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 label">Sähköpostiosoite</div>
                  <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 input"><input type="email" id="Sposti" name="Sposti" ></div>
                  <div class="container ErrorBox" style="margin-right:11.3em;margin-left:11.3em;margin-top:2px;margin-bottom:5px;width:70em;">
                    <div class=" alert-danger AlertErrorBox hide" style="text-align:center;background-color:transparent;color:red;" id="myAlert">
                        <strong ><?php echo  $SpostiErr; ?></strong> 
                    </div>
                  </div> 
                </div>
            <br>
            <button type="submit" name="NollaaSalasanaB" id="submit" style="outline:none;" class="Muokkaa btn btn-outline-primary text">Tilaa uusi salasana</button>
            </form>
            <br>
            <br>
      </div>
    </div>  
  </div>
</body>
<script> 
    // Change the type of input to password or text 
        function Toggle() { 
            var temp = document.getElementById("salasana"); 
            if (temp.type === "password") { 
                temp.type = "text"; 
                document.getElementById("salasana").style.height = "55px";
                document.getElementById("salasana").style.width = "500px";
                document.getElementById("salasana").style.textAlign = "center";
                document.getElementById("salasana").style.fontSize = "30px";
                document.getElementById("salasana").style.outline = "none";
            } 
            else { 
                temp.type = "password"; 
            } 
        } 
</script>
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
<br>
    
</html>
