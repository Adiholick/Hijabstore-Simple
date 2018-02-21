<?php
require_once "koneksi.php";
$curl = curl_init();
$tujuan = mysqli_real_escape_string($con, $_POST['destination']);
$berat =mysqli_real_escape_string($con, $_POST['weight']);
$kurir =mysqli_real_escape_string($con, $_POST['courier']);
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=106&destination=".$tujuan."&weight=".$berat."&courier=".$kurir."",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: bd0c62b740fd02e78133a2cdf6656162"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}