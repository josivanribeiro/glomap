<?php

/**
 * Utility class containing useful methods.
 * 
 * @author josivanSilva(Developer);
 *
 */
class Utils {

	/**
	 * Casts an object to a class instance.
	 * 
	 */
	public static function castToClass ($class, $object) {
		return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
	}
	
	/**
	 * Gets the logged user.
	 * 
	 */
	public static function getLoggedUser () {
		$loggedUser = null;
		session_start();
		if (isset($_SESSION['loggedUser'])) {
			$loggedUser =  self::castToClass ('UserVO', $_SESSION['loggedUser']);
		} else if (isset($_SESSION['loggedBalanceSheetUser'])) {
			$loggedUser = self::castToClass ('UserVO', $_SESSION['loggedBalanceSheetUser']);
		}
		return $loggedUser;
	}
	
	/**
	 * Gets the formatted datetime.
	 * 
	 */
	public static function getFormattedDatetime ($date) {
		$result = "";
		if ($date != null) {
			$datetime = new DateTime ($date);
			$result = date_format ($datetime, 'd/m/Y H:i:s');
		}		
		return $result;
	}
	
	/**
	 * Gets the formatted datetime with only hour and minute.
	 * 
	 */
	public static function getFormattedHourMinuteDatetime ($date) {
		$result = "";
		if ($date != null) {
			$datetime = new DateTime ($date);
			$result = date_format ($datetime, 'd/m/Y H:i');
		}
		return $result;
	}
	
	/**
	 * Gets the formatted datetime with only d/m/Y.
	 * 
	 */
	public static function getFormattedDayMonthYearDatetime ($date) {
		$result = "";
		if ($date != null) {
			$datetime = new DateTime ($date);
			$result = date_format ($datetime, 'd/m/Y');
		}
		return $result;
	}
	
	/**
	 * Gets the formatted period.
	 * 
	 */
	public static function getFormattedPeriod ($contentVO) {
		$result = "";
		
		$result = $contentVO->getPERIOD_START_MONTH() . "/" . $contentVO->getPERIOD_START_YEAR() . " a " . $contentVO->getPERIOD_END_MONTH() . "/" . $contentVO->getPERIOD_END_YEAR(); 
		
		return $result;
	}
		
	/**
	 * Resizes an image.
	 */
	public static function resizeImage ($fileImageUploadId, $newWidth) {
		$resultArr = array();		        
        $extension = $_FILES[$fileImageUploadId]['type'];		
        
        if ($extension == "image/jpg" || $extension == "image/jpeg" ) {
			$uploadedfile = $_FILES[$fileImageUploadId]['tmp_name'];
			$src = imagecreatefromjpeg ($uploadedfile);
		} else if ($extension=="image/png") {
			$uploadedfile = $_FILES[$fileImageUploadId]['tmp_name'];
			$src = imagecreatefrompng ($uploadedfile);
		} else {
			$uploadedfile = $_FILES[$fileImageUploadId]['tmp_name'];
			$src = imagecreatefromgif ($uploadedfile);
		}		 
		
		list ($width,$height) = getimagesize ($uploadedfile);		
		$newHeight = ($height / $width) * $newWidth;
		$tmp = imagecreatetruecolor ($newWidth, $newHeight);
		
		imagecopyresampled ($tmp,$src,0,0,0,0, $newWidth, $newHeight, $width, $height);
						
        /*** start output buffering ***/
        ob_start();

        /***  export the image ***/
        imageJPEG ($tmp);
        
        $imageSize = ob_get_length();

        /*** stick the image content in a variable ***/
        $imageStream = ob_get_contents();
        
        /*** clean up a little ***/
        ob_end_clean();
		
		$resultArr[0] = $imageStream;
        $resultArr[1] = $newWidth;
        $resultArr[2] = $newHeight;
        $resultArr[3] = $imageSize;
        
        return $resultArr;
	}
	
	/**
	 * Validates a JSON string.
	 */
	public static function isJSON ($str) {
	 	json_decode ($str);
	 	return (json_last_error() == JSON_ERROR_NONE);
	}

}

?>