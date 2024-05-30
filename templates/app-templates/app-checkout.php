<?php
get_header();
?>
<div id="wp-chatbot-app-checkout-container">
<?php
wp_enqueue_script( 'wc-checkout');
remove_action( 'wpcommerce_cart_collaterals', 'wpcommerce_cross_sell_display' );
echo do_shortcode('[wpcommerce_checkout]');
?>
</div>
<?php
get_footer();
?>
<script>
    // jQuery(function ($) {
    //     var ajaxurl = '<?php // echo admin_url('admin-ajax.php'); ?>';
    //     var nonce = '<?php // wp_create_nonce('login_nonce'); ?>';
    //     $("#wp-chatbot-app-checkout-container").parents("body").addClass("wpchatbot-app-checkout");
    //     $(document).on('click', '.wpcommerce-form-login input[type="submit"]', function (event) {
    //         event.preventDefault();
    //         var validatorDom=$('.wpcommerce-form-login>p').first();
    //         var validate="";
    //         var NonceName=$('#_wpnonce').attr('name');
    //         var NonceVal=$('#_wpnonce').val();
    //         var userName=$('#username').val();
    //         var password=$('#password').val();
    //         if(userName=="" || password=="" ){
    //             validate+='<p style="color:red"> User name & Password are required. </p>';
    //         }
    //         if(validate==""){
    //             var data = {'action': 'qcld_wb_chatbot_checkout_user_login','user_name': userName,'user_pass': password,'nonce_name': NonceName,'nonce_val':NonceVal};
    //             jQuery.post(ajaxurl, data, function (response) {
    //                 if(response=='yes'){
    //                     window.location.reload(true);
    //                 }else{
    //                     validatorDom.html('<p style="color:red"> User name Or Password or both are incorrect. </p>');
    //                     setTimeout(function () {
    //                         validatorDom.html('');
    //                     },5000);
    //                 }
    //             });
    //         }else{
    //             validatorDom.html(validate);
    //             setTimeout(function () {
    //                 validatorDom.html('');
    //             },5000);
    //         }
    //     });
    // });
</script>