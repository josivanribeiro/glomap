<?php 
session_start();
if (!isset($_SESSION['loggedBalanceSheetPmUser'])){
	header ("location:home.php");
}
?>