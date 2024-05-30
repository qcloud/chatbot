<?php

function qcld_openaiaddon_activate_au()
{
	$plugin_slug = openaiaddon_LICENSING_PLUGIN_SLUG;
	$get_plugin_data = get_openaiaddon_licensing_plugin_data();

	$plugin_current_version = $get_plugin_data['Version'];
	$plugin_remote_path =  openaiaddon_LICENSING_PLUGIN_NAME;
	$license_key = get_openaiaddon_licensing_key();
	$buy_from = get_openaiaddon_licensing_buy_from();
	
	if( $buy_from == 'quantumcloud' ){
		$upgrader_instance = new qcld_openaiaddon_AutoUpdate ( $plugin_current_version, $plugin_remote_path, $plugin_slug, '', $license_key );
	}
}
add_action( 'init', 'qcld_openaiaddon_activate_au' );


function qcld_openaiaddon_upgrade_completed( $upgrader_object, $options ) {
	// The path to our plugin's main file
	$plugin_slug = openaiaddon_LICENSING_PLUGIN_SLUG;
	// If an update has taken place and the updated type is plugins and the plugins element exists
	if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
		// Iterate through the plugins being updated and check if ours is there
		foreach( $options['plugins'] as $plugin ) {
			if( $plugin == $plugin_slug ) {
				deleteqc_openaiaddon_update_transient();
				deleteqc_openaiaddon_renew_transient();
			}
		}
	}
}
add_action( 'upgrader_process_complete', 'qcld_openaiaddon_upgrade_completed', 10, 2 );

add_action('admin_enqueue_scripts', 'qcld_openaiaddon_licensing_scripts');

function qcld_openaiaddon_licensing_scripts(){
	wp_enqueue_style('qcld_openaiaddon_licensing_style', plugin_dir_url( __FILE__ ).'/assets/css/style.css');

	//start new-update-for-codecanyon
	wp_enqueue_script('qcld_openaiaddon_licensing_script', plugin_dir_url( __FILE__ ).'/assets/js/script.js', array('jquery'), false, true );

	wp_localize_script( 'qcld_openaiaddon_licensing_script', 'wplivechat_licensing_admin_ajax', array(
			
			'ajax_url' => admin_url( 'admin-ajax.php' ), 
			'nonce' => wp_create_nonce( "wplivechat_licensing_admin_nonce" )
		)
	);
	//end new-update-for-codecanyon
}