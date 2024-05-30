<?php
get_header(); ?>
<?php
if ($_GET['order_id']) {
    global $wpcommerce;
    $order = wc_get_order($_GET['order_id']);
}
?>
    <script>
        jQuery(function ($) {
            $(".wpchatbot-wpcommerce-order").parents("body").addClass("wpchatbot-app-order-confirmation");
        })
    </script>
    <div class="wpchatbot-wpcommerce-order">
        <?php if ($order) : ?>
            <?php if ($order->has_status('failed')) : ?>
                <p class="wpcommerce-notice wpcommerce-notice--error wpcommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'wpcommerce'); ?></p>
                <p class="wpcommerce-notice wpcommerce-notice--error wpcommerce-thankyou-order-failed-actions">
                    <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                       class="button pay"><?php esc_html_e('Pay', 'wpcommerce') ?></a>
                    <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                           class="button pay"><?php esc_html_e('My account', 'wpcommerce'); ?></a>
                    <?php endif; ?>
                </p>
            <?php else : ?>
                <?php // phpcs:ignore ?>
                <p class="wpcommerce-notice wpcommerce-notice--success wpcommerce-thankyou-order-received"><?php echo apply_filters('wpcommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'wpcommerce'), $order); ?></p>
                <ul class="wpcommerce-order-overview wpcommerce-thankyou-order-details order_details">
                    <li class="wpcommerce-order-overview__order order">
                        <?php esc_html_e('Order number:', 'wpcommerce'); ?>
                        <strong><?php echo esc_html( $order->get_order_number() ); ?></strong>
                    </li>
                    <li class="wpcommerce-order-overview__date date">
                        <?php esc_html_e('Date:', 'wpcommerce'); ?>
                        <strong><?php echo esc_html( wc_format_datetime($order->get_date_created()) ); ?></strong>
                    </li>
                    <li class="wpcommerce-order-overview__total total">
                        <?php esc_html_e('Total:', 'wpcommerce'); ?>
                        <strong><?php echo esc_html( $order->get_formatted_order_total() ); ?></strong>
                    </li>
                    <?php if ($order->get_payment_method_title()) : ?>
                        <li class="wpcommerce-order-overview__payment-method method">
                            <?php esc_html_e('Payment method:', 'wpcommerce'); ?>
                            <strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
            <?php do_action('wpcommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
            <?php do_action('wpcommerce_thankyou', $order->get_id()); ?>
        <?php else : ?>
            <?php // phpcs:ignore ?>
            <p class="wpcommerce-notice wpcommerce-notice--success wpcommerce-thankyou-order-received"><?php echo apply_filters('wpcommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'wpcommerce'), null); ?></p>
        <?php endif; ?>
        <button class="wpchatbot-app-home-back"><?php esc_html_e('Tap on logo to go home', 'wpchatbot'); ?></button>
    </div>
<?php
get_footer();