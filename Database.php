<?php

/**
 * Created by PhpStorm.
 * User: alkasim
 * Date: 18.02.16
 * Time: 09:04
 */
class Database
{

    private $conn = null;

    function Database()
    {
        $this->conn = mysqli_connect("192.168.43.190", "alkasim", "alkasim115", "time_app");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }

    function login($pass, $user)
    {
        try {
            $result = mysqli_query($this->conn, 'select * from "user" where name=' . $user . ' and pass=' . $pass);

            if (mysqli_num_rows($result) == 1) {
                $ret = true;

                $row = mysqli_fetch_assoc($result);

                $response["status"] = "SUCCESS";
                $response["message"] = "";
                $response["data"]["uid"] = $row["id"];
                $response["data"]["name"] = $row["name"];
                $response["data"]["type"] = $row["type"];
            }
        }
        catch(mysqli_sql_exception $e)
        {
            $response["status"] = "FAILED";
            $response["message"] = $e->errorMessage();
            $response["data"] = "";
        }

        $json_response = json_encode($response);
        return $json_response;
    }

    function getProjects($uid)
    {
        try
        {
            $result = mysqli_query($this->conn, 'select * from project where uid=' . $uid);

            $response["status"] = "SUCCESS";
            $response["message"] = "";

            for ($i = 0; $row = mysqli_fetch_assoc($result); $i++)
            {
                $response["data"][$i]["pid"] = $row["id"];
                $response["data"][$i]["name"] = $row["name"];
                $response["data"][$i]["desc"] = $row["desc"];
                $response["data"][$i]["timestamp"] = $row["timestamp"];
            }
        }
        catch(mysqli_sql_exception $e)
        {
            $response["status"] = "FAILED";
            $response["message"] = $e->errorMessage();
            $response["data"] = "";
        }
    }

    function getActions($pid,$uid)
    {
        try
        {
            $result = mysqli_query($this->conn, 'select * from actions where pid=' . $pid . ' and uid=' . $uid);

            $response["status"] = "SUCCESS";
            $response["message"] = "";

            for ($i = 0; $row = mysqli_fetch_assoc($result); $i++)
            {
                $response["data"][$i]["aid"] = $row["id"];
                $response["data"][$i]["pid"] = $row["pid"];
                $response["data"][$i]["name"] = $row["name"];
                $response["data"][$i]["desc"] = $row["desc"];
                $response["data"][$i]["time"] = $row["time"];
            }
        }
        catch(mysqli_sql_exception $e)
        {
            $response["status"] = "FAILED";
            $response["message"] = $e->errorMessage();
            $response["data"] = "";
        }
    }
}