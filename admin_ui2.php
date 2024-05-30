<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wpdb;
$tableuser    = $wpdb->prefix.'wpbot_sessions';
$session_exists = $wpdb->get_row($wpdb->prepare("select * from $tableuser where 1 and id = %d",1)); //DB Call OK, No Caching OK

if(!empty($session_exists)){
    $total_session = $session_exists->session;
}else{
    $total_session = 0;
}
?>
<div class="wrap">
    <h1 class="wpbot_header_h1"><?php echo esc_html__('', 'wpchatbot'); ?> </h1>
</div>
<div class="wp-chatbot-wrap">
    <div class="wpbot_dashboard_header container"><h1><?php esc_html_e('WPBot Dashboard', 'wpbot'); ?></h1></div>
    <div class="wpbot_addons_section container">
        <div class="wpbot_single_addon_wrapper">
            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/icon-0.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('WPBot Free', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                            <span class="wp_addon_installed"><?php esc_html_e('Installed', 'wpbot'); ?></span>
                            <p><?php esc_html_e('Wordpress Chatbot by QuantumCloud', 'wpbot'); ?></p>
                            <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=wpbot')); ?>" > <?php esc_html_e('Settings', 'wpbot'); ?></a>
							<a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" > <?php esc_html_e('Upgrade to Pro', 'wpbot'); ?></a>
                        </div>            
                    </div>

                </div>

            </div>
        
			<div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/woo-addon-256.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"> <?php esc_html_e('Bot - Woocommerce Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if(class_exists('QCLD_MAILING_LIST_INTEGRATION_ADDON')){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot') .'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot') .'</span>';
                            } ?>
                        
                            <p><?php esc_html_e('WooCommerce ChatBot', 'wpbot'); ?></p>
                            <?php if(function_exists('qcpd_wpwc_addon_lang_init')){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=wpwc-settings-page')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>
		
            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/WPBot-LiveChat.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Bot - Live Chat', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">

                            <span class="wp_addon_notinstalled"> <?php esc_html_e('Not Installed', 'wpbot'); ?></span>

                            <p><?php esc_html_e('Live Chat integrated with WPBot Pro ', 'wpbot'); ?></p>
                            <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                
                        </div>            
                    </div>

                </div>

            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/conversational-forns.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"> <?php esc_html_e('Bot - Conversational Form', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">

                            <?php if(function_exists('qc_formbuilder_do_calculation')){
                                $cfb = 'Pro';
                            }else{
                                $cfb = 'Free';
                            } ?>

                            <?php if(function_exists('qcformbuilder_forms_load')){
                                echo '<span class="wp_addon_installed">Installed '. esc_html( $cfb ).'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot') .'</span>';
                            } ?>
                            <p><?php esc_html_e('Conversational form builder Module', 'wpbot'); ?></p>
                            <?php if(function_exists('qcformbuilder_forms_load')){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=qcformbuilder-forms')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php if($cfb=='Free'): ?>
                                <a class="button button-secondary" href="https://www.quantumcloud.com/products/conversations-and-form-builder/" target="_blank" >Upgrade to Pro <?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php endif; ?>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>

                </div>

            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/custom-post-type-addon-logo.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Bot - Extended Search', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                            <span class="wp_addon_notinstalled"> <?php esc_html_e('Not Installed', 'wpbot'); ?></span>
                            
                            <p><?php esc_html_e('Extend Bot’s search power for WPBot Pro', 'wpbot'); ?></p>

                            <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                
                        </div>            
                    </div>
                </div>
            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/messenger-chatbot.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Bot - Messenger', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                            
							<?php if(function_exists('qcpd_wpfb_messenger_checking_dependencies')){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot') .'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot').'</span>';
                            } ?>
							
                            
                            
                            <p><?php esc_html_e('Messenger Chatbot for WPBot Pro', 'wpbot'); ?></p>
                            
							<?php if(function_exists('qcpd_wpfb_messenger_checking_dependencies')){
                                ?>
                            <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=wbfb-botsetting-page')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
							<?php }else{ ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
							<?php } ?>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/chatbot-sesssion-save.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Bot - Session Save', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                            
                            <span class="wp_addon_notinstalled"><?php esc_html_e('Not Installed', 'wpbot'); ?></span>
                            <p><?php esc_html_e('Chat sessions for WPBot Pro', 'wpbot'); ?></p>
                            
                            <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                               
                        </div>            
                    </div>
                </div>
            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/white-label.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Bot - White Label', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                            <span class="wp_addon_notinstalled"><?php esc_html_e('Not Installed', 'wpbot'); ?></span>
                            <p><?php esc_html_e('Replace the branding for WPBot Pro', 'wpbot'); ?></p>
                            <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>

                        </div>            
                    </div>
                </div>
            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/mailing-list-integrationt%20(1).png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Bot - Mailing List Integration', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        
                            <span class="wp_addon_notinstalled"><?php esc_html_e('Not Installed', 'wpbot'); ?></span>

                            <p><?php esc_html_e('Mailchimp and Zapier for WPBot Pro', 'wpbot'); ?></p>
                            
                            <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                
                        </div>            
                    </div>
                </div>
            </div>
			<div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/simple-text-responses.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Chatbot STR Pro Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if(function_exists('qcld_str_pro_dependency')){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot').'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot').'</span>';
                            } ?>
                        
                            <p><?php esc_html_e('Addon plugin that extends feature of STR', 'wpbot'); ?></p>
                            <?php if(function_exists('qcld_str_pro_dependency')){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=simple-text-response')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>
			<div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/muli-lamguage.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Multi Language Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if(class_exists('Qcld_Wpbot_Multilanguage')){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot').'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'.esc_html__('Not Installed', 'wpbot').'</span>';
                            } ?>
                        
                            <p><?php esc_html_e('Add multiple language for your ChatBot', 'wpbot'); ?></p>
                            <?php if(class_exists('Qcld_Wpbot_Multilanguage')){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=wpbotml-settings-page')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/voice-message.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Voice Message Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if( is_plugin_active( 'voice-message-addon/wpbotvoicemessage.php' ) ){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot'). '</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot') . '</span>';
                            } ?>
                        
                            <p><?php esc_html_e('Voice Message Module for your ChatBot', 'wpbot'); ?></p>
                            <?php if( is_plugin_active( 'voice-message-addon/wpbotvoicemessage.php' ) ){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('edit.php?post_type=qcldcontacter_record&page=qcld_wpvm_vmwbmdp_contacter_settings')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/telegram-addon.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Telegram Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if( is_plugin_active( 'telegram-chatbot-addon/init.php' ) ){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot') .'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot') .'</span>';
                            } ?>
                        
                            <p> <?php esc_html_e('To connect telegram with chatbot', 'wpbot'); ?></p>
                            <?php  if( is_plugin_active( 'telegram-chatbot-addon/init.php' ) ){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=simple-text-response')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>
			<div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/openAI.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Open AI Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if( is_plugin_active( 'chatbot-openai-addon/qcld-bot-openai.php' ) ){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot').'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot').'</span>';
                            } ?>
                        
                            <p><?php esc_html_e('To connect open AI with your ChatBot', 'wpbot'); ?></p>
                            <?php if( is_plugin_active( 'chatbot-openai-addon/qcld-bot-openai.php' ) ){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('admin.php?page=wpbotml-settings-page')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>

            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/templates-addon.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Extended UI Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if( is_plugin_active( 'chatbot-extended-ui/chatbot-extended-ui.php' ) ){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot').'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot') .'</span>';
                            } ?>
                        
                            <p><?php esc_html_e('Extended UI of ChatBot', 'wpbot'); ?></p>
                            <?php if( is_plugin_active( 'chatbot-extended-ui/chatbot-extended-ui.php' ) ){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('edit.php?post_type=qcldcontacter_record&page=qcld_wpvm_vmwbmdp_contacter_settings')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>
            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/WhatsApp-chatbot.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Whatsapp Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if( is_plugin_active( 'whatsapp-chatbot-addon/whatsapp-chatbot-addon.php' ) ){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot') .'</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot') .'</span>';
                            } ?>
                        
                            <p><?php esc_html_e('Connect Whatsapp with ChatBot', 'wpbot'); ?></p>
                            <?php if( is_plugin_active( 'whatsapp-chatbot-addon/whatsapp-chatbot-addon.php' ) ){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('edit.php?post_type=qcldcontacter_record&page=qcld_wpvm_vmwbmdp_contacter_settings')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>
            <div class="wpbot_single_addon">
                <div class="wpbot_single_content">
                    <div class="wpbot_addon_image">
                        <img src="<?php echo esc_url(QCLD_wpCHATBOT_PLUGIN_URL.'images/voice-logo.png'); ?>" title="" />
                    </div>
                    <div class="wpbot_addon_content">
                        <div class="wpbot_addon_title"><?php esc_html_e('Voice Module', 'wpbot'); ?></div>
                        <div class="wpbot_addon_details">
                        <?php if( is_plugin_active( 'voice-addon/init.php' ) ){
                                echo '<span class="wp_addon_installed">'. esc_html__('Installed', 'wpbot') . '</span>';
                            }else{
                                echo '<span class="wp_addon_notinstalled">'. esc_html__('Not Installed', 'wpbot').'</span>';
                            } ?>
                        
                            <p><?php esc_html_e('Add google voice assist with ChatBot', 'wpbot'); ?></p>
                            <?php if( is_plugin_active( 'voice-addon/init.php' ) ){
                                ?>
                                <a class="button button-secondary" href="<?php echo esc_url(admin_url('edit.php?post_type=qcldcontacter_record&page=qcld_wpvm_vmwbmdp_contacter_settings')); ?>" ><?php esc_html_e('Settings', 'wpbot'); ?></a>
                                <?php
                            }else{
                                ?>
                                <a class="button button-secondary" href="https://www.wpbot.pro/" target="_blank" ><?php esc_html_e('Get It Now', 'wpbot'); ?></a>
                                <?php
                            } ?>
                        </div>            
                    </div>
                </div>
            </div>
            <div style="clear:both"></div>
            
        </div>
		<div class="wpbot_statistics_area">
                <h2> <?php esc_html_e('WPBot Statistics', 'wpbot'); ?></h2>
                <div class="wpbot_report">
                    
                    <p><span class="wpbot_report_key"><?php esc_html_e('Total ChatBot Sessions', 'wpbot'); ?></span>:<span class="wpbot_report_value"><?php echo esc_html($total_session); ?></span></p>

                </div>
        </div>

    </div>
</div>