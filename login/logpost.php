<?php
include_once '../bddconn/Database.php';
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
            $_SESSION["username"] = $row['username'];
            header('Location: ../index.php');
        }
    }else
    {
        header('Location: login.php');
    }
}else
{
    header('Location: login.php');
}

