<?php session_start(); ?>
<?php
include_once 'PHP - Funktiot/Connect.php';
include_once 'PHP - Funktiot/Funktio.php';
include_once 'PHP - Funktiot/formValidation.php';
require 'PHPMailer/PHPMailerAutoload.php';
?>

<!DOCTYPE html>
<html lang="fi-FI">

<head>
  <title>CHPC- MuokkaaTietoja</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="TyyliTiedostot/Style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    * {
      font-family: 'Maven Pro', sans-serif;
    }

    body {

      background-color: white;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    .container>.row>.body {
      height: 100%;
    }

    .container>.row>.body>form>.row {
      text-transform: uppercase;
    }

    .container>.row>.body>form>.row>div input[type=text],
    input[type=email],
    input[type=username],
    input[type=phone],
    input[type=password] {
      padding-left: 5px;
      text-align: center;
      width: 250px;
      height: 37px;
      font-size: 18px;
      outline: none;
    }

    .container>.row>.body>form>.row>div input[type=password] {
      font-size: 22px;
      outline: none;

    }

    .container>.row>.body>form>.row>div input[type=text]:hover,
    input[type=email]:hover,
    input[type=username]:hover,
    input[type=phone]:hover,
    input[type=password]:hover {
      background-color: rgb(240, 240, 240);
      outline: none;

    }

    .container>.row>.header>.container>.row>ul {
      text-align: right;
      margin-left: 33em;
      margin-top: -30px;
    }

    .container>.row>.header>.container>.row>ul li {
      list-style: none;
      display: inline-block;
      text-transform: uppercase;
      padding-left: 5px;
      padding-right: 5px;
      font-size: 20px;
    }

    .container>.row>.header>.container>.row>ul li:hover {
      font-weight: bold;
    }

    .container>.row>.header>.container>.row>ul li a {
      display: block;
      text-decoration: none;
      color: black;
      letter-spacing: 2px;
    }

    .header>.container>.row>.Logo span {
      text-align: center;
      font-size: 20px;
      text-transform: uppercase;
      font-weight: 700;
      letter-spacing: 5px;
      padding-top: 15px;
    }

    .header>.container>.row>.Logo {
      margin-top: 15px;
    }

    .container>.row>.header>.container>.row>.Logo a {
      text-decoration: none;
    }

    .errorTeksti {
      font-size: 18px;
      color: red;
      margin-left: 1.2em;
    }

    .error {
      color: red;
      font-size: 2em;
      position: absolute;
      margin-top: 10px;
      padding-left: 9px;
    }

    .body>form>.Muokkaa {
      height: 50px;
      width: 300px;
      text-align: center;
      margin-left: 25em;
      text-transform: uppercase;
      letter-spacing: 5px;
      font-weight: 600;
      background-color: rgb(135, 206, 250, 0.1);
      outline: none;
    }

    .body>.Muokkaa:hover {
      background-color: rgba(135, 206, 250, 0.5);
    }

    .text {
      background-color: #5cb85c;
      opacity: 1;
    }

    .text:hover {
      color: #5cb85c;
      box-shadow: 0 0 2px #5cb85c, 0 0 2px #5cb85c;
    }

    .missioBOX {
      width: 100%;
      background-color: RGB(244, 160, 0, 0.2);
      margin-top: 2.5px;
      margin-bottom: -2.5px;
      DISPLAY: NONE;
    }

    .MISSIOOTSIKKO {
      text-align: center;
      font-weight: bold;
      padding-top: 2px;
    }

    .MISSIOTEKSTI {
      margin-right: 1em;
      padding-left: 20px;
      text-align: center;
      font-size: 18px;
    }
  </style>


  <?php
  $Asiakasnumero = $_SESSION['Asiakasnumero'];

  $sql = "SELECT tbl_asiakkaat.Asiakasnumero,tbl_asiakkaat.Etunimi, tbl_asiakkaat.Sukunimi, tbl_asiakkaat.Sposti,tbl_kayttajatunnus.Kayttajatunnus,tbl_kayttajatunnus.Salasana
FROM tbl_asiakkaat INNER JOIN tbl_kayttajatunnus ON tbl_kayttajatunnus.Asiakasnumero=tbl_asiakkaat.Asiakasnumero WHERE tbl_asiakkaat.Asiakasnumero = '$Asiakasnumero'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
      $asiakasnumero = $row["Asiakasnumero"];
      $etunimi = $row["Etunimi"];
      $sukunimi = $row["Sukunimi"];
      $sposti = $row["Sposti"];
      $käyttäjätunnus = $row["Kayttajatunnus"];
      $salasana = $row["Salasana"];
    }
  }

  $Muokkaus_PVM = date('Y-m-d');
  if (isset($_POST['MuokkaaB'])) {

    $asiakasnumero = mysqli_real_escape_string($conn, $_POST['asiakasnumero']);
    $etunimi = mysqli_real_escape_string($conn, $_POST['etunimi']);
    $sukunimi = mysqli_real_escape_string($conn, $_POST['sukunimi']);
    $sposti = mysqli_real_escape_string($conn, $_POST['Sposti']);
    $käyttäjätunnus = mysqli_real_escape_string($conn, $_POST['KayttajatunnusBM']);
    $salasana = mysqli_real_escape_string($conn, $_POST['salasana']);

    $Kryptattu_Salasana = md5($salasana);

    if ((empty($_POST['etunimi'])) || (empty($_POST['sukunimi'])) || (empty($_POST['Sposti'])) || (empty($_POST['KayttajatunnusBM'])) || (empty($_POST['salasana']))) {
      // Virheilmoitukset tulostetaan lomakkeen jokaisen syöttökentän alapuolelle
    } else {
      $Muokkaa1 = "UPDATE tbl_asiakkaat SET Etunimi='$_POST[etunimi]',
              Sukunimi='$_POST[sukunimi]',
              Sposti='$_POST[Sposti]',
              MuokattuAsiakas= '$Muokkaus_PVM'
            WHERE Asiakasnumero = '$Asiakasnumero'";
      $KyselyMuokkaa1 = mysqli_query($conn, $Muokkaa1) or die(mysqli_error($conn));
      if ($KyselyMuokkaa1 == 1) {
        $Muokkaa2 = "UPDATE tbl_kayttajatunnus SET Salasana='$_POST[salasana]',
              MuokattuKayttajatunnus = '$Muokkaus_PVM',
              Password_Hash = '$Kryptattu_Salasana' WHERE Asiakasnumero = '$Asiakasnumero'";
        $KyselyMuokkaa2 = mysqli_query($conn, $Muokkaa2) or die(mysqli_error($conn));
        if ($KyselyMuokkaa2 == 1) {

          $_SESSION['Etunimi'] = $etunimi;
          $_SESSION['Sukunimi'] = $sukunimi;
          $_SESSION['Sposti'] = $sposti;
          $_SESSION['Salasana'] = $salasana;

          //echo "Data inserted ".$Asiakasnumero;
          // Email Functionality
          date_default_timezone_set('Etc/UTC');
          $mail = new PHPMailer();
          $mail->IsSMTP();
          $mail->CharSet = 'UTF-8';

          $mail->Host = 'smtp.titan.email';               // SMTP server example
          $mail->SMTPDebug  = 0;                      // enables SMTP debug information (for testing)
          $mail->SMTPAuth   = true;                   // enable SMTP authentication
          $mail->Port       = 465;
          $mail->SMTPSecure = 'ssl';                     // set the SMTP port for the GMAIL server
          $mail->Username   = 'system@chpc.fi';
          $mail->Password   = 'K_?eEdX=yW5Y';               // SMTP account password example

          $header = "TUOTTAVUUSKLINIKAT";
          $header .= "MIME-Version: 1.0\n\n";
          $header .= "Content-type text/html; charset=utf-8";
          // Email ID from which you want to send the email
          $mail->setFrom('system@chpc.fi', 'Tuottavuusklinikat - CHPC');
          $mail->addAddress($sposti);
          $mail->Subject = 'Perustietojen muokkuas - Vaihe B';
          $message = '<html><body>';
          $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
          $message .= "<tr style='background: #eee;'><td><strong>KÄYTTÄJÄTUNNUS</strong> </td><td><strong>SALASANA</strong></td></tr>";
          $message .= "<tr><td>" . $käyttäjätunnus . "</td><td>" .  $salasana . "</td></tr>";
          $message .= "</table>";
          $message .= "<br/><br/>";
          $message .= "NYT VOIT KIRJAUTUA JÄRJESTELMÄÄN <a href='https://chpc.fi/KirjauduVaiheB.php'>TÄSTÄ</a>";
          $message .= "</body></html>";

          $mail->Body = $message;

          $mail->isHTML(true);
          if ($mail->send()) {
            echo "<script>location='TietojenMuokkausVahvistus.php'</script>";
          }
        }
      } else {
        echo "Data Not Updated";
      }
    }
  }


  $sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
  $result_Missio = $conn->query($sql_Missio);

  if ($result_Missio->num_rows > 0) {

    while ($row = $result_Missio->fetch_assoc()) {
      $Lause = $row["Lause"];
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
              <li><a href="#" class="avaa_1" data-toggle="modal" data-target="#myModal_2">Missio</a></li>
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
    $(document).ready(function() {
      $("#Kirjaudu").click(function() {
        $("#sukunimiboksi").show("slow");
      });
    });
  </script>

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
          <p class="otsikko">PERUSTIEDOT, vaihe-B</p>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <br>
            <div class="row">
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Asiakasnumero</div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-9 ">
                <h5 style="text-align:left;font-weight:bold;" name="asiakasnumero"><?php echo $asiakasnumero; ?></h5>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">ETUNIMI</div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input style="background-color:rgba(128,128,128,0.2); outline:none;border:none;" type="text" id="etunimi" readonly name="etunimi" value="<?php echo $etunimi; ?>"></div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Sukunimi </div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input style="background-color:rgba(128,128,128,0.2); outline:none;border:none;" type="text" id="sukunimi" readonly name="sukunimi" value="<?php echo $sukunimi; ?>"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Sähköpostisi yrityksessäsi <i class="fa fa-info">
                  <span class="tooltiptext">Jos olet uuden yrityksen palveluksessa, olet uusi asiakas. Silloin sinun tulee kirjautua uutena asiakkaana järjestelmään</span>
                </i>
              </div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-9 "><input type="email" id="Sposti" readonly name="Sposti" value="<?php echo $sposti; ?>" style="width:99.5%;background-color:rgba(128,128,128,0.2); outline:none;border:none;"></div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Käyttäjätunnus</div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input type="text" style="background-color:rgba(128,128,128,0.2); margin-right:5px;outline:none;border:none;" id="KayttajatunnusBM" name="KayttajatunnusBM" value="<?php echo $käyttäjätunnus; ?>" readonly></div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 ">Salasana </div>
              <div class="col-sm-3 col-md-6 col-lg-4 col-xl-3 "><input type="text" id="salasana" name="salasana" value="<?php echo $salasana; ?>"></div>
            </div>
            <br><br>
            <button type="submit" name="MuokkaaB" id="Muokkaa" class="Muokkaa btn btn-outline-success text" style="outline:none;">Tallenna muutokset</button>
          </form>


          <div class="container Tietoja">
            <div class="row">
              <div class="col-sm-3 col-md-6 col-lg-12 col-xl-12 teksti"><?php
                                                                        if ($resultCheck > 0) {
                                                                          while ($row = mysqli_fetch_assoc($result_9)) {
                                                                            echo $row['Lause'];
                                                                          }
                                                                        }
                                                                        ?></div>
            </div>
          </div>


          <p class="avaa" data-toggle="modal" data-target="#myModal">Lue tietosuojakäytännöstämme <strong>tästä</strong></p>
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" style="text-transform:uppercase;">Tietosuojaseloste</h4>
                </div>
                <div class="modal-body">
                  <ol>
                    <?php
                    // Hankitaan LOPUT TIETOSUOJALASUEET
                    $Hae_Tietosuoja = "SELECT * from tbl_lauseet WHERE Lause_Tunnus Like 'Tietosuoja%'";
                    $result_Hae_Tietosuoja = $conn->query($Hae_Tietosuoja);

                    if ($result_Hae_Tietosuoja->num_rows > 0) {

                      while ($row = $result_Hae_Tietosuoja->fetch_assoc()) {
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
  <script>
    $(document).ready(function() {
      $(".sulje").click(function() {
        $("#SUHKOy").hide();
      });
      $(".avaa").click(function() {
        $("#SUHKOy").show();
      });
    });
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

</html>