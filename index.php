<?php
session_start();
include_once 'PHP - Funktiot/Connect.php';
require 'PHPMailer/PHPMailerAutoload.php';


//Haetaan Otsikko
$sql1 = "Select Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-36'";
//Haetaan Allekirjoitus
$sql2 = "Select Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-1'";
//Haetaan Allekirjoitus
$sql3 = "Select Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-33'";

//TULOSTETAAN KAIKKI ARTIKKELI SISÖLTÖ
$sql4 = "SELECT Artikkeli_Tunnus,Tyyppi,SisennysTyyppi,Vaihe_ID,Sisalto
            FROM tbl_artikkelit Where Vaihe_ID = '1000'";

//Haetaan Allekirjoitus
$sql5 = "Select Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-4'";

//Haetaan SpostiLähetysTeksti
$sql6 = "Select Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-10'";

$result_1 = mysqli_query($conn, $sql1);
$result_2 = mysqli_query($conn, $sql2);
$result_3 = mysqli_query($conn, $sql3);
$result_4 = mysqli_query($conn, $sql4);
$result_5 = mysqli_query($conn, $sql5);
$result_6 = mysqli_query($conn, $sql6);

$resultCheck = mysqli_num_rows($result_1);
$resultCheck = mysqli_num_rows($result_2);
$resultCheck = mysqli_num_rows($result_3);
$resultCheck = mysqli_num_rows($result_4);
$resultCheck = mysqli_num_rows($result_5);
$resultCheck = mysqli_num_rows($result_6);

if ($resultCheck > 0) {
	while ($row = mysqli_fetch_assoc($result_6)) {
		$Lause = $row['Lause'];
	}
}

$sql_Missio = "select Lause_ID,Lause_Tunnus,Lause from tbl_lauseet where Lause_Tunnus = 'W-DB-5'";
$result_Missio = $conn->query($sql_Missio);

if ($result_Missio->num_rows > 0) {

	while ($row = $result_Missio->fetch_assoc()) {
		$Lause_MISSIO = $row["Lause"];
	}
}
?>

<!DOCTYPE html>
<html lang="fi">

