<?php
session_start();
unset($_SESSION['hash']);
unset($_SESSION['username']);

header('Location: login.php');
