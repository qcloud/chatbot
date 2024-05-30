<div id="wp-chatbot-ball-container" class="wp-chatbot-template-01">
    <div class="wp-chatbot-container">
        <div class="wp-chatbot-product-container">
            <div class="wp-chatbot-product-details">
                <div class="wp-chatbot-product-image-col">
                    <div id="wp-chatbot-product-image"></div>
                </div>
                <!--wp-chatbot-product-image-col-->
                <div class="wp-chatbot-product-info-col">
                    <div class="wp-chatbot-product-reload"></div>
                    <div id="wp-chatbot-product-title" class="wp-chatbot-product-title"></div>
                    <div id="wp-chatbot-product-price" class="wp-chatbot-product-price"></div>
                    <div id="wp-chatbot-product-description" class="wp-chatbot-product-description"></div>
                    <div id="wp-chatbot-product-quantity" class="wp-chatbot-product-quantity"></div>
                    <div id="wp-chatbot-product-variable" class="wp-chatbot-product-variable"></div>
                    <div id="wp-chatbot-product-cart-button" class="wp-chatbot-product-cart-button"></div>
                </div>
                <!--wp-chatbot-product-info-col-->
                <a href="#" class="wp-chatbot-product-close"></a>
            </div>
            <!--            wp-chatbot-product-details-->
        </div>
        <!--        wp-chatbot-product-container-->
        <div id="wp-chatbot-board-container" class="wp-chatbot-board-container">
			<div class="wp-chatbot-header">
                <div id="wp-chatbot-desktop-reload" title="Reset"><span class="dashicons dashicons-update-alt"></span></div>
                <!-- <div id="wp-chatbot-desktop-close" title="<?php // echo(get_option('qlcd_wp_chatbot_close_lan') != '' ? get_option('qlcd_wp_chatbot_close_lan') : 'Close'); ?>"><i class="fa fa-times" aria-hidden="true"></i></div> -->
                <div id="wp-chatbot-desktop-close"><span class="dashicons dashicons-no"></span></div>
            </div>
            <!--wp-chatbot-header-->
            <div class="wp-chatbot-ball-inner wp-chatbot-content">
                <!-- only show on Mobile app -->
                <?php if(isset($template_app) && $template_app=='yes'){?>
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
            </div>
            <div class="wp-chatbot-footer">
                <div id="wp-chatbot-editor-container" class="wp-chatbot-editor-container">
                    <input id="wp-chatbot-editor" class="wp-chatbot-editor" required placeholder="<?php echo esc_attr(wpb_randmom_message_handle(unserialize(get_option('qlcd_wp_chatbot_send_a_msg')))); ?>"
                           >
                    <button type="button" id="wp-chatbot-send-message" class="wp-chatbot-button"><?php esc_html_e('Send', 'wpchatbot'); ?></button>
                </div>
                <!--wp-chatbot-editor-container-->
                <div class="wp-chatbot-tab-nav">
                    <ul>
                        <li><a class="wp-chatbot-operation-option" data-option="help" href="" title="<?php echo esc_html__('Help', 'wpchatbot'); ?>"></a></li>
                        
                        <li class="wp-chatbot-operation-active"><a class="wp-chatbot-operation-option" data-option="chat" href="" title="<?php echo esc_html__('Chat', 'wpchatbot'); ?>" ></a></li>
                        <li><a class="wp-chatbot-operation-option" data-option="support"  href="" title="<?php echo esc_html__('Support', 'wpchatbot'); ?>" ></a></li>
                    </ul>
                </div>
                <!--wp-chatbot-tab-nav-->
            </div>
            <!--wp-chatbot-footer-->
        </div>
        <!--        wp-chatbot-board-container-->
    </div>
</div>