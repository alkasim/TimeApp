<?php
/**
 * Created by PhpStorm.
 * User: alkasim
 * Date: 18.02.16
 * Time: 12:44
 */

include "Database.php";

$db = new Database();

if(!isset($_SERVER['PHP_AUTH_USER']) && !isset($_SERVER['PHP_AUTH_PW']) )
{
    $response["status"] = "FAILED";
    $response["message"] = "";
    $response["data"] = "";

    $json_response = json_encode($response);
    echo($json_response);
}
else
{
    if($_GET["action"] == "login")
    {
        echo($db->login($_GET["pass"],$_GET["user"]));
    }
    else if($_GET["action"] == "getprojects")
    {
        echo($db->getProjects($_GET["uid"]));
    }
    else if($_GET["action"] == "getactions")
    {
        echo($db->getActions($_GET["pid"],$_GET["uid"]));
    }
}
