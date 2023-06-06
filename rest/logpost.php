<?php
include_once 'database.php';
session_start();

$database = new Database();

if(isset($_POST['username']) && isset($_POST['password']))
{
    $db = $database->getConnection();
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."';";

    $stmt = $db->prepare($query);

    $result = $stmt->execute();

    $row = $stmt->fetch();
    print($query);

    print("</br>".$row['username']. " = ". $username . "</br>");
    print("</br>".$row['password']. " = ". $password . "</br>");

    if($username == $row['username'])
    {
        if($password = $row['password'])
        {
            $_SESSION["hash"] = $row['hash'];
            $_SESSION["image"] = $row['username'] . ".jpg";
            $_SESSION["username"] = $row['username'];
            print("connected");
        }
    }else
    {
        print("not connected");
    }
}else
{
    print("not connected");
}

