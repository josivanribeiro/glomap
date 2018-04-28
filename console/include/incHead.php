<!-- start head -->
<head>
	<meta charset="UTF-8">
	<title>JSD CMS | Sistema Gerenciador de Conteúdo</title>
	<link href="/console/resources/css/style.css" rel="stylesheet" type="text/css" media="all"></link>
	<link href="/console/resources/css/responsive-tabs.css" rel="stylesheet" type="text/css"></link>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/jquery.responsive-tabs/latest/jquery.responsiveTabs.min.js"></script>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>	
	<script src="/console/resources/js/functions.js"></script>
	<script src="/console/resources/js/users.js"></script>
	<script src="/console/resources/js/parameters.js"></script>
	<script src="/console/resources/js/contents.js"></script>
	<script src="/console/resources/js/galleries.js"></script>	
	<script type="text/javascript"><!--		

		$(document).ready(function () {	    
	
		    $('#tabs-container').responsiveTabs({
			    startCollapsed: 'accordion'
			});

		    $('a[name=modal]').click(function(e) {
				//e.preventDefault();
			
				var id = $(this).attr('href');
			
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();
			
				$('#mask').css({'width':maskWidth,'height':maskHeight});
		
				$('#mask').fadeIn(1000);
				$('#mask').fadeTo("slow",0.8);	
			
				//Get the window height and width
				var winH = $(window).height();
				var winW = $(window).width();
		              
				$(id).css('top',  winH/2-$(id).height()/2);
				$(id).css('left', winW/2-$(id).width()/2);
			
				$(id).fadeIn(2000);
		
		    });

		    $('.window .close').click(function (e) {
				e.preventDefault();
				
				$('#mask').hide();
				$('.window').hide();
			});

		    $('#mask').click(function () {
				$(this).hide();
				$('.window').hide();
			});

		    enableTabByNumber ();
			
		});

		/**
		 * Enables the tab given the param from query string.
		 */
		function enableTabByNumber () {
			var tab = getUrlVars()['tab'];
			if (tab != null) {
				if (tab === "3") {
					$("#tab-3-link").trigger( "click" );
					handleContentResponse();
					//change screen to the add view
					changeScreen ('add-content-container','content-list-container');
				} else if (tab === "4") {
					$("#tab-4-link").trigger( "click" );
					handleGalleryResponse();
					//change screen to the add view
					changeScreen ('add-gallery-container','gallery-list-container');					
				}
			}
		}
		
	--></script>
</head>
<!-- start head -->