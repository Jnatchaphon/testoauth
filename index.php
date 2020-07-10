<?php 
session_start();

if(isset($_SESSION["myacctoken"])){
    $acctoken = $_SESSION["myacctoken"];
    echo "Access Token : " .$acctoken."<br>";
}else{
    $acctoken = "";
}




if($acctoken != ""){
    echo "<font color='green'>Sign In Success</font><br>";

    $header = "Authorization: token " . $acctoken;
    $user = "User-Agent: test";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.github.com/user");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', $user, $header));
    $res = curl_exec($ch);

    var_dump($res);
    $data = json_decode($res);

    curl_close($ch);
    echo json_encode($data);
    echo "<br><a href=\"?logout\" style=\"color:red;\">Log out</a>";

}else{
    echo "<a href=\"https://github.com/login/oauth/authorize?client_id=4daf4fc07d9f959d01c6\">Sign in to github</a>";
}





if(isset($_GET["logout"])){
session_destroy();
header('Location: http://localhost/OAuth/index.php');

}

?>