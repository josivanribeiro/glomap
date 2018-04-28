var themeNumber            = 1;
var galleryNumber          = 1;
var timerChangeGalleryHome = null;
var interval               = 10000; //10s

/**
* Loads the last three galleries.
*/
function loadLastThreeGalleries () {
	var controllerValue = "GalleryController";
	var actionValue     = "loadLastThreeGalleries";
	$.post ("classes/controller/FrontController.php", { 
		controller: controllerValue,
    	action:     actionValue
	}, function (data) {
		var result = data;
		var valueArr = result.split("#");
		if (valueArr != null && valueArr.length > 0) {
						
			var galleryArr = valueArr[0].split("|");
			
			var imageNames     = galleryArr[0];
			var imageNameArr   = imageNames.split("&");
			var imageName3_1   = imageNameArr[0];
			var imageName3_2   = imageNameArr[1];
			var imageName3_3   = imageNameArr[2];
			var galleryLegend3 = galleryArr[1];
			var galleryId3     = galleryArr[2];
									
			galleryArr = valueArr[1].split("|");
			
			imageNames         = galleryArr[0];
			var imageNameArr   = imageNames.split("&");
			var imageName2_1   = imageNameArr[0];
			var imageName2_2   = imageNameArr[1];
			var imageName2_3   = imageNameArr[2];
			var galleryLegend2 = galleryArr[1];
			var galleryId2     = galleryArr[2];
									
			galleryArr = valueArr[2].split("|");
			
			imageNames         = galleryArr[0];
			var imageNameArr   = imageNames.split("&");
			var imageName1_1   = imageNameArr[0];
			var imageName1_2   = imageNameArr[1];
			var imageName1_3   = imageNameArr[2];
			var galleryLegend1 = galleryArr[1];
			var galleryId1     = galleryArr[2];
												
			$("#imageName1_1").val (imageName1_1);
			$("#imageName1_2").val (imageName1_2);
			$("#imageName1_3").val (imageName1_3);
			$("#galleryLegend1").val (galleryLegend1);
			$("#galleryId1").val (galleryId1);
			
			$("#imageName2_1").val (imageName2_1);
			$("#imageName2_2").val (imageName2_2);
			$("#imageName2_3").val (imageName2_3);
			$("#galleryLegend2").val (galleryLegend2);
			$("#galleryId2").val (galleryId2);
			
			$("#imageName3_1").val (imageName3_1);
			$("#imageName3_2").val (imageName3_2);
			$("#imageName3_3").val (imageName3_3);
			$("#galleryLegend3").val (galleryLegend3);
			$("#galleryId3").val (galleryId3);
			
			setDefaultGalleryHome ();
						
		}
	  }
    );
}

/**
* Loads the last six news contents.
*/
function loadLastSixContents () {
	var controllerValue = "ContentController";
	var actionValue     = "renderLastSixContentsForPage";
	$.post ("classes/controller/FrontController.php", {
		controller: controllerValue,
    	action:     actionValue
	}, function (data) {
		$("#news-container-lines").html (data);		
	   }
    );
}

/**
* Loads the last type 4 content.
*/
function loadLastContentType4 () {
	var controllerValue = "ContentController";
	var actionValue     = "renderLastContentType4ForPage";
	$.post ("classes/controller/FrontController.php", {
		controller: controllerValue,
    	action:     actionValue
	}, function (data) {
		$("#notices-documents-container-lines").html (data);
	   }
    );
}

/**
 * Changes the theme of the home page.
 */
function changeThemeHome() {
   if (themeNumber > 1 || themeNumber > 6) {
	    $('#home-container').removeClass('home' + (themeNumber - 1) + '-container');
	   		if (themeNumber > 6) {
	   			themeNumber = 1;
	   		}
	   }		   
   $('#home-container').addClass('home' + themeNumber + '-container');
   $('#home-container').fadeIn(1500);
   themeNumber++;
}
		
/**
 * Changes the gallery of the home page.
 */
function changeGalleryHome () {
	if (galleryNumber > 3) {
		galleryNumber = 1;
	}
	changeContainerNumbers (galleryNumber); 	   		
	var COVER_IMAGE_FOLDER = "/resources/images/cover/";
	var imageName_1        = $('#imageName'+galleryNumber+'_1').val();
	var imageName_2        = $('#imageName'+galleryNumber+'_2').val();
	var imageName_3        = $('#imageName'+galleryNumber+'_3').val();
	var galleryLegend      = $('#galleryLegend'+galleryNumber).val();
	var galleryId          = $('#galleryId'+galleryNumber).val();			
	$( ".galleries-container-background" ).fadeOut( 1600, "linear", function() {
		$("#galleries-separator").show();
		
		$("#galleries-container-image-1").attr("src", COVER_IMAGE_FOLDER + imageName_1);
		$("#galleries-container-image-2").attr("src", COVER_IMAGE_FOLDER + imageName_2);
		$("#galleries-container-image-3").attr("src", COVER_IMAGE_FOLDER + imageName_3);

		$("#galleries-container-image-1-link").attr("href", "gallery.php?id=" + galleryId);
		$("#galleries-container-image-2-link").attr("href", "gallery.php?id=" + galleryId);
		$("#galleries-container-image-3-link").attr("href", "gallery.php?id=" + galleryId);
		
		$("#galleries-container-title-label-link").text (galleryLegend);
		$("#galleries-container-title-label-link").attr("href", "gallery.php?id=" + galleryId);
		
	});
	$( ".galleries-container-background" ).fadeIn ("fast");
	galleryNumber++;
}

/**
 * Sets the default gallery of the home page.
 */
