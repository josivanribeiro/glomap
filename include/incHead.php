<!-- start head -->
<head>
	<meta charset="UTF-8">
	<title>GLOMAP | Grande Loja Maçônica do Amapá</title>
	<link rel="shortcut icon" href="/resources/images/favicon.ico"></link>
	<link href="/resources/css/style.css" rel="stylesheet" type="text/css" media="all"></link>
	<link rel="stylesheet" type="text/css" href="/resources/css/demo.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="/resources/js/accordion.js"></script>
	<!-- Internet Explorer HTML5 enabling script: -->
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<style type="text/css">

			.clear {
				zoom: 1;
				display: block;
			}

		</style>
	<![endif]-->
	<script src="/resources/js/jquery-2.2.0.min.js"></script>
	<script src="/resources/js/functions.js"></script>
	<script src="/resources/js/userChangePwd.js"></script>
	<script src="/resources/js/keyword.js"></script>
	<script src="/resources/js/home.js"></script>
	<script src="/resources/js/content.js"></script>
	<script src="/resources/js/gallery.js"></script>
	<script type="text/javascript"><!--
 
		$(document).ready(function() {
			getJSONMenu ();
			getJSONHomeIntro ();
			loadLastSixContents ();
			loadLastContentType4 ();
			loadLastThreeGalleries ();

			timerChangeGalleryHome = setInterval('changeGalleryHome ()', interval);

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
				$('#mask').hide();
				$('.window').hide();
			});

		    $('.window-keyword .close').click(function (e) {
				$('#mask-keyword').hide();
				$('.window-keyword').hide();
			});
		    
		    $('#mask').click(function () {
				$(this).hide();
				$('.window').hide();
			});

		    $('#mask-keyword').click(function () {
				$(this).hide();
				$('.window-keyword').hide();
			});			

		    $(document).on ('click', '.accordion-section-title', function(e) {
		    	var id = $(this).attr ('href');
		    	id = id.replace ("#","");
		    	openAccordionSection (id);
		    });
			
		});

		/*
		* Configures the popup modal.
		*/
		function configModal (maskId, id) {
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			$('#'+ maskId).css({'width':maskWidth,'height':maskHeight});
	
			$('#'+ maskId).fadeIn(1000);
			$('#'+ maskId).fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
	              
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		
			$(id).fadeIn(2000);
		}
	
	--></script>
</head>
<!-- start head -->