/* global jQuery:false */

(function($) {

	//alert("test");
	
	
	var windowHeight = $( window ).height(); // get the computed height of the browser viewport
	//var footerHeight = $("#colophon").height(); // get the computed height of the footer
	var footerHeight = 250; // get the computed height of the footer
	//var bodyHeight = $("body.page").height(); // get the computed height of the body

	var calculatedBodyHeight = bodyHeight + footerHeight; // add the height of the footer to the height of the body
	//var calculatedBodyHeight2 = bodyHeight - footerHeight; // add the height of the footer to the height of the body

	console.log("windowHeight: "+windowHeight+", bodyHeight: "+ bodyHeight+", calculatedBodyHeight: "+calculatedBodyHeight+", footerHeight: "+footerHeight); //examine current heights in the console

	// Apply or remove CSS classes based on whether windowHeight is less than calculatedBodyHeight
	if(windowHeight <= bodyHeight){
			console.log(" -fixed +static");
			$("#colophon").removeClass("footerPositionFixed");
			$("#colophon").addClass("footerPositionStatic");
		}else{
			console.log("  +fixed -static");
			$("#colophon").removeClass("footerPositionStatic");
			$("#colophon").addClass("footerPositionFixed");
		}
	//Same statements as directly above, yet wrapped in a resize event trigger
	$(window).resize(function(){
		//alert($("#colophon").css("position"));
		var windowHeight = $( window ).height(); // get the computed height of the browser viewport
		//var footerHeight = $("#colophon").height(); // get the computed height of the footer
		var footerHeight = 250; // get the computed height of the footer
		var bodyHeight = $("body.page").height(); // get the computed height of the body

		var calculatedBodyHeight = bodyHeight + footerHeight; // add the height of the footer to the height of the body
		//var calculatedBodyHeight2 = bodyHeight - footerHeight; // add the height of the footer to the height of the body

		console.log("windowHeight: "+windowHeight+", bodyHeight: "+ bodyHeight+", calculatedBodyHeight: "+calculatedBodyHeight+", footerHeight: "+footerHeight); //examine current heights in the console

		if(windowHeight <= bodyHeight){
			console.log(" -fixed +static");
			$("#colophon").removeClass("footerPositionFixed");
			$("#colophon").addClass("footerPositionStatic");
		}else {
			console.log("  +fixed -static");
			$("#colophon").removeClass("footerPositionStatic");
			$("#colophon").addClass("footerPositionFixed");
		}
	});

	//Include the page-home.js if current page is .page-home
	if($('body').is('.page-home')){

		var documentHeight = $(document).height(); //Height of document
		var windowHeight = $(window).height(); //Height of window
		var currentScrollVal = 0;

		var lastScrollTop = 0;

/*
		$(window).scroll(function() {
			var st = $(this).scrollTop();
			var diff = Math.abs(lastScrollTop-st);

			var myTop = parseInt($(".service-pop-out").css("top"),10);

			if(st > lastScrollTop){
				console.log("scrolling down, st: "+st+", diff: "+diff+", myTop: "+myTop);
				myTop = myTop - diff;
				//console.log("st: "+st+" myTop: "+myTop);

			}else{
				console.log("scrolling up, st: "+st+" myTop: "+myTop);
				myTop = myTop + diff;
			}

			lastScrollTop=st;


		$( ".service-pop-out" ).css({top:myTop});




	    });*/

		//Initialize position.left and position.right on page load
		var position = $("#services-searchfield").position();
		var posLeft = "left";
		var posTop = "top";
		var opts={};
		opts[posLeft]=position.left;
		opts[posTop]=position.top;




	    

		
		//Ensure that service-pop-out is absolutely centered where it should be on page load.
		$( ".service-pop-out" ).css({top:position.top,left:position.left});

		//on resize dynamically change posLeft and documentHeight
		$(window).resize(function(){
			var documentHeight = $(window).height();

			position = $("#services-searchfield").position();
			posLeft = "left";
			posTop = "top";
			opts={};
			opts[posLeft]=position.left;
			opts[posTop]=position.top;

			var searchFieldLeft = $("#services-searchfield").position().left;
			

			if(!$(".service-pop-out").hasClass("open")){


				$( ".service-pop-out" ).css({left:searchFieldLeft});
				
			}
			

		});

		///function to animate service pop out, when the wpadminbar is not showing
		function animateSPO(e){

			e.preventDefault();

			window.thisTop = parseInt($(".service-pop-out").css("top"),10);
			window.thisLeft = parseInt($(".service-pop-out").css("left"),10);

			$(".service-pop-out").velocity({

			properties:{ width: "100%", height: windowHeight , left: "0px", top: "0px", opacity:"1"/*,translateX:"-200px"*/},
						 		
			options:{ duration: "800", easing:"easeInOutCubic", display:"block"}

			});

			

			$(".helpOption")
			.velocity("transition.slideLeftIn", { stagger: 250 })
			.delay(750)
	    	

			$(".service-pop-out").addClass("open");

		}

		//function to animate service pop out, when the wpadminbar is showing
		function adminAnimateSPO(e){

			e.preventDefault();

			window.thisTop = parseInt($(".service-pop-out").css("top"),10);
			window.thisLeft = parseInt($(".service-pop-out").css("left"),10);

			$(".service-pop-out").velocity({

			properties:{ width: "100%", height: "100%"/*windowHeight*/ , left: "0px", top: "32px", opacity:"1"/*,translateX:"-200px"*/}, //top is 32px, to account for wpadminbar
						 		
			options:{ duration: "800", easing:"easeInOutCubic", display:"block"}

			});

			
			$(".helpOption")
			.velocity("transition.slideLeftIn", { stagger: 250 })
			.delay(750)
	    	

			$(".service-pop-out").addClass("open");

		}


		$( ".pop-out-close" ).click(function(e) {

			e.preventDefault();

			//alert("thisTop: "+window.thisTop+", thisLeft: "+window.thisLeft);

		  	$(".service-pop-out").velocity({

		 		properties:{ width: "100", height: "100" ,left:window.thisLeft, top:window.thisTop, opacity:"0"},
		 		
		  		options:{ duration: "800", easing:"easeInOutCubic", display:"none"}
			});

			$(".service-pop-out").removeClass("open");
		});


		//Conditional that executes correct function according to whether wpadminbar is showing
		if($("#wpadminbar").length) {
			//wpadminbar showing, user logged on
			$( ".our-services" ).click(function(e) {
			adminAnimateSPO(e);		
			});
		

			$("#services-searchfield").focus(function(e) {
			adminAnimateSPO(e);
			});

		}else{

			//wpadminbar not showing, user logged off
			$( ".our-services" ).click(function(e) {
			animateSPO(e);		
			});
		

			$("#services-searchfield").focus(function(e) {
			animateSPO(e);
			});

		} //end else


		
	} //end if is page-home

	//alert($("#colophon").css("position"));

	if ($("#colophon").css("position") == "static"){
		var rawBodyHeight = $("body.page").height(); // get the computed height of the body
		var bodyHeight = rawBodyHeight - 250;
		//alert("static bodyHeight: "+bodyHeight);
	}else if($("#colophon").css("position") == "fixed"){
		var bodyHeight = $("body.page").height(); // get the computed height of the body
		//alert("fixed bodyHeight: "+ bodyHeight);
	}


})( jQuery );
