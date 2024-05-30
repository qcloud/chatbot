<?php

class OpenAi_WPBot_Menus
{
    function  __construct(){
        //add_action('admin_menu',[$this,'chatbot_menu']);
    }
    public function chatbot_menu()
    {
		global $custom_hook, $submenu;
        // add_menu_page( openai_menu_text(), 'Bot - OpenAI', 'manage_options','openai-panel_dashboard', [$this, 'qcld_wb_chatbot_admin_page'],'');
        // add_submenu_page( 'openai-panel_dashboard', 'File Upload', 'File Upload', 'manage_options','openai-panel_file', [$this, 'qcld_wb_chatbot_openai_file'] );
        // add_submenu_page( 'openai-panel_dashboard', 'Help', 'Help', 'manage_options','openai-panel_help', [$this, 'qcld_wb_chatbot_admin_page_help'] );
      //  echo '<pre>'; print_r( $submenu['openai-panel_dashboard'] ); echo '</pre>'; exit();
    }
    public function qcld_wb_chatbot_admin_page()
    {
       // global $woocommerce;
        $action = 'admin.php?page=openai-panel_dashboard';
        require_once( QCLD_openai_addon_PLUGIN_DIR_PATH . "includes/admin/admin_ui2.php");
    }
    public function qcld_wb_chatbot_openai_file(){
      $action = 'admin.php?page=openai-panel_file';
        require_once( QCLD_openai_addon_PLUGIN_DIR_PATH . "includes/admin/files.php");
    }

    public function qcld_wb_chatbot_admin_page_help()
    {
      
      $action = 'admin.php?page=openai-panel_help';
       require_once( QCLD_openai_addon_PLUGIN_DIR_PATH . "includes/admin/help.php" );
    }
    public function screen_option(){
		global $custom_hook;
		$screen = get_current_screen();
	
        $option = 'per_page';
		$args   = [
			'label'   => 'Response',
			'default' => 25,
			'option'  => 'str_responses_per_page'
		];
		add_screen_option( $option, $args );
		qcld_wpbot()->set_response_list();
    }
}


//fire off the plugin
 new OpenAi_WPBot_Menus();
