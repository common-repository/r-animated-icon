(function($){
	'use strict';
	$('.r_default_animate_icon').each(function(){

		var file_path=$(this).data('json');
		var ele_id="#"+$(this).attr('id');

		var animation = bodymovin.loadAnimation({
			  container:this, // Required
			  path: file_path, // Required
			  renderer: 'svg', // Required
			  loop: true, // Optional
			  autoplay: true, // Optional
			  name: "Hello World", // Name for future reference. Optional.
		});
	});


})(jQuery);/* =========== DOCUMENT READY ends ======================= */
