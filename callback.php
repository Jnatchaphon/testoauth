<?php
session_start();
if($_GET["code"] == ""){
    header('Location: http://localhost/OAuth/index.php');
   
}else{

$client_id = "4daf4fc07d9f959d01c6";
$client_secret = "03fe63ff319ce0921cc25d765d03e6ab15e45ed2";
$urlaccess = "https://github.com/login/oauth/access_token";


$post = [
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'code' => $_GET["code"]
];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlaccess);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$res = curl_exec($ch);
curl_close($ch);

$data = json_decode($res);


if($data->access_token != ""){
    $_SESSION["myacctoken"] = $data->access_token;
    header('Location: http://localhost/OAuth/index.php');
}




}




?>
