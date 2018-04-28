<?php 
session_start();
if (!isset($_SESSION['loggedUser'])){
	$url =  "{$_SERVER['REQUEST_URI']}";
	//header ("location:https://glomap1.websiteseguro.com/login.php?url=" . $url . "&from=csl");
	header ("location:http://localhost/login.php?url=" . $url . "&from=csl");
}
?>