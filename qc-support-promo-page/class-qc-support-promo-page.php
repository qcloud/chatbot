<?php
/*
* QuantumCloud Promo + Support Page
* Revised On: 06-01-2017
*/
function qcpromo_support_page_callback_func()
		{
			wp_enqueue_style( 'pd-support-fontawesome', plugin_dir_url( __FILE__ ) . "/css/font-awesome.min.css");
			wp_enqueue_style( 'pd-support-style', plugin_dir_url( __FILE__ ) . "/css/style.css");
			wp_enqueue_style( 'pd-support-style-responsive', plugin_dir_url( __FILE__ ) . "/css/responsive.css");
			wp_enqueue_style( 'pd-support-style-font', "https://fonts.googleapis.com/css?family=Lato");
			?>
				
				
				<div class="qc_support_container"><!--qc_support_container-->
    
                <div class="qc_tabcontent clearfix-div">
                    <div class="qc-row">
                        <div class="support-btn-main clearfix-div">
                            
                        
                            <div class="qc-column-12">
                                <h4>All our Pro Version users get Premium, Guaranteed Quick, One on One Priority Support.</h4>
                                <div class="support-btn">
                                    <a class="premium-support" href="https://www.quantumcloud.com/ps/" target="_blank">GET PRIORITY SUPPORT</a>
                                    <a class="premium-support premium-support-width" href=" https://wpbot.pro/docs/" target="_blank">Online KnowledgeBase</a>
                                </div>

                            </div>
                            <div class="qc-column-12" style="margin-top: 12px;">
                                <div class="support-btn">
                                    
                                    <a class="premium-support premium-support-free" href="https://www.wpbot.pro/free-support/" target="_blank">Get Support for Free Version</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="qc-row qc-support-product-column">
                        <div class="qc-support-product-inn">
                            <div class="plugin-title-section">
                                <h2 class="plugin-title plugin-title-custom" >Check Out Some of Our Other Works that Might Make Your Website Better</h2>
                                <h3 class="qc-product-type">Innovative Plugins</h3>
                            </div>

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/knowledgebase-helpdesk/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/knowledgebase-helpdesk.jpg" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/knowledgebase-helpdesk/" target="_blank" rel="noopener noreferrer">KB & HelpDesk w/ ChatBot</a></h4>
                                        <p><p>KnowledgeBase HelpDesk is an advanced Knowledgebase plugin with helpdesk<strong>, </strong>glossary and FAQ features all in one. 
                                        KnowledgeBase HelpDesk is extremely simple and easy to use.</p></p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/knowledgebase-helpdesk/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/knowledgebase-helpdesk/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->


                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/logo (1).png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank">WoowBot WooCommerce ChatBot</a></h4>
                                        <p>WooWBot is a <strong>ChatBot for WooCommerce</strong> with zero configuration or bot training required. This WooCommerce based Shop Bot that can help <strong>Increase your store Sales</strong> perceptibly.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/woowbot-woocommerce-chatbot/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.wpbot.pro/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/wpboticon-256x256-1.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.wpbot.pro/" target="_blank">WPBot – ChatBot for WordPress</a></h4>
                                        <p>WPBot is a ChatBot for<strong> any WordPress website</strong> that can improve user engagement, answer questions &amp; help <strong>generate more leads</strong>. Integrated with <strong>Google</strong>‘s <strong>DialogFlow (AI and NLP).</strong></p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/chatbot/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.wpbot.pro/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/simple-business-directory/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/icon.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/simple-business-directory/" target="_blank">Simple Business Directory w/ Maps</a></h4>
                                        <p>This innovative and powerful, yet<strong> Simple &amp; Multi-purpose Business Directory</strong> WordPress PlugIn allows you to create comprehensive Lists of Businesses with maps and tap to call features.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/phone-directory/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/simple-business-directory/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/slider-hero" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/slider-hero-icon-256x256.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/slider-hero/" target="_blank">Slider Hero</a></h4>
                                        <p>Slider Hero is a unique slider plugin that allows you to create <strong>Cinematic Product Intro Adverts</strong> and 
                                        <strong>Hero sliders</strong> with great Javascript animation effects.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/slider-hero/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/slider-hero/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/simple-link-directory/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/sld-icon-256x256.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/simple-link-directory/" target="_blank">Simple Link Directory</a></h4>
                                        <p>Directory plugin with a unique approach! Simple Link Directory is an advanced WordPress Directory plugin for One Page 
                                        directory and Content Curation solution.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/simple-link-directory/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/simple-link-directory/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->


                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/infographic-maker-ilist/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/iList-icon-256x256.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/infographic-maker-ilist/" target="_blank">InfoGraphic Maker – iList</a></h4>
                                        <p>iList is first of its kind <strong>InfoGraphic maker</strong> WordPress plugin to create Infographics and elegant Lists effortlessly to visualize data. 
                                        It is a must have content creation and content curation tool.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/infographic-and-list-builder-ilist/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/infographic-maker-ilist/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/portfolio-x-plugin/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/portfolio-x-logo-dark-2.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/portfolio-x-plugin/" target="_blank">Portfolio X</a></h4>
                                        <p>Portfolio X is an advanced, responsive portfolio with streamlined workflow and unique designs and templates to show your works or projects. <strong>Portfolio Showcase</strong> and <strong>Portfolio Widgets</strong> are included.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/portfolio-x/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/portfolio-x-plugin/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/comment-link-remove/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/Comment-Link-Remove-300x300 (1).jpg" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/comment-link-remove/" target="_blank">Comment Tools w/ Sentiment Analysis</a></h4>
                                        <p>Comment Tools Pro adds an arsenal of <strong>practical tools</strong>. It <strong>reduces spammy</strong>, low quality comments and<strong> increases user interactivity </strong>and <strong>content value</strong> of your blog.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/comment-link-remove/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/comment-link-remove/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->
                            

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/woocommerce-shop-assistant-jarvis/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/jarvis-icon-256x256.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/woocommerce-shop-assistant-jarvis/" target="_blank">Action Buttons for WooCommerce</a></h4>
                                        <p>WooCommerce Shop Assistant – <strong>JARVIS</strong> shows recent user activities, provides advanced search, floating cart, featured products, store notifications, order notifications – all in one place for easy access by buyer and make quick decisions.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/shop-assistant-for-woocommerce-jarvis/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/woocommerce-shop-assistant-jarvis/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/express-shop/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/express-shop.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/express-shop/" target="_blank">Express Shop</a></h4>
                                        <p>Express Shop is a WooCommerce addon to show all products in one page. User can add products to cart and go to checkout. 
                                        Filtering and search integrated in single page.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/express-shop/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/express-shop/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/woo-tabbed-category-product-listing/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/woo-tabbed-icon-256x256.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/woo-tabbed-category-product-listing/" target="_blank">Woo Tabbed Category Products</a></h4>
                                        <p>WooCommerce plugin that allows you to showcase your products category wise in tabbed format. This is a unique woocommerce plugin that lets dynaimically 
                                        load your products in tabs based on your product categories .</p>
                                         <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/woo-tabbed-category-product-listing/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/woo-tabbed-category-product-listing/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/ichart/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/ilist-chat.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/ichart/" target="_blank">iChart – Charts, Graphs and Data Tables</a></h4>
                                        <p><strong>Responsive, HTML5</strong> Charts, Graphs and <strong>Data Tables</strong> are now easy to build and add to any WordPress page with just a few clicks. <strong>Import/Export</strong> Charts, <strong>Links</strong> in the Chart Data, <strong>ToolTip</strong> text, Live Chart <strong>Preview</strong> and more!</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/ichart/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/ichart/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/chatbot-addons/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/chatbot-addons.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/chatbot-addons/" target="_blank">ChatBot Addons</a></h4>
                                        <p>Empower <a href="https://www.wpbot.pro/" target="_blank" rel="noopener noreferrer">WPBot</a> and <a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank" rel="noopener noreferrer">WoowBot</a> – Extend Capabilities with AddOns! FaceBook messenger, white label and more!</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/chatbot-addons/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->
                            
                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a target="_blank" href="https://wordpress.org/plugins/increase-sales/"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/icon-256x256.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a target="_blank" href="https://wordpress.org/plugins/increase-sales/">Increase Sales</a></h4>
                                        <p>Increase Sales is a new and unique WooCommerce addon that strategically places your cross-sells products inline inside, at top or bottom of the Cart during checkout.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/increase-sales/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://wordpress.org/plugins/increase-sales/" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/seo-help" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/seo-help.jpg" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/seo-help" target="_blank">SEO Help</a></h4>
                                        <p>SEO Help is a unique WordPress plugin to help you write better Link Bait titles. The included LinkBait title generator will take the 
                                        WordPress post title as Subject and generate alternative ClickBait titles for you to choose from.</p>
                                        <div class="buy-download-section">
                                            <a href="https://wordpress.org/plugins/seo-help/" target="_blank" class="button download-free">Download Free</a>
                                            <a href="https://www.quantumcloud.com/products/seo-help" target="_blank" class="button button-primary get-pro">Go Pro</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/plugins/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/coming-soon-special.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/plugins/" target="_blank">Something Exciting</a></h4>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                        </div>

                    </div>
                    <!--qc row-->
                    
                    <div class="qc-row qc-support-product-column">
                        <div class="qc-support-product-inn">
                            <div class="plugin-title-section">
                                <h2 class="plugin-title plugin-title-custom" >Premium Themes that Add Perceptible Value to Your Website.</h2>
                                <h3 class="qc-product-type">Creative Themes</h3>
                            </div>

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/knowledgebase-theme/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-kbx-1.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/knowledgebase-theme/" target="_blank">KnowledgeBase X Theme</a></h4>
                                        <p>KnowledgeBase HelpDesk is an advanced Knowledgebase plugin with helpdesk<strong>, </strong>glossary and FAQ features all in one. Make the best out of our <a href="https://www.quantumcloud.com/products/knowledgebase-helpdesk/" target="_blank" rel="noopener">KnowledgeBase X</a> plugin</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/knowledgebase-theme/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/knowledgebase-theme/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-woowbot.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/woowbot-theme/" target="_blank">WooCommerce ChatBot Theme</a></h4>
                                        <p>WoowBot is a <strong>Plug n’ play</strong> Shopping Chat Bot that can help <strong>Increase your store Sales</strong>. Make the best out of the popular <a href="https://www.quantumcloud.com/products/woocommerce-chatbot-woowbot/" target="_blank" rel="noopener">WoowBot plugin</a> for WooCommerce.</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/woowbot-theme/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/chatbot-theme/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-chatbot-master.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/chatbot-theme/" target="_blank">WPBot – ChatBot Master Theme</a></h4>
                                        <p>WPBot is a ChatBot for<strong> any WordPress website</strong> that can improve user engagement, answer questions &amp; help <strong>generate more leads</strong>. Make the best out of the popular <a href="https://www.wpbot.pro/" target="_blank" rel="noopener">WPBot plugin</a>.</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/chatbot-theme/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/simple-business-directory-theme/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-sbd.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/simple-business-directory-theme/" target="_blank">Simple Business Directory Theme</a></h4>
                                        <p>This innovative and powerful, yet<strong> Simple &amp; Multi-purpose Business Directory</strong> theme is perfect for our <a href="https://www.quantumcloud.com/products/simple-business-directory/">SBD plugin</a> to meet all your business directory needs.</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/simple-business-directory-theme/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/simple-blog/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-simple-blog.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/simple-blog/" target="_blank">Simple Blog Theme</a></h4>
                                        <p>Crafted carefully to provide the best blogging experiences! One Click Install, Demo Data, Compatible with the <strong>Elementor</strong> and the <strong>Gutenberg</strong> Page Builder!</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/simple-blog/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/simple-link-directory/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-sld.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/simple-link-directory/" target="_blank">Simple Link Directory Theme</a></h4>
                                        <p>Simple Link Directory is an advanced WordPress Directory plugin for One Page directory and Content Curation solution. Get the best of the SLD plugin!</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/simple-link-directory/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/woo-tabbed-theme/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-wootabbed.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/woo-tabbed-theme/" target="_blank">WooTabbed Theme</a></h4>
                                        <p>Crafted carefully to make the best out of the popular <a href="https://www.quantumcloud.com/products/woo-tabbed-category-product-listing/" target="_blank" rel="noopener">WooTabbed </a>for WooCommerce. Get a shopping theme that sells!</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/woo-tabbed-theme/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/express-shop-theme/" target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-express-shop.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/express-shop-theme/" target="_blank">Express Shop Theme</a></h4>
                                        <p>Crafted carefully to make the best out of the popular <a href="https://www.quantumcloud.com/products/woo-tabbed-category-product-listing/" target="_blank" rel="noopener">WooTabbed </a>for WooCommerce. Get a shopping theme that sells!</p>
                                        <div class="buy-download-section">
                                            <a href="https://www.quantumcloud.com/products/themes/express-shop-theme/" target="_blank" class="button button-primary get-pro">Get Theme</a>
                                        </div>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            <div class="qc-column-4"><!-- qc-column-4 -->
                                <!-- Feature Box 1 -->
                                <div class="support-block ">
                                    <div class="support-block-img">
                                        <a href="https://www.quantumcloud.com/products/themes/"  target="_blank"> <img src="<?php echo esc_url( plugin_dir_url(__FILE__) ); ?>images/premium-theme-coming-soont.png" alt=""></a>
                                    </div>
                                    <div class="support-block-info">
                                        <h4><a href="https://www.quantumcloud.com/products/themes/"  target="_blank">Coming Soon!</a></h4>

                                    </div>
                                </div>
                            </div><!--/qc-column-4 -->

                            

                        </div>

                    </div>

                </div>
    
            </div><!--qc_support_container-->
				
			<?php
		} //End of qcpromo_support_page_callback_function