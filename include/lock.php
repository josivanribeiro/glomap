<?php 
session_start();
if (!isset($_SESSION['loggedBalanceSheetUser'])){
	
	$url =  "{$_SERVER['REQUEST_URI']}";
	$url = substr($url, 1);//removing the "/" (first char) 
		
	header ("location:https://glomap1.websiteseguro.com/login.php?url=" . $url  . "&from=bs");
}
?>