<head>
	<title>CHPC- Vaihe A</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="TyyliTiedostot/Style.css">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/761c60ba3b.js" crossorigin="anonymous"></script>
	<style>
		* {
			font-family: 'Maven Pro', sans-serif;
		}

		body {
			background-image: url(Media/Appearance_of_sky_for_weather_forecast,_Dhaka,_Bangladesh.jpg);
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
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

		ul {
			margin-top: -35px;
			margin-bottom: -30px;
			text-indent: -1.6em;
			margin-left: 1.2em;
		}

		li {
			color: blck;
			font-size: 18px;
			list-style: none;
			margin-top: -20px;
		}

		li:not(:last-child) {
			margin-bottom: 5px;
		}

		li:before {
			content: "\2714";
			margin-right: 10px;
		}

		.modal-header .modal-title {
			text-transform: uppercase;
			font-weight: bold;
		}

		.navigaatio li {
			list-style: none;
		}

		.navbar {
			margin-top: 15px;
			height: 25px;
		}

		.navbar .Kirjaudu {
			text-transform: uppercase;
		}

		.navbar .Logo span {
			font-size: 1.5em;
			text-transform: uppercase;
		}

		.navbar .Some {
			float: left;
		}

		.navbar .Some a {
			text-decoration: none;
		}






		/*RESPONSIIVISUUS*/
		/*Jos näytön leveys on 600px tai pienempi*/
		@media only screen and (max-width: 600px) {
			.navbar .Kirjaudu {
				display: none;
			}

			.navbar .Some {
				display: block;
			}

			.navbar .Some .Email,
			.Twitter,
			.LinkedIn,
			.Facebook {
				display: none;
			}

			.navbar .Logo {
				position: absolute;
				display: inline-block;
				margin-top: 2em;
				font-size: 12px;
			}

			.navbar .fa-bars {
				font-size: 27px;
				margin-top: 4px;
				float: right;
				color: black;
			}

			#mySidebar {
				background-color: white;
				height: 100%;
				background-color: rgb(166, 241, 166, 0.6);
				margin-top: 2.5px;
				width: 100%;
				display: none;
			}

			#mySidebar a.suljeIkoni {
				font-size: 35px;
				float: right;
				position: inherit;
				margin-right: 32px;
				color: black;
			}

			#mySidebar .Facebook {
				display: block;
				margin-left: 5em;
			}

			#mySidebar .Email {
				display: block;
				margin-left: 5em;
			}

			#mySidebar .Twitter {
				display: block;
				margin-left: 5em;
			}

			#mySidebar .Kirjaudu {
				margin-left: 5em !important;
				margin-top: 3em !important;
			}

			#mySidebar .LinkedIn {
				margin-left: 5em !important;
			}

			#mySidebar h7 {
				margin-left: 1em !important;
				text-align: center;
				text-transform: uppercase;
				font-size: 10px;
			}

			.container>.row>.footer {
				height: 100%;
			}
		}





		/*Jos näytön leveys on 980px tai pienempi*/
		@media only screen and (max-width: 900px) {
			.navbar .Kirjaudu {
				display: none;
			}

			.navbar .Some {
				display: block;
			}

			.navbar .Some .Email,
			.Twitter,
			.LinkedIn,
			.Facebook {
				display: none;
			}

			.navbar .Logo {
				position: absolute;
				display: inline-block;
				margin-top: 2em;
			}

			.navbar .fa-bars {
				font-size: 27px;
				margin-top: 4px;
				float: right;
				color: black;
			}

			#mySidebar {
				height: 100%;
				background-color: rgb(166, 241, 166, 0.6);
				margin-top: 2.5px;
				width: 100%;
				display: block;
			}

			#mySidebar a.suljeIkoni {
				font-size: 35px;
				float: right;
				position: inherit;
				margin-right: 32px;
				color: black;
			}

			#mySidebar .Facebook {
				display: block;
				text-transform: uppercase;
			}

			#mySidebar a .Facebook {
				text-decoration: none;
				text-transform: uppercase;
			}

			#mySidebar .Twitter {
				display: block;
				text-transform: uppercase;
			}

			#mySidebar .LinkedIn {
				display: block;
				text-transform: uppercase;

			}

			#mySidebar .Email {
				text-transform: uppercase;
			}

			#mySidebar .Kirjaudu {
				position: inherit;
				width: 50%;
				margin-top: 5em;
				margin-left: 10em;
				text-transform: uppercase;
			}

			#mySidebar h7 {
				margin-left: 10.5em;
				text-align: center;
				text-transform: uppercase;
				font-size: 20px;
			}

			#mySidebar .LinkedIn,
			.Twitter,
			.Facebook,
			.Email {
				position: inherit;
				width: 50%;
				margin-top: 0.5em;
				margin-left: 10em;
			}

			.container>.row>.footer {
				height: 100%;
			}


		}




		/*Jos näytön leveys on 768px tai suurempi*/
		@media only screen and (min-width: 950px) {
			.navbar .fa-bars {
				display: none;
			}

			#mySidebar {
				display: none;
			}
		}
	</style>



	<div class="container">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xl header">
						<div class="row navbar">
							<div class="col Kijaudu"><a href="KirjauduVaiheB.php">
									<button type="button" class="btn btn-outline-success Kirjaudu">Kirjaudu</button></a></div>
							<div class="col Logo"><span style="color:RGB(244,160,0)" ;>Tuottavuus</span><span style="color:RGB(15,157,80)">klinikat</span></div>
							<div class="col Some">
								<a href="mailto:?subject=TUOTTAVUUDEN PARANTAMINEN&amp;body=<?php echo $Lause . '.&nbsp;' . $Lause_MISSIO; ?>">
									<button type="button" class="btn btn-outline-dark Email">Email</button>
								</a>
								<a href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause; ?>">
									<button type="button" class="btn btn-outline-dark Twitter">Twitter</button>
								</a>
								<a href="https://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fi">
									<button type="button" class="btn btn-outline-dark LinkedIn">LinkedIn</button>
								</a>
								<a href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause . '.&nbsp;' . $Lause_MISSIO; ?>">
									<button type="button" class="btn btn-outline-dark Facebook">Facebook</button>
								</a>
								<a href="#">
									<i class="fas fa-bars" onclick="w3_open()"></i>
								</a>
							</div>
						</div>
					</div>
					<!-- Sidebar (hidden by default) -->
					<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" id="mySidebar" style="display:none;">
						<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button suljeIkoni">x</a>
						<div class="Navigaatiopalkit">
							<a href="KirjauduVaiheB.php">
								<button type="button" class="btn btn-outline-success Kirjaudu">Kirjaudu</button>
							</a>
							<br><br>
							<h7>Jaa sosiaalisessa mediassa</h7>
							<br>
							<a href="JaaKaverile.php">
								<button type="button" class="btn btn-outline-dark Email">Email</button>
							</a>

							<a href="https://twitter.com/intent/tweet?url=https://chpc.fi&text=<?php echo $Lause; ?>">
								<button type="button" class="btn btn-outline-dark Twitter">Twitter</button>
							</a>

							<a href="https://www.linkedin.com/shareArticle?mini=true&url=https://chpc.fi">
								<button type="button" class="btn btn-outline-dark LinkedIn">LinkedIn</button>
							</a>

							<a href="https://facebook.com/sharer.php?u=https://chpc.fi&quote=<?php echo $Lause . '.&nbsp;' . $Lause_MISSIO; ?>">
								<button type="button" class="btn btn-outline-dark Facebook">Facebook</button>
							</a>
						</div>
						<br>
					</nav>
				</div>
			</div>
		</div>
	</div>

