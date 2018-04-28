<?php 
session_start();
if (!isset($_SESSION['loggedNoticesAndDocumentsUser'])){
	header ("location:home.php");
}
?>