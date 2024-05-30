<?php


	add_action('admin_notices', 'qcld_openaiaddon__invalid_license_notice');
	function qcld_openaiaddon__invalid_license_notice(){
		if( (get_openaiaddon_licensing_buy_from() != '') && (get_openaiaddon_invalid_license()) ){
			if( (get_openaiaddon_licensing_buy_from() == 'quantumcloud') && (get_openaiaddon_licensing_key() == '') ){

			}elseif( (get_openaiaddon_licensing_buy_from() == 'codecanyon') && (get_openaiaddon_envato_key() == '') ){

			}else{
				$class="notice notice-error is-dismissible qc-notice-error";
				$message = "You have Entered an Invalid License Key for Livechat Addon";
				$logo_src = openaiaddon_LICENSING_URL.'/images/qc-logo.jpg';
		
				printf( '<div data-dismiss-type="qc-invalid-license" class="%1$s"><a href="'.esc_url('https://www.quantumcloud.com/products/').'" target="_blank"><img src="'.$logo_src.'" /></a><p>%2$s</p></div>', esc_attr( $class ), $message ); 
			}
		}
	}


if( !get_openaiaddon_enter_license_notice_dismiss_transient() ){
	add_action('admin_notices', 'qcld_openaiaddon_license_enter_notice');
	function qcld_openaiaddon_license_enter_notice(){
		if( (get_openaiaddon_licensing_buy_from() != false) || (get_openaiaddon_invalid_license() != 1) ){

		}else{
			$class="notice notice-error is-dismissible qc-notice-error";
			

			$message = "Hi! Please enter the license key to receive automatic updates and premium support. <a href=".openaiaddon__get_licensing_url().">Please activate your copy of Open AI Addon.</a>";
			$logo_src = openaiaddon_LICENSING_URL.'/images/qc-logo.jpg';
			printf( '<div data-dismiss-type="qc-enter-license" class="%1$s"><a href="'.esc_url('https://www.quantumcloud.com/products/').'" target="_blank"><img src="'.$logo_src.'" /></a><p>%2$s</p></div>', esc_attr( $class ), $message ); 
		}
	}
}

//start new-update-for-codecanyon
function openaiaddon__licensing_notice_dismiss_func(){
	check_ajax_referer('openaiaddon__licensing_admin_nonce', 'nonce');

	if( sanitize_text_field($_GET['dismiss_notice']) == 'qc-enter-license' ){
		if( !get_openaiaddon_enter_license_notice_dismiss_transient() ){
			set_openaiaddon_enter_license_notice_dismiss_transient();
		}
	}

	if( sanitize_text_field($_GET['dismiss_notice']) == 'qc-invalid-license' ){
		if( !get_openaiaddon_invalid_license_notice_dismiss_transient() ){
			set_openaiaddon_invalid_license_notice_dismiss_transient();
		}
	}

}
add_action('wp_ajax_openaiaddon__licensing_notice_dismiss', 'openaiaddon__licensing_notice_dismiss_func');
//end new-update-for-codecanyon