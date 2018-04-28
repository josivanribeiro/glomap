var imageNameArr   = null;
var imageLegendArr = null;

/**
* Loads a gallery by its id.
*/
function loadGalleryById (galleryId) {
	var controllerValue = "GalleryController";
	var actionValue     = "loadGalleryForPage";
	$.post ("classes/controller/FrontController.php", { 
		controller: controllerValue,
    	action:     actionValue,
    	id:         galleryId
	}, function (data) {
		var result = data; 
		var valueArr = result.split("|");
		if (valueArr != null && valueArr.length > 0) {
			var galleryId        = valueArr [0];
			var legend           = valueArr [1];
			var lastUpdateDate   = valueArr [2];
			var description      = valueArr [3];
			var imageNames       = valueArr [4];
			var imageLegends     = valueArr [5];
			var imageGalleryHtml = valueArr [6];
			
			$("#galleryId").val (galleryId);
			$("#pLegend").text (legend);
			$("#sLastUpdateDate").text (lastUpdateDate);
			$("#pDescription").text (description);
			imageNameArr   = imageNames.split("^");
			imageLegendArr = imageLegends.split("^");
			$("#container-uploaded-files").html (imageGalleryHtml);
			$("#container-uploaded-files").show;			
		}
	  }
    );
}

/**
* Loads other galleries with id different.
*/
function loadOtherGalleries () {
	var controllerValue = "GalleryController";
	var actionValue     = "renderOtherGalleriesForPage";
	var galleryIdValue  = getUrlVars()['id']; 
	$.post ("classes/controller/FrontController.php", { 
		controller: controllerValue,
    	action:     actionValue,
    	galleryId:  galleryIdValue
	}, function (data) {
		$(".other-texts-bullets").html (data);		
	   }
    );
}

/**
* Shows the image in a modal.
*/
function showModalImage (elementId) {
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();

	$('#mask-image-page').css({'width':maskWidth,'height':maskHeight});

	$('#mask-image-page').fadeIn(1000);
	$('#mask-image-page').fadeTo("slow",0.8);	

	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
          
	//$("#" + elementId).css('top',  winH/2-$("#" + elementId).height()/2);
	$("#" + elementId).css('top',  "50px");
	$("#" + elementId).css('left', winW/2-$("#" + elementId).width()/2);

	$("#" + elementId).fadeIn(2000);
}

/**
* Loads an image by its name.
*/
function loadImageByName (name) {
	var IMAGE_FOLDER = "../resources/images/upload/";
	var imgHtml = "<img src=\"" + IMAGE_FOLDER + name + "\" border=\"0\"/>";
	$('#container-image-page').html (imgHtml);
	$('#currentImageName').val (name);
	loadLegendByImageName (name);
}

/**
* Loads an image legend given the image name.
*/
function loadLegendByImageName (name) {
	var imageIndex = getIndexByImageName (name);
	var imageLegend = imageLegendArr [imageIndex];
	if (!isEmpty (imageLegend)) {
		$('#container-image-legend-text').text (imageLegend);
	} else {
		$('#container-image-legend-text').text ("");
	}
}

/**
* Opens the previous image of the array of image names.
*/
function openPreviousImage() {
	var currentImageName = $('#currentImageName').val();
	var currentIndex = getIndexByImageName (currentImageName);	
	if (currentIndex > 0) {
		var newIndex = currentIndex - 1;
		var newImageName = imageNameArr [newIndex];
		loadImageByName (newImageName);
	}
}

/**
* Opens the next image of the array of image names.
*/
function openNextImage() {
	var currentImageName = $('#currentImageName').val();
	var currentIndex = getIndexByImageName (currentImageName);	
	var newIndex = currentIndex + 1;
	var newImageName = imageNameArr [newIndex];
	if (!isEmpty (newImageName)) {
		loadImageByName (newImageName);
	}
}

/**
* Gets the index of the selected image.
*/
function getIndexByImageName (name) {
	var index = -1;
	for (var i=0; i < imageNameArr.length; i++) {
		var imageName = imageNameArr[i];
		if (imageName === name) {
			index = i;
			break;
		}
	}
	return index;
}