</head>

<body>
	<div class="container">
		<div class="row">

			<div id="missioBOX" class="missioBOX" style="display:none;">
				<br />
				<h5 class="MISSIOOTSIKKO">jaa kaverille...</h5>
				<h6 class="MISSIOTEKSTI">
					<form method="POST">
						<div class="form-group">
							<label for="email" style="font-weight: bold;">SYÖTÄ OMA SÄHKÖPOSTIOSOITTEESI</label>
							<input type="email" class="form-control" placeholder="esimerkki@malli.com" name="SpostiOsoite_oma">
						</div>
						<div class="form-group">
							<label for="email" style="font-weight: bold;">SYÖTÄ KOHDEHENKILÖN SÄHKÖPOSTIOSOITE</label>
							<input type="email" class="form-control" placeholder="esimerkki@malli.com" name="SpostiOsoite_koHDE">
						</div>
						<button type="submit" name="JAA" class="btn btn-primary">LÄHETÄ VIESTI</button>
					</form>
				</h6>

			</div>
			<script>
				$(document).ready(function() {
					$("#sulje").click(function() {
						$(".missioBOX").hide();
					});
					$("#avaa").click(function() {
						$(".missioBOX").show();
					});

				});
			</script>





			<div class="col-xl body">

				<p class="otsikko">
					<?php
					if ($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result_1)) {
							echo $row['Lause'];
						}
					}
					?>
				</p>
				<br>

				<p class="artikkeli" style="margin-top:-1em;">
					<?php
					if ($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result_4)) {
							$Artikkeli_Tunnus = $row['Artikkeli_Tunnus'];
							$Artikkeli_Tyyppi = $row['Tyyppi'];
							$Artikkeli_Sisaltö = $row['Sisalto'] . "<BR>";
							//echo $Artikkeli_Tunnus."<br>".$Artikkeli_Tyyppi."<br>".$Artikkeli_Sisaltö."<br>";
							if ($Artikkeli_Tyyppi == 'Sisennys') {
								echo "<ul>";
								echo "<br><li>$Artikkeli_Sisaltö</li><br><br>";
								echo "</ul>";
							} else {
								echo "<p class='artikkeli' style='margin-top:-1em;'>";
								echo $Artikkeli_Sisaltö . "<br>";
								echo "</p>";
							}
						}
					}
					?>
				</p>

				<p class="artikkeli" style="margin-top:-2em;">
					<?php
					if ($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result_2)) {
							echo $row['Lause'];
						}
					}
					?>
				</p>
				<p class="artikkeli" style="margin-top:3em;">
					<?php
					if ($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result_3)) {
							echo $row['Lause'] . "<BR>";
						}
					}
					if ($resultCheck > 0) {
						while ($row = mysqli_fetch_assoc($result_5)) {
							echo $row['Lause'] . "<BR>";
						}
					}
					?>

				</p>
				<br><br>


			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		$('body').bind('cut copy paste', function(e) {
			e.preventDefault();
		})
		$(".artikkeli").on("contextmenu", function(e) {
			return false;
		})
		$(".Missio").on("contextmenu", function(e) {
			return false;
		})
	})
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
<script>
	// Script to open and close sidebar
	function w3_open() {
		document.getElementById("mySidebar").style.display = "block";
	}

	function w3_close() {
		document.getElementById("mySidebar").style.display = "none";
	}
</script>