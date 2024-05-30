jQuery(document).ready(function(){
	
	jQuery(document).on( 'click', '.qcbot-feedback .notice-dismiss', function(){
		var notice_type = jQuery(this).parents('.qcbot-feedback.is-dismissible').attr('data-dismiss-type');
		jQuery.ajax({
			url: rating_object.ajax_url,
			data: {
				action: 'qc_chatbot_feedback_notice_dismiss',
		        dismiss_notice: notice_type
			},
			success: function(){ }
		})
	} )
	
	jQuery(document).on( 'click', '.qcbot-blackfriday .notice-dismiss', function(){
		var notice_type = jQuery(this).parents('.qcbot-blackfriday.is-dismissible').attr('data-dismiss-type');
		jQuery.ajax({
			url: rating_object.ajax_url,
			data: {
				action: 'qc_chatbot_blackfriday_notice_dismiss',
		        dismiss_notice: notice_type
			},
			success: function(){ }
		})
	} )
	
});