function setDefaultGalleryHome () {
	changeContainerNumbers (galleryNumber);
	var COVER_IMAGE_FOLDER = "/resources/images/cover/";
	var imageName_1        = $('#imageName1_1').val();
	var imageName_2        = $('#imageName1_2').val();
	var imageName_3        = $('#imageName1_3').val();
	var galleryLegend      = $('#galleryLegend1').val();
	var galleryId          = $('#galleryId1').val();			
	$( ".galleries-container-background" ).fadeOut( 1600, "linear", function() {
		$("#galleries-separator").show();
		
		$("#galleries-container-image-1").attr("src", COVER_IMAGE_FOLDER + imageName_1);
		$("#galleries-container-image-2").attr("src", COVER_IMAGE_FOLDER + imageName_2);
		$("#galleries-container-image-3").attr("src", COVER_IMAGE_FOLDER + imageName_3);

		$("#galleries-container-image-1-link").attr("href", "gallery.php?id=" + galleryId);
		$("#galleries-container-image-2-link").attr("href", "gallery.php?id=" + galleryId);
		$("#galleries-container-image-3-link").attr("href", "gallery.php?id=" + galleryId);
		
		$("#galleries-container-title-label-link").text (galleryLegend);
		$("#galleries-container-title-label-link").attr("href", "gallery.php?id=" + galleryId);
		
	});
	$( ".galleries-container-background" ).fadeIn ("fast");
	galleryNumber++;
}

/**
 * Changes the selected container number.
 */
function changeContainerNumbers (galleryNumber) {
	$("#galleries-container-number-" + galleryNumber).removeClass("galleries-container-numbers-" + galleryNumber);
	$("#galleries-container-number-" + galleryNumber).addClass("galleries-container-numbers-selected");
	for (var i = 1; i <= 3; i++) {
		if (i != galleryNumber) {
			$("#galleries-container-number-" + i).removeClass("galleries-container-numbers-selected");
			$("#galleries-container-number-" + i).addClass ("galleries-container-numbers-" + i);
		}				
	}			
}

/**
 * Goes to the specific gallery.
 */
function goToGalleryHome (number) {
	clearTimeout (timerChangeGalleryHome);
	galleryNumber = number;
	changeGalleryHome ();
	timerChangeGalleryHome = setInterval('changeGalleryHome ()', interval);			
}

/**
 * Gets the JSON string menu.
*/
function getJSONMenu () {
  var controllerValue = "ContentController";
  var actionValue     = "getJSONMenu";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue   	  		
        }, function (data) {			        	
        	var menuArr = JSON.parse (data);        	
        	if (menuArr != null && menuArr.length > 0) {
        		updateMenuFromJSON (menuArr);
        	}
		}
  );
}

/**
 * Gets the JSON string home intro.
*/
function getJSONHomeIntro () {
  var controllerValue = "ContentController";
  var actionValue     = "getJSONHomeIntro";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue 		
        }, function (data) {			        	
        	var homeIntroArr = JSON.parse (data);        	
        	if (homeIntroArr != null && homeIntroArr.length > 0) {
        		updateHomeIntroFromJSON (homeIntroArr);
        	}
		}
  );
}

/**
 * Updates menu based on the JSON array menu.
*/
function updateMenuFromJSON (menuArr) {	
	
	for (var i = 0; i < menuArr.length; i++) {
	     var id          = menuArr[i]['id'];
	     var value       = menuArr[i]['value'];
	     var href        = menuArr[i]['href'];
	     var target      = menuArr[i]['target'];
	     var menuitemArr = menuArr[i]['menuitem'];
	     	     
	     $('#' + id).text (value);
	     if (!isEmpty (href)) {
	    	 $('#' + id).attr ("href", href);
	     }	     
	     if (!isEmpty (target)) {
	    	 $('#' + id).attr ("target", target);
	     }
	     
	     if (menuitemArr != null && menuitemArr.length > 0) {	    	 
	    	 
	    	 for (var j = 0; j < menuitemArr.length; j++) {
	    		 var idItem     = menuitemArr[j].id;
	    	     var valueItem  = menuitemArr[j].value;
	    	     var hrefItem   = menuitemArr[j].href;
	    	     var targetItem = menuitemArr[j].target;
	    	         	     
	    	     $('#' + idItem).text (valueItem);	    	     
	    	     if (!isEmpty (hrefItem)) {
	    	    	 $('#' + idItem).attr ("href", hrefItem);
	    	     }	    	     
	    	     if (!isEmpty (targetItem)) {
	    	    	 $('#' + idItem).attr ("target", targetItem);	 
	    	     }	    	     
	    	 }	    	 
	     }
	}	
}

/**
 * Updates home intro based on the JSON array home intro.
*/
function updateHomeIntroFromJSON (homeIntroArr) {	
	for (var i = 0; i < homeIntroArr.length; i++) {
	     var containerId         = homeIntroArr[i]['containerId'];
	     var containerValue      = homeIntroArr[i]['containerValue'];
	     var containerLinkId     = homeIntroArr[i]['containerLinkId'];
	     var containerLinkText   = homeIntroArr[i]['containerLinkText'];
	     var containerLinkHref   = homeIntroArr[i]['containerLinkHref'];
	     var containerLinkTarget = homeIntroArr[i]['containerLinkTarget'];
	     	     
	     $('#' + containerId).html (containerValue);
	     $('#' + containerLinkId).text (containerLinkText);
	     $('#' + containerLinkId).attr ("href", containerLinkHref);
	     if (!isEmpty (containerLinkTarget)) {
	    	 $('#' + containerLinkId).attr ("target", containerLinkTarget);
	     }
	}	
}