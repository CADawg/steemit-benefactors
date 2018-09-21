<?php
session_start();

$actual_link = isset($_SERVER['HTTPS']) ? "https" : "http";

$actual_link .= "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (!isset($_SESSION['code'])) {require "notLoggedIn.php";} else {require "writepost.php";}; ?>