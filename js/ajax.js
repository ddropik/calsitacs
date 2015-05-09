jQuery(document).ready(function($) {

	var appended = false;


	if($('body').is('.page-home')){


	  var data = {
	    action: 'my_frontend_action', //the php ajax event handler named 'wp_ajax_my_frontend_action' defined in functions.php
	    security : MyAjax.security, 
	    dataType:"json",
	    whatever: 1234
	  };

	  // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	  
	  // This is the ajax request to the server
	  $.post(MyAjax.ajaxurl, data, function(response) {


	  		var ajaxResponseLength = response.length;
	  		var noOfMoreResults = ajaxResponseLength-9;

	    	//console.log(response); //this is the ajax success callback function, it manipulates the RESPONSE from the server	

		
				
			$("#input-16").focus(function(){

				if (!appended){

					for( i=0; i < 9; i++ ) {

						$(".searchResults ul").append("<li class=\"singleSearchResult\"><a class=\"linkSearchResult\" href='" + response[i].post_permalink + "'>" + response[i].post_title + "</a></li>");


						appended = true;

					
					}

					$(".searchResults ul").append("<li class=\"moreCommon\"><a class=\"linkMoreCommon\" href='#'>" + noOfMoreResults + " more...</a></li>");

				}
				
				

				
			});

			
	  }); //END $.post

	}//END ispage home


}); //END jQuery.ready