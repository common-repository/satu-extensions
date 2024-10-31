var $ = jQuery.noConflict();
$(document).ready(function(){

	/**
     * Drop-down menu
     */
	$( ".menu-primary-wrap li" ).hover(function(){
		$(this).find( "ul:first" ).show();
	}, function(){
		$(this).find( "ul:first" ).hide();
	});

});