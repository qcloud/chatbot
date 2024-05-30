jQuery(function ($) {
    //Global object passed by admin
    var wpChatBotVar = wp_chatbot_obj;
	
    var LoadwpwBotPlugin = 0;
    var textEditorHandler = 0;
    if( typeof(openingHourIsFn) !='undefined'){
        var openingHourIs = openingHourIsFn;
    }else{
        var openingHourIs = 0;
    }

    wpChatBotVar.exit_intent_handler = 0;
    wpChatBotVar.scroll_open_handler = 0;
    wpChatBotVar.auto_open_handler = 0;
    wpChatBotVar.re_target_handler = 0;
    
    $(document).ready(function () {
        if(typeof(wpbot_clear_cache) !=="undefined" && wpbot_clear_cache !=''){
            wpwKits.reset();
            LoadwpwBotPlugin = 0;
        }
		var botimage = jQuery('#wp-chatbot-ball').find('img').attr('qcld_agent');
        if ($('#wp-chatbot-shortcode-template-container').length == 0 && $('#wp-chatbot-chat-app-shortcode-container').length == 0) {
            //Main wpwbot area.
            //show it
            $('#wp-chatbot-ball-wrapper').css({
                'display': 'block',
            });
            //wpChatBot icon  position.
            $('#wp-chatbot-chat-container').css({
                'right': wpChatBotVar.wp_chatbot_position_x + 'px',
                'bottom': wpChatBotVar.wp_chatbot_position_y + 'px'
            })
            //Facebook Messenger desktop
            setTimeout(function () {
                $('.fb_dialog').css({
                    'right': parseInt(55 + parseInt(wpChatBotVar.wp_chatbot_position_x)) + 'px',
                    'bottom': parseInt(17 + parseInt(wpChatBotVar.wp_chatbot_position_y)) + 'px',
                    'visibility': 'visible'
                });
            }, 3000);

            //wpchatbot icon animation disable or enable
            //Disable wpwBot icon Animation
            if (wpChatBotVar.disable_icon_animation == 1) {
                $('.wp-chatbot-ball').addClass('wp-chatbot-animation-deactive');
            } else {
                $('.wp-chatbot-ball').addClass('wp-chatbot-animation-active');

                //wpchatbot icon animation timing
                //var itemHide = function(){
                //    $('.wp-chatbot-animation-active .wp-chatbot-ball-animation-switch').css({
                //        "opacity": 0,
                //    })
                //};
                var itemHide = function () {
                    $('.wp-chatbot-animation-active .wp-chatbot-ball-animation-switch').fadeOut(1000);
                };
                setTimeout(function () {
                    itemHide()
                }, 1000);

                //Click Animation
                $('.wp-chatbot-animation-active').click(function () {
                    $('.wp-chatbot-animation-active .wp-chatbot-ball-animation-switch').fadeIn(100);
                    setTimeout(function () {
                        itemHide()
                    }, 1000);
                });
            }

            //window resize.
            var widowH = $(window).height();
            var widowW = $(window).width();
            if (widowW > 767) {
                var ballConH = parseInt(widowH * 0.5)+ parseInt(114);
                //$('.wp-chatbot-ball-inner').css({'height': ballConH + 'px'})

                $(window).resize(function () {
                    var widowH = $(window).height();
                    var ballConH = parseInt(widowH * 0.5)+ parseInt(114);
                    //$('.wp-chatbot-ball-inner').css({'height': ballConH + 'px'})
                });
            };

            $(document).on('click', '#wp-chatbot-ball', function (event) {
				
				if($('.active-chat-board').length>0){
                    if(wpChatBotVar.template=='template-06' || wpChatBotVar.template=='template-07'){
                        $('#wp-chatbot-ball').show();
                    }
					$('#wp-chatbot-ball').removeClass('wpbot_chatopen_iconanimation');
					$('#wp-chatbot-ball').addClass('wpbot_chatclose_iconanimation');
					$('#wp-chatbot-ball').find('img').attr('src', botimage)		
                    $('.wp-chatbot-ball').css('background', '#ffffff');


				}else{

					$('#wp-chatbot-ball').removeClass('wpbot_chatclose_iconanimation');
					$('#wp-chatbot-ball').addClass('wpbot_chatopen_iconanimation');
					$('#wp-chatbot-ball').find('img').attr('src', wpChatBotVar.imgurl+'wpbot-close-icon.png');
                    //$('.wp-chatbot-ball').css('background', 'unset');


				}
				
                $("#wp-chatbot-board-container").toggleClass('active-chat-board');
                wpwbot_board_action();

            });
            //wpwBot proActive start
            //Attention on
            if(wpChatBotVar.enable_meta_title==1 && wpChatBotVar.meta_label!="") {
                var MetaTitleInterval;
                var orginalTitle = document.title;
                $(document).on("mouseover", 'body', function (e) {
                    document.title = orginalTitle;
                    clearInterval(MetaTitleInterval);
                });
            }
            //Exit Intent
            if(wpChatBotVar.enable_exit_intent == 1){
                window.addEventListener("mouseout", function (e) {
                    e = e ? e : window.event;

                    // If this is an autocomplete element.
                    if (e.target.tagName.toLowerCase() == "input")
                        return;

                    // Get the current viewport width.
                    var vpWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

                    // If the current mouse X position is within 50px of the right edge
                    // of the viewport, return.
                    if (e.clientX >= (vpWidth - 50))
                        return;

                    // If the current mouse Y position is not within 50px of the top
                    // edge of the viewport, return.
                    if (e.clientY >= 50)
                        return;

                    // Reliable, works on mouse exiting window and
                    // user switching active program
                    var from = e.relatedTarget || e.toElement;
                    if (!from)
                       //if will open once if setup from backend.
                        var exitIntentOpen=true;
                        if($.cookie('exit_intent')=='yes' && wpChatBotVar.exit_intent_once==1) {
                            exitIntentOpen=false;
                        }
                            if ($('.active-chat-board').length == 0 && exitIntentOpen==true) {
                                if (wpChatBotVar.exit_intent_handler == 0) {
                                    $("#wp-chatbot-board-container").addClass('active-chat-board');
                                    wpChatBotVar.exit_intent_handler++;
                                    wpChatBotVar.re_target_handler = 1;
                                    wpwbot_board_action();
                                    //Shopper Name
                                    if(localStorage.getItem('shopper')){
                                        var shopper=localStorage.getItem('shopper');
                                    }else{
                                        var shopper=wpChatBotVar.shopper_demo_name;
                                    }
                                    setTimeout(function () {
                                        if (localStorage.getItem("wpwHitory")) {
                                            showing_proactive_msg( wpChatBotVar.ret_greet+' '+shopper +', '+wpChatBotVar.exit_intent_msg);
                                        } else {
                                            showing_proactive_double_msg(wpChatBotVar.ret_greet+' '+shopper+', '+wpChatBotVar.exit_intent_msg)
                                        }
                                        $.cookie('exit_intent','yes');
                                       //pro active sound
                                        proactive_retargeting_sound();
                                        //Window foucus meta title change.
                                        window_focus_change_meta_title();
                                    }, 1000)
                                }
                            }
                });
            }
            if(wpChatBotVar.enable_scroll_open==1){

                $(document).on('scroll', function (event) {
                        var OpenScroll=true;
                        //if will open once if setup from backend.
                       if( $.cookie('scroll_open')=='yes' && wpChatBotVar.scroll_open_once==1) {
                           OpenScroll=false;
                       }
                        //it will be open only for single time.
                        if ($('.active-chat-board').length ==0 && OpenScroll==true) {
                            if (wpChatBotVar.scroll_open_handler == 0) {
                                var scrollOpenVal = parseInt(($(document).height() * wpChatBotVar.scroll_open_percent) / 100);
                                if ($(window).scrollTop() + $(window).height() > scrollOpenVal) {
                                   $("#wp-chatbot-board-container").addClass('active-chat-board');
                                    wpChatBotVar.scroll_open_handler++;
                                    wpChatBotVar.re_target_handler = 2;
                                    wpwbot_board_action();
                                    //Shopper Name
                                    if(localStorage.getItem('shopper')){
                                        var shopper=localStorage.getItem('shopper');
                                    }else{
                                        var shopper=wpChatBotVar.shopper_demo_name;
                                    }
                                    setTimeout(function () {
                                        if (localStorage.getItem("wpwHitory")) {
                                            showing_proactive_msg(wpChatBotVar.ret_greet+' '+ shopper+', '+wpChatBotVar.scroll_open_msg);
                                        } else {
                                            showing_proactive_double_msg(wpChatBotVar.ret_greet+' '+ shopper+', '+wpChatBotVar.scroll_open_msg)
                                        }
                                        $.cookie('scroll_open','yes');
                                        //pro active sound
                                        proactive_retargeting_sound();
                                        //Window foucus meta title change.
                                        window_focus_change_meta_title();
                                    }, 1000)
                                }
                            }
                        }

                });
            }
            if(wpChatBotVar.enable_auto_open==1 ){
                //if will open once if setup from backend.
                var autoOpen=true;
                if($.cookie('auto_open')=='yes' && wpChatBotVar.auto_open_once==1) {
                    autoOpen=false;
                }
                if( wpChatBotVar.auto_open_handler == 0 && autoOpen==true) {
                    setTimeout(function (e) {
                        if ($('.active-chat-board').length == 0) {
                            $("#wp-chatbot-board-container").addClass('active-chat-board');
                            wpChatBotVar.auto_open_handler++;
                            wpChatBotVar.re_target_handler = 3;
                            wpwbot_board_action();
                            //Shopper Name
                            if(localStorage.getItem('shopper')){
                                var shopper=localStorage.getItem('shopper');
                            }else{
                                var shopper=wpChatBotVar.shopper_demo_name;
                            }
                            setTimeout(function () {
                                if (localStorage.getItem("wpwHitory")) {
                                    showing_proactive_msg(wpChatBotVar.ret_greet+' '+ shopper+', '+wpChatBotVar.auto_open_msg);
                                } else {
                                    showing_proactive_double_msg(wpChatBotVar.ret_greet+' '+shopper+', '+wpChatBotVar.auto_open_msg)
                                }
                                $.cookie('auto_open','yes');
                                //pro active sound
                                proactive_retargeting_sound();
                                //Window foucus meta title change.
                                window_focus_change_meta_title();
                            }, 1000)
                        }
                    }, parseInt(wpChatBotVar.auto_open_time * 1000));
                }
            }
            //Retargeting for Cart to complete checkout.
            if(wpChatBotVar.enable_ret_user_show==1 && localStorage.getItem("wpwHitory") && $.cookie('return_user')!='yes') {

                $.cookie('return_user','yes');
                var data = {'action': 'qcld_wb_chatbot_only_cart'};
                jQuery.post(wpChatBotVar.ajax_url, data, function (response) {
                    if (response.items > 0) {
                        if ($('.active-chat-board').length == 0) {
                            setTimeout(function () {
                                $("#wp-chatbot-board-container").addClass('active-chat-board');
                                wpwbot_board_action();
                                showing_proactive_msg(wpChatBotVar.checkout_msg);
                                setTimeout(function () {
                                    showing_proactive_msg(response.html);
                                    //Window foucus meta title change.
                                    window_focus_change_meta_title();
                                }, 2000);
                            }, 1000);
                        }
                    }
                });
            }else{
                $.cookie('return_user','yes');
            }

            if(wpChatBotVar.enable_inactive_time_show==1 && localStorage.getItem("wpwHitory") ) {
                var timeoutID;

                function setup() {
                    this.addEventListener("mousemove", resetTimer, false);
                    this.addEventListener("mousedown", resetTimer, false);
                    this.addEventListener("keypress", resetTimer, false);
                    this.addEventListener("DOMMouseScroll", resetTimer, false);
                    this.addEventListener("mousewheel", resetTimer, false);
                    this.addEventListener("touchmove", resetTimer, false);
                    this.addEventListener("MSPointerMove", resetTimer, false);

                    startTimer();
                }
                setup();

                function startTimer() {
                    // wait as set from admin seconds before calling goInactive
                    timeoutID = window.setTimeout(goInactive, parseInt(wpChatBotVar.inactive_time*1000));
                }

                function resetTimer(e) {
                    window.clearTimeout(timeoutID);

                    goActive();
                }

                function goInactive() {
                    if(wpChatBotVar.ret_inactive_user_once==1 && $.cookie('return_inactive_user')!='yes') {
                        $.cookie('return_inactive_user','yes');
                        var data = {'action': 'qcld_wb_chatbot_only_cart'};
                        jQuery.post(wpChatBotVar.ajax_url, data, function (response) {
                            if (response.items > 0) {
                                if ($('.active-chat-board').length == 0) {
                                    setTimeout(function () {
										$('#wp-chatbot-ball').removeClass('wpbot_chatclose_iconanimation');
									$('#wp-chatbot-ball').addClass('wpbot_chatopen_iconanimation');
									$('#wp-chatbot-ball').find('img').attr('src', wpChatBotVar.imgurl+'wpbot-close-icon.png');
                                        $("#wp-chatbot-board-container").addClass('active-chat-board');
                                        wpwbot_board_action();
                                        showing_proactive_msg(wpChatBotVar.checkout_msg);
                                        setTimeout(function () {
                                            showing_proactive_msg(response.html);
                                            //Window foucus meta title change.
                                            window_focus_change_meta_title();
                                        }, 2000);
                                    }, 2000);
                                }
                            }
                        });
                    }else{
                        $.cookie('return_inactive_user','yes');
                    }
                }

                function goActive() {
                    // do something

                    startTimer();
                }
            }
            //Proactive retargeting sound for auto open. scroll open and
            function proactive_retargeting_sound() {
                if(wpChatBotVar.enable_ret_sound==1){
                    var promise = document.querySelector('#wp-chatbot-proactive-audio').play();
                    if (promise !== undefined) {
                        promise.then(function (success) {
                            //success to play
                        }).catch(function (error) {
                            //some error
                            //console.log(error);
                        });
                    }
                }
            }

            //When user will be out of window and news retargetting will be shown. where opening hour, title and meta need to be set.
            function window_focus_change_meta_title() {
                if(wpChatBotVar.enable_meta_title==1 && wpChatBotVar.meta_label!=""  && openingHourIs==0) {
                    var showInactive = 0;
                    MetaTitleInterval = setInterval(function () {
                        if (showInactive == 0) {
                            document.title = wpChatBotVar.meta_label;
                            showInactive = 1;
                        } else {
                            document.title = orginalTitle;
                            showInactive = 0;
                        }
                    }, 1000);
                }
            }

            //wpwBot proActive end
            function wpwbot_board_action() {
                if (widowW <= 1024 && wpChatBotVar.mobile_full_screen==1 ) {//For mobile
                    if ($('#wp-chatbot-mobile-close').length <= 0) {
                        $('.wp-chatbot-board-container').append('<div id="wp-chatbot-mobile-close">X</div>');
                    }
                    $('.wp-chatbot-ball-inner').slimScroll({
                        height: '100hv',
                        start: 'bottom'
                    }).parent().find('.slimScrollBar').css({'top': $('.wp-chatbot-ball-inner').height() + 'px'});
                    $('#wp-chatbot-chat-container').css({'bottom': '0', 'left': '0', 'right': '0'});
                    $('#wp-chatbot-ball').hide();
                    //Maintain inner chat box height
                    var widowH = $(window).height();
                    var headerH = $('.wp-chatbot-header').outerHeight();
                    var footerH = $('.wp-chatbot-footer').outerHeight();
                    var AppContentInner = widowH - footerH - headerH;
                    //alert(footerH);
                    $('.wp-chatbot-ball-inner').css({'height': AppContentInner + 'px'})
                    $('.wp-chatbot-ball-inner').css({'max-height': AppContentInner + 'px'})
                    $(this).hide();
                } else {
                //    $('.wp-chatbot-header').append('<div id="wp-chatbot-desktop-close"><span class="dashicons dashicons-no"></span></div>');
                    $('.wp-chatbot-ball-inner').slimScroll({
                        height: '55hv',
                        start: 'bottom'
                    }).parent().find('.slimScrollBar').css({'top': $('.wp-chatbot-ball-inner').height() + 'px'});
                }


                //Here is the Plugin  to be load only for once.
                if (LoadwpwBotPlugin == 0) {
                    $.wpwbot({obj: wpChatBotVar, editor_handler: textEditorHandler, preLoadingTime: wpChatBotVar.botpreloadingtime});
                    LoadwpwBotPlugin++;
					var data = {'action': 'qcld_wb_chatbot_session_count'};
                    jQuery.post(wpChatBotVar.ajax_url, data, function (response) {
                       //
                    });
                }
                //If product detials is open then it will be closed.
                $('.wp-chatbot-product-container').removeClass('active-chatbot-product-details');
                //Show and close notification message on ball click
                if ($('.active-chat-board').length != 0) {
                    $('#wp-chatbot-notification-container').removeClass('wp-chatbot-notification-container-sliding');
                    //chatbox will be open and notificaion will be closed
                    $('#wp-chatbot-notification-container').addClass('wp-chatbot-notification-container-disable');
                    //clearInterval(notificationInterval);
                } else {
                    if (!sessionStorage.getItem('wpChatbotNotification')) {
                        $('#wp-chatbot-notification-container').removeClass('wp-chatbot-notification-container-disable');
                        $('#wp-chatbot-notification-container').addClass('wp-chatbot-notification-container-sliding');

                    }
                    /// clearInterval(notificationInterval);
                }
                //Messenger handling.
                if ($('.active-chat-board').length > 0) {
                    $('#wp-chatbot-integration-container').show();
                } else {
                    $('#wp-chatbot-integration-container').hide();
                }
            }
            function showing_proactive_msg(msg){
                //first open then chatboard
                if(localStorage.getItem("wpwHitory") && ! $('.wp-chatbot-operation-option[data-option="chat"]').parent().hasClass('wp-chatbot-operation-active')){
                    $('.wp-chatbot-messages-wrapper').html(localStorage.getItem("wpwHitory"));
                    $('.wp-chatbot-operation-option').each(function(){
                        if($(this).attr('data-option')=='chat'){
                            $(this).parent().addClass('wp-chatbot-operation-active');
                        }else{
                            $(this).parent().removeClass('wp-chatbot-operation-active');
                        }
                    });
                }
                var msgContent='<li class="wp-chatbot-msg">' +
                    '<div class="wp-chatbot-avatar">'+
                    '<img src="'+wpChatBotVar.agent_image_path+'" alt="">'+
                    '</div>'+
                    '<div class="wp-chatbot-agent">'+ wpChatBotVar.agent+'</div>'
                    +'<div class="wp-chatbot-paragraph"><img class="wp-chatbot-comment-loader" src="'+wpChatBotVar.image_path+'comment.gif" alt="Typing..." /></div></li>';
                    $('#wp-chatbot-messages-container').append(msgContent);
                //Scroll to the last message
                $('.wp-chatbot-ball-inner').animate({ scrollTop: $('.wp-chatbot-messages-wrapper').prop("scrollHeight")}, 'slow').parent().find('.slimScrollBar').css({'top':$('.wp-chatbot-ball-inner').height()+'px'});
                setTimeout(function(){
                    $('#wp-chatbot-messages-container li:last .wp-chatbot-paragraph').html(msg).css({'background-color':wpChatBotVar.proactive_bg_color});
                    //scroll to the last message
                    $('.wp-chatbot-ball-inner').animate({ scrollTop: $('.wp-chatbot-messages-wrapper').prop("scrollHeight")}, 'slow').parent().find('.slimScrollBar').css({'top':$('.wp-chatbot-ball-inner').height()+'px'});
                }, 2000);
            }
            function  showing_proactive_double_msg(secondMsg) {
                //first open then chatboard
                if(localStorage.getItem("wpwHitory")){
                    $('.wp-chatbot-messages-wrapper').html(localStorage.getItem("wpwHitory"));
                    $('.wp-chatbot-operation-option').each(function(){
                        if($(this).attr('data-option')=='chat'){
                            $(this).parent().addClass('wp-chatbot-operation-active');
                        }else{
                            $(this).parent().removeClass('wp-chatbot-operation-active');
                        }
                    });
                }
                var fristMsg="<strong>"+wpChatBotVar.agent+" </strong> "+wpChatBotVar.agent_join[0];
                var msgContent='<li class="wp-chatbot-msg">' +
                    '<div class="wp-chatbot-avatar">'+
                    '<img src="'+wpChatBotVar.agent_image_path+'" alt="">'+
                    '</div>'+
                    '<div class="wp-chatbot-agent">'+ wpChatBotVar.agent+'</div>'
                    +'<div class="wp-chatbot-paragraph"><img class="wp-chatbot-comment-loader" src="'+wpChatBotVar.image_path+'comment.gif" alt="Typing..." /></div></li>';
                $('#wp-chatbot-messages-container').append(msgContent);
                //Scroll to the last message
                $('.wp-chatbot-ball-inner').animate({ scrollTop: $('.wp-chatbot-messages-wrapper').prop("scrollHeight")}, 'slow').parent().find('.slimScrollBar').css({'top':$('.wp-chatbot-ball-inner').height()+'px'});

                setTimeout(function(){
                    $('#wp-chatbot-messages-container li:last .wp-chatbot-paragraph').html(fristMsg);
                    //Second Message with interval
                    $('#wp-chatbot-messages-container').append(msgContent);
                    //Scroll to the last message
                    $('.wp-chatbot-ball-inner').animate({ scrollTop: $('.wp-chatbot-messages-wrapper').prop("scrollHeight")}, 'slow').parent().find('.slimScrollBar').css({'top':$('.wp-chatbot-ball-inner').height()+'px'});
                     setTimeout(function(){
                        $('#wp-chatbot-messages-container li:last .wp-chatbot-paragraph').html(secondMsg).css({'background-color':wpChatBotVar.proactive_bg_color});
                        //Scroll to the last message
                         $('.wp-chatbot-ball-inner').animate({ scrollTop: $('.wp-chatbot-messages-wrapper').prop("scrollHeight")}, 'slow').parent().find('.slimScrollBar').css({'top':$('.wp-chatbot-ball-inner').height()+'px'});

                    }, 2000);

                }, 2000);
            }
            $(document).on('click', '#wp-chatbot-mobile-close, #wp-chatbot-desktop-close', function (event) {
                $("#wp-chatbot-board-container").toggleClass('active-chat-board');
                $("#wp-chatbot-notification-container").removeClass('wp-chatbot-notification-container-disable').addClass('wp-chatbot-notification-container-sliding');
                $('#wp-chatbot-chat-container').css({
                    'right': wpChatBotVar.wp_chatbot_position_x + 'px',
                    'bottom': wpChatBotVar.wp_chatbot_position_y + 'px',
                    'top': 'auto', 'left': 'auto'
                });
				$('#wp-chatbot-ball').find('img').attr('src', botimage)		
                $('.wp-chatbot-ball').css('background', '#ffffff');
                $('#wp-chatbot-ball').show();
                //Facebook Messenger.
                if ($('.active-chat-board').length > 0) {
                    $('#wp-chatbot-integration-container').show();
                } else {
                    $('#wp-chatbot-integration-container').hide();
                }
            });


            $("#qcld-wp-chatbot-shortcode-style-css").attr("disabled", "disabled");
            /***
             * Notification Message
             */
            if ($('#wp-chatbot-notification-container').length > 0) {
                if (sessionStorage.getItem('wpChatbotNotification') && sessionStorage.getItem('wpChatbotNotification') == 'removed') {
                    //if remove on the session.
                    $('#wp-chatbot-notification-container').addClass('wp-chatbot-notification-container-disable');
                } else {
                    //Notification comes with slideIn effect
                    $('#wp-chatbot-notification-container').addClass('wp-chatbot-notification-container-sliding');
                    //handling welcome & return user welcome msg.
                    if ($.cookie("shopper")) {
                        var shopper = $.cookie("shopper");
                        var welcomeMsg = wpChatBotVar.welcome_back[0] + ' <strong>' + shopper + '!</strong>';
                    } else {
                        var welcomeMsg = wpChatBotVar.welcome[0] + ' <strong>' + wpChatBotVar.host + '!</strong>';

                    }
                    $('.wp-chatbot-notification-welcome').html(welcomeMsg);
                    //Notifications msgs handling.
                    var notifications = wpChatBotVar.notifications;
                    if (notifications.length > 1) {
                        var totalNotMsg = wpChatBotVar.notifications.length;
                        var notMsgIndex = 0;
                        var intervalTime = parseInt(wpChatBotVar.notification_interval) * 1000;
                        var notificationInterval = setInterval(function (e) {
                            notMsgIndex++;
                            if (totalNotMsg <= notMsgIndex) {
                                notMsgIndex = 0;
                            }
                            //show new notification time after every intervalTime
                            $('.wp-chatbot-notification-message').css({'opacity': 1}).html(notifications[notMsgIndex]);
                        }, intervalTime);
                    }

                    $(".wp-chatbot-notification-close").click(function () {
                        $('#wp-chatbot-notification-container').addClass('wp-chatbot-notification-container-disable');
                        //clearInterval(notificationInterval);
                        sessionStorage.setItem('wpChatbotNotification', 'removed');
                    });
                }
            }
        }
        else if ($('#wp-chatbot-shortcode-template-container').length > 0) { //Page shortcode area.
            $('#wp-chatbot-chat-container').css({'display': 'none'});
            $('#wp-chatbot-ball').hide();
            //Add Scroll to chat ui
            $('.wp-chatbot-ball-inner').slimScroll({
                height: '60hv',
                start: 'bottom'
            }).parent().find('.slimScrollBar').css({'top': $('.wp-chatbot-ball-inner').height() + 'px'});
            //Add scroll to cart part
            var recentViewHeight = $('.wp-chatbot-container').outerHeight();
            if ($('.chatbot-shortcode-template-02').length == 0) {
                $('.wp-chatbot-cart-body').slimScroll({height: '200px', start: 'top'});
                $('.wp-chatbot-widget .wp-chatbot-products').slimScroll({height: '435px', start: 'top'});
            }

            //Remove style of template
            $("#qcld-wp-chatbot-style-css").attr("disabled", "disabled");
            //Here is the Plugin  to be load only for once.
            if (LoadwpwBotPlugin == 0) {
                $.wpwbot({obj: wpChatBotVar, editor_handler: textEditorHandler});
                LoadwpwBotPlugin++;
				var data = {'action': 'qcld_wb_chatbot_session_count'};
                    jQuery.post(wpChatBotVar.ajax_url, data, function (response) {
                       //
                    });
            }


        }
        else if ($('#wp-chatbot-chat-app-shortcode-container').length > 0) {  //App shortcode area.

            textEditorHandler = 1;
            //App UI (ball inner)
            setTimeout(function () {
                var widowH = $(window).height();
                //var headerH = $('.wp-chatbot-header').outerHeight();
                var footerH = $('.wp-chatbot-footer').outerHeight();

                var AppContentInner = widowH - footerH;
                //alert(footerH);
                $('#wp-chatbot-chat-app-shortcode-container .wp-chatbot-ball-inner').css({'height': AppContentInner + 'px'})
            }, 300);
            $(window).resize(function () {
                setTimeout(function () {
                    var widowH = $(window).height();
                    //var headerH = $('.wp-chatbot-header').outerHeight();
                    var footerH = $('.wp-chatbot-footer').outerHeight();
                    var AppContentInner = widowH - footerH;
                    //alert(footerH);
                    $('#wp-chatbot-chat-app-shortcode-container .wp-chatbot-ball-inner').css({'height': AppContentInner + 'px'})
                }, 300)
            });

            $('#wp-chatbot-ball').hide();
            //Add Scroll to chat ui
            $("#qcld-wp-chatbot-shortcode-style-css").attr("disabled", "disabled");
            $("#wp-chatbot-board-container").addClass('active-chat-board');
            $('.wp-chatbot-ball-inner').slimScroll({
                height: '55hv',
                start: 'bottom'
            }).parent().find('.slimScrollBar').css({'top': $(window).height() + 'px'});
            if (LoadwpwBotPlugin == 0) {
                $.wpwbot({obj: wpChatBotVar, editor_handler: textEditorHandler});
                LoadwpwBotPlugin++;
				var data = {'action': 'qcld_wb_chatbot_session_count'};
                    jQuery.post(wpChatBotVar.ajax_url, data, function (response) {
                       //
                    });
            }
            //Handling app cart and checkout
            $('#wp-chatbot-cart-short-code').hide();
            $('#wp-chatbot-checkout-short-code').hide();
            $(document).on('click', '.wp-chatbot-cart-link', function (event) {
                $('.wp-chatbot-messages-wrapper').hide();
                $('#wp-chatbot-checkout-short-code').hide();
                $('#wp-chatbot-cart-short-code').show();
                event.preventDefault();
                $('#wp-chatbot-cart-short-code').html('<img class="wp-chatbot-comment-loader" src="' + wpChatBotVar.image_path + 'comment.gif" alt="..." />');
                var data = {'action': 'qcld_wb_chatbot_cart_page'};
                jQuery.post(wpChatBotVar.ajax_url, data, function (response) {
                    $("#wp-chatbot-cart-short-code").html(response);
                });
            });
            $(document).on('click', '.wp-chatbot-checkout-link, .checkout-button', function (event) {
                event.preventDefault();
                $('.wp-chatbot-messages-wrapper').hide();
                $('#wp-chatbot-cart-short-code').hide();
                $('#wp-chatbot-checkout-short-code').show();


                $('#wp-chatbot-checkout-short-code').html('<img class="wp-chatbot-comment-loader" src="' + wpChatBotVar.image_path + 'comment.gif" alt="..." />');
                var data = {'action': 'qcld_wb_chatbot_checkout_page'};
                jQuery.post(wpChatBotVar.ajax_url, data, function (response) {
                    if (response.status == 'yes') {
                        window.location.href = response.html;
                    } else {
                        $("#wp-chatbot-checkout-short-code").html(response.html);
                    }

                });
            });
            //Preventing url redirect from cart page.
            $(document).on('click', '#wp-chatbot-chat-app-shortcode-container .wpcommerce-cart-form a', function (e) {
                e.preventDefault();
            });
        }
        //For variable product configuration
        $(document).on('change', "#wp-chatbot-product-variable select ", function () {
            var variations = JSON.parse($("#wp-chatbot-variation-data").attr('data-product-variation'));
            var item_conditions = [];

            var totalAttr = $("#wp-chatbot-product-variable select").length;
            var i = 1;
            $("#wp-chatbot-product-variable select").each(function (index, element) {
                var myVal = $(this).find('option:selected').val();
                if (myVal != "") {
                    item_conditions.push({
                        'left': 'item["variation_data"]["' + $(this).attr('name') + '"][0]',
                        'right': myVal
                    })
                }
            });
            var newVariation = [];
            for (var a = 0; variations.length > a; a++) {
                var item = variations[a];
                var item_condition = "";
                for (var i = 0; item_conditions.length > i; i++) {

                    if (i > 0) {
                        item_condition += ' && ' + '"' + eval(item_conditions[i].left).toLowerCase() + '"' + '==' + '"' + item_conditions[i].right.toLowerCase() + '"';
                    } else {
                        item_condition += '"' + eval(item_conditions[i].left).toLowerCase() + '"' + '==' + '"' + item_conditions[i].right.toLowerCase() + '"';
                    }
                }
                if (eval(item_condition)) {
                    newVariation[0] = item;
                }
            }
            if (newVariation.length > 0) {
                $('#wp-chatbot-variation-add-to-cart').attr('variation_id', newVariation[0]['variation_id']);
                var priceSets = "";
                if (newVariation[0]['variation_data']['_sale_price'][0] != "") {
                    priceSets += '<strike>' + wpChatBotVar.currency_symbol + newVariation[0]['variation_data']['_regular_price'][0] + '</strike>  <strong>' + wpChatBotVar.currency_symbol + newVariation[0]['variation_data']['_sale_price'][0] + '</strong>'
                } else {
                    priceSets += '<strong>' + wpChatBotVar.currency_symbol + newVariation[0]['variation_data']['_regular_price'][0] + '</strong>';
                }
                $('#wp-chatbot-product-price').html(priceSets);
            }
        });

        if ($('.active-chat-board').length > 0) {
            $('#wp-chatbot-integration-container').show();
        } else {
            $('#wp-chatbot-integration-container').hide();
        }
        //Facebook Messenger Integration
        /* if(wpChatBotVar.enable_messenger == 1){
         $(document).on('click','.fb_dialog',function (e) {
         $('#wp-chatbot-board-container').removeClass('active-chat-board');
         $('.fb_dialog').css({'display': 'inline'});
         setTimeout(function (e) {
         $('.fb-customerchat >span').css({'display': 'inline'});
         $('.fb_dialog').trigger('click'); //.css({'display': 'none'});
         },300);
         $('#wp-chatbot-integration-container').hide();
         });
         }*/
        //skype
        if (wpChatBotVar.enable_skype == 1) {
            $(document).on('click', '.inetegration-skype-btn', function (e) {
                $('#wp-chatbot-board-container').removeClass('active-chat-board');
                // $('.lwc-button-icon').trigger('click');
                $('#wp-chatbot-integration-container').hide();
            });

        }


    });

});