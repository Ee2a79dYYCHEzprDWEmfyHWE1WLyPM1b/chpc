<?php session_start(); ?>
<?php

include_once 'PHP - Funktiot/Connect.php';

$KuittiNRO = $_SESSION['Kuittinumero'];
echo $KuittiNRO;


$kekeytaTapahtuma = "UPDATE tbl_ostoskori SET Kuitti_Tila='Keskeytetty' WHERE KuittiNro = '$KuittiNRO'";
$kekeytaTapahtumaAjo  = mysqli_query($conn,$kekeytaTapahtuma);

if($kekeytaTapahtumaAjo = 1)
    {
        echo "<script>location='AsiakasprofiiliC.php'</script>";
    }

?>

