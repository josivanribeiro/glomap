<?php

    $path = null;
    
    /*if ($_REQUEST['type'] == "bs") {
    	$path = "../balanceSheets/";	
    } else if ($_REQUEST['type'] == "nd") {
    	$path = "../noticesAndDocuments/";
    }*/
    
    $contentType = $_REQUEST['contentType'];

	if (isset($contentType)) {
	    
    	if ($contentType == "4") {
			$path = "../noticesAndDocuments/";
		} else if ($contentType == "5") {
			$path = "../balanceSheetPm/";		
		} else if ($contentType == "6") {
			$path = "../balanceSheets/";
		}
			
    } 
	
    $filename = $path . $_REQUEST['filename'];

    $fileinfo = pathinfo($filename);
    $sendname = $fileinfo['filename'] . '.' . strtoupper($fileinfo['extension']);
    
    header('Content-Type: application/pdf');
    header("Content-Disposition: attachment; filename=\"$sendname\"");
    header('Content-Length: ' . filesize($filename));
    readfile($filename);

?>