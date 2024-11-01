/*
* Yandex Add Url
*/
jQuery(document).ready(function($){
	jQuery('#ya-hide').on('click', function(){
		jQuery('#ya-iframe').toggleClass('hide');
	});
	jQuery('.ya-click-to-open').on('click', function(){
		jQuery('#ya-iframe').removeClass('hide');
	});
});