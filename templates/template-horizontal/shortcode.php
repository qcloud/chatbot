<div id="wp-chatbot-shortcode-template-container"
     class="<?php echo esc_attr($wp_chatbot_enable_rtl);?> wp-chatbot-shortcode-template-container template-vertical">
    <div class="wp-chatbot-product-container">
        <div class="wp-chatbot-product-details">
            <div class="wp-chatbot-product-image-col">
                <div id="wp-chatbot-product-image"></div>
            </div>
            
            <!--wp-chatbot-product-image-col-->
            <div class="wp-chatbot-product-info-col">
                <div id="wp-chatbot-product-title" class="wp-chatbot-product-title"></div>
                <div id="wp-chatbot-product-price" class="wp-chatbot-product-price"></div>
                <div id="wp-chatbot-product-description" class="wp-chatbot-product-description"></div>
                <div id="wp-chatbot-product-quantity" class="wp-chatbot-product-quantity"></div>
                <div id="wp-chatbot-product-variable" class="wp-chatbot-product-variable"></div>
                <div id="wp-chatbot-product-cart-button" class="wp-chatbot-product-cart-button"></div>
            </div>
            <!--wp-chatbot-product-info-col-->
            <a class="wp-chatbot-product-close"></a>
        </div>
        <!--            wp-chatbot-product-details-->
    </div>
    <div class="chatbot-shortcode-row">
        <div class="chatbot-sidebar chatbot-left-sidebar">
            <div class="wp-chatbot-widget wp-chatbot-product-shortcode-container">
               
            </div>
            <!--wp-chatbot-widget-->
        </div>

        <div class="wpbot-saas-live-chat">
    
        </div>
        <!--wp-chatbot-sidebar-->
        <div class="wp-chatbot-container">
            <div class="wp-chatbot-header">
                
            <h3> <?php if (get_option('qlcd_wp_chatbot_host') != '') {
                        $welcomes = qcld_wpb_randmom_message_handle(qcld_wpbot()->helper->qcld_wb_chatbot_str_replace(maybe_unserialize(get_option('qlcd_wp_chatbot_welcome'))));
                        $host = qcld_wpb_randmom_message_handle(qcld_wpbot()->helper->qcld_wb_chatbot_str_replace(maybe_unserialize(get_option('qlcd_wp_chatbot_host'))));
                        
                        echo esc_html( $welcomes . ' ' . $host );
                    } ?></h3>
            <?php 
                if( function_exists( 'qcld_wpbotml' ) && count( qcld_wpbotml()->languages ) > 1){
                    do_action('ml_render_lan_dropdown');
                }
            ?>
            </div>
            <!--wp-chatbot-header-->
            <div class="wp-chatbot-ball-inner  wp-chatbot-content">
                <div class="wp-chatbot-messages-wrapper">
                    <ul id="wp-chatbot-messages-container" class="wp-chatbot-messages-container">
                    </ul>
                </div>
                <?php do_action('wpbot_voice_record_wrapper'); ?>
                <!--wp-chatbot-messages-wrapper-->
            </div>
            <!--wp-chatbot-ball-inner-->
            <div class="wp-chatbot-footer">
                <div id="wp-chatbot-editor-area" class="wp-chatbot-editor-area">
                    <input id="wp-chatbot-editor" class="wp-chatbot-editor" required="" placeholder="<?php echo esc_attr( qcld_wpb_randmom_message_handle(maybe_unserialize(get_option('qlcd_wp_chatbot_send_a_msg'))) ); ?>"
                           >
                    <?php do_action('wpbot_voice_icon'); ?>
                    <button type="button" id="wp-chatbot-send-message" class="wp-chatbot-button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
                <!--wp-chatbot-editor-container-->
            </div>
            <!--wp-chatbot-footer-->
        </div>
        <!--wp-chatbot-container-->
        <div class="chatbot-sidebar chatbot-left-sidebar">
            <div class="wp-chatbot-widget">
                <div class="chatbot-agent">
                    <?php
                    if (get_option('wp_chatbot_icon') == "custom.png") {
                        $wp_chatbot_custom_icon_path = get_option('wp_chatbot_custom_icon_path');
                    } else if (get_option('wp_chatbot_icon') != "custom.png") {
                        $wp_chatbot_custom_icon_path = QCLD_wpCHATBOT_IMG_URL . get_option('wp_chatbot_icon');
                    } else {
                        $wp_chatbot_custom_icon_path = QCLD_wpCHATBOT_IMG_URL . 'custom.png';
                    }
                    ?>
                    <img src="<?php echo esc_url( $wp_chatbot_custom_icon_path ); ?>" alt="Agent Image">
                    <h3 class="chatbot-agent-name"><?php echo esc_html( qcld_wpb_randmom_message_handle(maybe_unserialize(get_option('qlcd_wp_chatbot_agent'))) ); ?></h3>
                </div>
                <!--chatbot-agent-->
            </div>
            <!--wp-chatbot-widget-->
            <div class="wp-chatbot-widget wp-chatbot-cart-shortcode-container">
                
            </div>
            <!--wp-chatbot-widget-->
        </div>
        <!--wp-chatbot-sidebar-->
    </div>
    <!--    .chatbot-shortcode-row-->
</div>
<!--wp-chatbot-ball-container-->