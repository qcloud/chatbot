<?php if(get_option('enable_wp_chatbot_custom_color')==1 && get_option('wp_chatbot_theme_primary_color') && get_option('wp_chatbot_theme_primary_color')!=''): ?>
<style>
.wp-chatbot-tab-nav{
    background-color: <?php echo esc_attr( get_option('wp_chatbot_theme_primary_color') ); ?> !important;
}
.wp-chatbot-board-container:after {
    border-top: 30px solid <?php echo esc_attr( get_option('wp_chatbot_theme_primary_color') ); ?> !important;
}
</style>
<?php endif; ?>
<?php if(get_option('enable_wp_chatbot_custom_color')==1 && get_option('wp_chatbot_theme_secondary_color') && get_option('wp_chatbot_theme_secondary_color')!=''): ?>
<style>

.wp-chatbot-tab-nav ul li.wp-chatbot-operation-active a:before, .wp-chatbot-tab-nav ul li:hover a:before {
    border: 2px solid <?php echo esc_attr( get_option('wp_chatbot_theme_secondary_color') ); ?> !important;
}
.wp-chatbot-tab-nav ul li a[data-option="chat"]:after {

    border: 3px solid <?php echo esc_attr( get_option('wp_chatbot_theme_secondary_color') ); ?> !important;
}

</style>
<?php endif; ?>
<div id="wp-chatbot-ball-container" class="template-vertical" aria-haspopup aria-live="polite" aria-expanded="false">
    <?php do_action('render_start_menu'); ?>
	<div class="wpbot-saas-live-chat">
  
	</div>
    <div class="wp-chatbot-container">

        <?php 
            if(function_exists('qcpd_wpwc_addon_lang_init')){
                do_action('qcld_wpwc_product_details_woocommerce');
            }

        ?>
        <!--        wp-chatbot-product-container-->
        <div id="wp-chatbot-board-container" class="wp-chatbot-board-container">
            
            <div class="wp-chatbot-header">
                <?php do_action('render_back_to_menu_button'); ?>
                <div id="wp-chatbot-desktop-reload" title="<?php echo esc_attr( (get_option('qlcd_wp_chatbot_reset_lan') != '' ? get_option('qlcd_wp_chatbot_reset_lan') : 'Reset') ); ?>"><span class="dashicons dashicons-update-alt"></span></div>
                
                <div id="wp-chatbot-desktop-close" title="<?php echo esc_attr( (get_option('qlcd_wp_chatbot_close_lan') != '' ? get_option('qlcd_wp_chatbot_close_lan') : 'Close') ); ?>"><span class="dashicons dashicons-no"></span</div>
           
                <?php 
                    if( function_exists( 'qcld_wpbotml' ) && count( qcld_wpbotml()->languages ) > 1){
                        do_action('ml_render_lan_dropdown');
                    }
                ?>
            </div>
            
            <!--wp-chatbot-header-->
            <div class="wp-chatbot-ball-inner wp-chatbot-content">
                <!-- only show on Mobile app -->
                <?php if (isset($template_app) && $template_app == 'yes') { ?>
                    <div class="wp-chatbot-cart-checkout-wrapper">
                        <div id="wp-chatbot-cart-short-code">
                        </div>
                        <div id="wp-chatbot-checkout-short-code">
                        </div>
                    </div>
                <?php } ?>
                <div class="wp-chatbot-messages-wrapper">
                    <ul id="wp-chatbot-messages-container" class="wp-chatbot-messages-container">
                    </ul>
                </div>
                <?php do_action('wpbot_voice_record_wrapper'); ?>
            </div>
            <div class="wp-chatbot-footer">
               
                <div id="wp-chatbot-editor-container" class="wp-chatbot-editor-container">
                    <input id="wp-chatbot-editor" class="wp-chatbot-editor" required placeholder="<?php echo esc_attr(wpb_randmom_message_handle(unserialize(get_option('qlcd_wp_chatbot_send_a_msg')))); ?>"
                           >
                    <button type="button" id="wp-chatbot-send-message" class="wp-chatbot-button"><?php esc_html_e('', 'wpchatbot'); ?></button>
                </div>
                <!--wp-chatbot-editor-container-->
                <?php if(get_option('enable_wp_chatbot_disable_allicon')!='1'): ?>
                <div class="wp-chatbot-tab-nav">
                    <ul>
                    <?php if(get_option('enable_wp_chatbot_disable_helpicon')!='1'): ?>
                        <li><a class="wp-chatbot-operation-option" data-option="help" href="" title="<?php echo esc_attr( (get_option('qlcd_wp_chatbot_help')?qcld_wpb_randmom_message_handle(maybe_unserialize(get_option('qlcd_wp_chatbot_help'))):esc_html__('Help', 'wpchatbot')) ); ?>"></a></li>
                    <?php endif; ?>
                    <?php if(get_option('enable_wp_chatbot_disable_supporticon')!='1'): ?>
                        <li><a class="wp-chatbot-operation-option" data-option="support" href="" title="<?php echo esc_attr( (get_option('qlcd_wp_chatbot_support')?qcld_wpb_randmom_message_handle(maybe_unserialize(get_option('qlcd_wp_chatbot_support'))):esc_html__('Support', 'wpchatbot')) ); ?>"></a></li>
                    <?php endif; ?>
                    
					
                        <?php 
                            if(function_exists('qcpd_wpwc_addon_lang_init')){
                                do_action('qcld_wpwc_template_bottom_icon_woocommerce', $cart_items_number);
                            }

                        ?>

                    <?php if(get_option('enable_wp_chatbot_disable_chaticon')!='1'): ?>
                        <li class="wp-chatbot-operation-active"><a class="wp-chatbot-operation-option" data-option="chat" href="" title="<?php echo esc_attr( (get_option('qlcd_wp_chatbot_skip_conversation')?qcld_wpb_randmom_message_handle(maybe_unserialize(get_option('qlcd_wp_chatbot_skip_conversation'))):'Click this button to skip the conversation') ); ?>"></a></li>
                     <?php endif; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <!--wp-chatbot-tab-nav-->
            </div>
            <!--wp-chatbot-footer-->
        </div>
        <!--        wp-chatbot-board-container-->
    </div>
</div>
