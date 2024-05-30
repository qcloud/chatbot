<?php
define('openaiaddon_LICENSING_PLUGIN_SLUG', 'chatbot-openai-addon/qcld-bot-openai.php');
define('openaiaddon_LICENSING_PLUGIN_NAME', 'chatbot-openai-addon');
define('openaiaddon_LICENSING_DIR', plugin_dir_path(__DIR__));
define('openaiaddon_LICENSING_URL', plugin_dir_url( __FILE__ ));
define('openaiaddon_LICENSING_REMOTE_PATH', 'https://www.ultrawebmedia.com/li/plugins/chatbot-openai-addon/update.php');
define('openaiaddon_LICENSING_PRODUCT_DEV_URL', 'https://quantumcloud.com/products/');

//start new-update-for-codecanyon
define('openaiaddon_ENVATO_PLUGIN_ID', -1);
//end new-update-for-codecanyon

function get_openaiaddon_licensing_plugin_data(){
	include_once(ABSPATH.'wp-admin/includes/plugin.php');
	return get_plugin_data(openaiaddon_LICENSING_DIR.'/qcld-bot-openai.php', false);
}

//License Options
function get_openaiaddon_licensing_key(){
	return get_option('qcld_openaiaddon_enter_license_key');
}

function get_openaiaddon_envato_key(){
	return get_option('qcld_openaiaddon_enter_envato_key');
}

function get_openaiaddon_licensing_buy_from(){
	return get_option('qcld_openaiaddon_buy_from_where');
}


//Update Transients
function get_openaiaddon_update_transient(){
	return get_transient('qcld_update_openaiaddon_');
}

function set_openaiaddon_update_transient($plugin_object){
	return set_transient( 'qcld_update_openaiaddon_', serialize($plugin_object), 1 * DAY_IN_SECONDS  );
}

function delete_openaiaddon_update_transient(){
	return delete_transient( 'qcld_update_openaiaddon_' );
}


//Renewal Transients
function get_openaiaddon_renew_transient(){
	return get_transient('qcld_renew_openaiaddon__subscription');
}

function set_openaiaddon_renew_transient($plugin_object){
	return set_transient( 'qcld_renew_openaiaddon__subscription', serialize($plugin_object), 1 * DAY_IN_SECONDS  );
}

function delete_openaiaddon_renew_transient(){
	return delete_transient( 'qcld_renew_openaiaddon__subscription' );
}


//Invalid License Options
function get_openaiaddon_invalid_license(){
	return get_option('openaiaddon_invalid_license');
}

function set_openaiaddon_invalid_license(){
	return update_option('openaiaddon_invalid_license', 1);
}

function delete_openaiaddon_invalid_license(){
	return delete_option('openaiaddon_invalid_license');
}
function openaiaddon__get_licensing_url(){
	return admin_url('admin.php?page=openai-panel_help');
}

//Valid License
function get_openaiaddon_valid_license(){
	return get_option('openaiaddon_valid_license');
}
function set_openaiaddon_valid_license(){
	return update_option('openaiaddon_valid_license', 1);
}
function delete_openaiaddon_valid_license(){
	return delete_option('openaiaddon_valid_license');
}

//staging or live 
function get_openaiaddon_site_type(){
	return get_option('qcld_openaiaddon_site_type');
}



//start new-update-for-codecanyon
function get_openaiaddon_license_purchase_code(){
	return get_option('qcld_openaiaddon_enter_license_or_purchase_key');
}

function get_openaiaddon_enter_license_notice_dismiss_transient(){
	return get_transient('get_openaiaddon_enter_license_notice_dismiss_transient');
}

function set_openaiaddon_enter_license_notice_dismiss_transient(){
	return set_transient('get_openaiaddon_enter_license_notice_dismiss_transient', 1, DAY_IN_SECONDS);
}

function get_openaiaddon_invalid_license_notice_dismiss_transient(){
	return get_transient('get_openaiaddon_invalid_license_notice_dismiss_transient');
}

function set_openaiaddon_invalid_license_notice_dismiss_transient(){
	return set_transient('get_openaiaddon_invalid_license_notice_dismiss_transient', 1, DAY_IN_SECONDS);
}
//end new-update-for-codecanyon