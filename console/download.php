<?php

    $contentType = $_REQUEST['contentType'];

	if ($contentType == "4") {
		$folder = "noticesAndDocuments";
	} else if ($contentType == "5") {
		$folder = "balanceSheetPm";
	}
	
    $filename = '../../' . $folder . '/' . $_REQUEST['filename'];

    $fileinfo = pathinfo($filename);
    $sendname = $fileinfo['filename'] . '.' . strtoupper($fileinfo['extension']);

    header('Content-Type: application/pdf');
    header("Content-Disposition: attachment; filename=\"$sendname\"");
    header('Content-Length: ' . filesize($filename));
    readfile($filename);

?>