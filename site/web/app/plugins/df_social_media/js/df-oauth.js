
( function ($) {
	jQuery(document).ready(function(e){
		post_url = window.location.href;
		var urlWP = ajax_call.ajaxurl;
		$.ajax({
			type	: "POST",
			url 	: urlWP,
			data	: { action: 'df_get_all_social_media_counter', url: post_url, method : 'set' },
			success: function(data){
			$('.social-sharing-count h3').html( data );
			},

		});
	});
})(jQuery);