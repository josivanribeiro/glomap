
/**
* Loads a content by its id.
*/
function loadContentById (contentId) {
	var controllerValue = "ContentController";
	var actionValue     = "loadContentForPage";
	$.post ("classes/controller/FrontController.php", { 
		controller: controllerValue,
    	action:     actionValue,
    	id:         contentId
	}, function (data) {
		var result = data;
		var valueArr = result.split("&&");
		if (valueArr != null && valueArr.length > 0) {
			var contentId      = valueArr [0];
			var lastUpdateDate = valueArr [1];
			var title          = valueArr [2];
			var contentHtml    = valueArr [3];
						
			$("#contentId").val (contentId);
			$("#pTitle").text   (title);
			$("#sLastUpdateDate").text (lastUpdateDate);
			$("#container-content").html (contentHtml);					
		}
	  }
    );
}

/**
* Loads other contents with id different and same type.
*/
function loadOtherContents () {
	var controllerValue  = "ContentController";
	var actionValue      = "renderOtherContentsForPage";
	var contentIdValue   = getUrlVars()['id'];
	var contentTypeValue = getUrlVars()['type'];
		
	if (contentTypeValue != 3) {
		
		$.post ("classes/controller/FrontController.php", { 
			controller:  controllerValue,
	    	action:      actionValue,
	    	contentId:   contentIdValue,
	    	contentType: contentTypeValue
		}, function (data) {
			$(".other-texts-bullets").html (data);
			configOtherContents (contentTypeValue);
		   }
	    );
		
	}	
}

/**
* Configures the other contents label.
*/
function configOtherContents (contentType) {
	if (contentType == 2) {
		$("#other-texts-container-label").text ("Outras notícias");
	} else {
		$("#other-texts-container-label").text ("Outros textos");
	}
	$(".other-texts-container").show ();
	$(".other-texts-bullets").show ();
}

/**
* Renders the contents type 4 as an HTML table.
*/
function renderContentsType4 () {
  var controllerValue = "ContentController";
  var actionValue     = "renderContentsType4ForPage";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue
        }, function (data) {
			$('#container-table-contentsType4').html (data);
		}
  );
}

/**
* Renders the contents type 5 as an HTML table.
*/
function renderContentsType5 () {
  var controllerValue = "ContentController";
  var actionValue     = "renderContentsType5ForPage";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue
        }, function (data) {
			$('#container-table-contentsType5').html (data);
		}
  );
}

/**
* Renders the contents type 6 as an HTML table.
*/
function renderContentsType6 () {
  var controllerValue = "ContentController";
  var actionValue     = "renderContentsType6ForPage";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue
        }, function (data) {
			$('#container-table-contentsType6').html (data);
		}
  );
}

/**
* Renders the last update date for content type 4.
*/
function renderLastUpdateDateType4 () {
	  var controllerValue = "ContentController";
	  var actionValue     = "renderLastUpdateDateType4ForPage";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue
        }, function (data) {
			$('#sLastUpdateDate').html (data);
		}
  );
}

/**
* Renders the last update date for content type 5.
*/
function renderLastUpdateDateType5 () {
  var controllerValue = "ContentController";
  var actionValue     = "renderLastUpdateDateType5ForPage";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue
        }, function (data) {
			$('#sLastUpdateDate').html (data);
		}
  );
}

/**
* Renders the last update date for content type 6.
*/
function renderLastUpdateDateType6 () {
  var controllerValue = "ContentController";
  var actionValue     = "renderLastUpdateDateType6ForPage";
  $.post ("../classes/controller/FrontController.php",
        { 
	  		controller: controllerValue,
	  		action:     actionValue
        }, function (data) {
			$('#sLastUpdateDate').html (data);
		}
  );
}
