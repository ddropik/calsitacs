//(function($) {
jQuery(document).ready(function(){




//console.log("test.js executed!");
//console.log("in NestedArray, the value for postID: "+testjs_object.NestedArray.postID);
console.log( testjs_object);

var searchObj = testjs_object;

console.log(searchObj[0].term_name, searchObj[0].href);

/*

 TODO: create functionality that grabs the testjs_object...it's contents hardcoded in functions.php
 ....replaces the content of a.linkSearchResult, probably using a loop, with contents of testjs_object
 */


$("#input-16").focus(function(){

	$(".linkSearchResult").contents().filter(function(){

							return this.nodeType == 3 ; //remove any text nodes already there

						}).remove();

/*
	//$(".linkSearchResult").html("something else");
	$(".linkSearchResult").each(function(index,value){

		$(this).html(testjs_object[index]);

		if(index === 8) return false; //ensure that it iterates only 9 times max
	}); 
*/

for(i=0;testjs_object.length;i++) {

	$(".searcResults ul").append("<li><a href='#'>" + testjs_object[i].term_name + "</a></li>");


	if(i===8) return false;
}


$(".linkSearchResult").each(function(i,value){

	//console.log(testjs_object[index].term_name, testjs_object[index].href );

		$(this).html(testjs_object[i].term_name);


//console.log(testjs_object[i].term_name);

	if(i === 8) return false; //ensure that it iterates only 9 times max

}); 

console.log(testjs_object.length);

});


				


});
//})( jQuery );