<?php
/*
* QuantumCloud Promo + Support Page
* Revised On: 06-01-2017
*/

/*******************************
 * Main Class to Display Support
 * form and the promo pages
 *******************************/
if( !class_exists('Wpbot_rating') ){
	
	class Wpbot_rating{
		
		public $plugin_name = "wpbot"; //Without spaces
		public $plugin_full_name = "ChatBot";
		public $logo_url;
		
		public $plugin_rating_url = "https://wordpress.org/support/plugin/chatbot/reviews/?filter=5";
		
		public function __construct(){
			$this->logo_url = QCLD_wpCHATBOT_IMG_URL . "/chatbot.png";
			
		}
		
		function run(){
			add_action('admin_init', array($this, 'qc_admin_notice_rating'));
			
			add_action('wp_ajax_qc_chatbot_feedback_notice_dismiss', array($this, 'notice_dismiss'));
			add_action('wp_ajax_qc_chatbot_blackfriday_notice_dismiss', array($this, 'blackfriday_notice_dismiss'));
		}
		
		public function blackfriday_notice_dismiss(){
			update_option('wpbot-admin-notice-blackfriday', 'hide');
			die(0);
		}
		public function notice_dismiss(){
			update_option('wpbot-admin-notice-oninstallation', 'hide');
			die(0);
		}
		
		/**
		 *	Check and Dismiss review message.
		 *
		 */
		private function review_dismissal() {

			
		
			//delete_site_option( 'wp_analytify_review_dismiss' );
			if ( ! is_admin() ||
				! isset( $_GET['_wpnonce'] ) ||
				! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'qc-'.$this->plugin_name.'-rating-nonce' ) ||
				! isset( $_GET['qc_'.$this->plugin_name.'_rating_dismiss'] ) ) {

				return;
			}

			
			update_option( 'qc_'.$this->plugin_name.'_rating_dismiss', 'yes' );
			
		}
		
		/**
		 * Set time to current so review notice will popup after X days
		 */
		function review_prending() {

			// delete_site_option( 'wp_analytify_review_dismiss' );
			if ( ! is_admin() ||
				! isset( $_GET['_wpnonce'] ) ||
				! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['_wpnonce'] ) ), 'qc-'.$this->plugin_name.'-rating-nonce' ) ||
				! isset( $_GET['qc_'.$this->plugin_name.'_rating_later'] ) ) {

				return;
			}

			// Reset Time to current time.
			update_option( 'qc_'.$this->plugin_name.'_rating_active_time', time() );

		}
		
		public function qc_admin_notice_rating(){
			
			$this->review_dismissal();
			$this->review_prending();
			
			$activation_time 	= get_option( 'qc_'.$this->plugin_name.'_rating_active_time' );
			$review_dismissal	= get_option( 'qc_'.$this->plugin_name.'_rating_dismiss' );
			//echo $review_dismissal;exit;
			if ( 'yes' == $review_dismissal ) {
				if( get_option( 'wpbot-admin-notice-oninstallation' ) && get_option( 'wpbot-admin-notice-oninstallation' ) == 'show' && $this->is_wpbot_page() ){
					add_action( 'admin_enqueue_scripts', array($this, 'qc_load_rating_style') );
					add_action( 'admin_notices', array( $this, 'admin_notice' ) );
				}
				return;
			}
			if ( ! $activation_time ) {
				$activation_time = time();
				add_option( 'qc_'.$this->plugin_name.'_rating_active_time', $activation_time );
			}
			
			// 604800 = 7 Days in seconds.
			
			if ( time() - $activation_time > 604800 && $this->is_wpbot_page() ) {
				add_action( 'admin_enqueue_scripts', array($this, 'qc_load_rating_style') );
				add_action( 'admin_notices' , array( $this, 'qc_rating_notice_message' ) );
			}else{
				if( get_option( 'wpbot-admin-notice-oninstallation' ) && get_option( 'wpbot-admin-notice-oninstallation' ) == 'show' && $this->is_wpbot_page() ){
					add_action( 'admin_enqueue_scripts', array($this, 'qc_load_rating_style') );
					add_action( 'admin_notices', array( $this, 'admin_notice' ) );
				}
			}
			
		}
		
		public function admin_notice(){

				?>
				<div data-dismiss-type="qcbot-feedback-notice" class="notice is-dismissible qcbot-feedback">
				<div class="wpbot-notice-content">
					<div class="qc-review-thumbnail qc-small-thumb">
						<img src="<?php echo esc_url($this->logo_url); ?>" alt="halloween">
					</div>
					
					<div class="qc-review-text">
					
						<p><?php esc_html_e( 'Hello! Thank you for using our ChatBot.', 'qc-sld' ) ?></p>
					
						<p><?php esc_html_e( 'If you have any feedback or need help, please <a href="https://www.wpbot.pro/free-support/" target="_blank">contact us</a>. We take all user feedback seriously and resolve all issues.', 'qc-opd' ) ?></p>
						
					</div>
				</div>
			</div>
				<?php
				/* Delete transient, only display this notice once. */
				delete_transient( 'wpbot-admin-notice-oninstallation' );
		}
		
		public function is_wpbot_page(){
			
			$status = false;
			if( ( isset( $_GET['page'] ) && $_GET['page'] == 'wpbot-panel' ) || ( isset( $_GET['page'] ) && $_GET['page'] == 'wpbot' ) || ( isset( $_GET['page'] ) && $_GET['page'] == 'simple-text-response' ) || ( isset( $_GET['page'] ) && $_GET['page'] == 'wpbot_support_page' ) || ( isset( $_GET['page'] ) && $_GET['page'] == 'wpbot_help_page' ) ){
				$status = true;
			}
			return $status;
			
		}
		
		public function qc_load_rating_style(){
			wp_enqueue_style( 'qc_rating_stylesheet', plugin_dir_url(__FILE__)."css/style.css");
			wp_register_script( 'qc_rating_js', plugin_dir_url(__FILE__)."js/rating.js", array('jquery'), '1.02.2' , true);
			$translation_array = array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			);
			wp_localize_script( 'qc_rating_js', 'rating_object', $translation_array );
			wp_enqueue_script( 'qc_rating_js');
			
		}
		
		public function qc_rating_notice_message(){
			
			/*if ( ! is_admin() ||
				! current_user_can( 'manage_options' ) ) {
				return;
			}*/
			
			$scheme      = (parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY )) ? '&' : '?';
			
			$url         = $_SERVER['REQUEST_URI'] . $scheme . 'qc_'.$this->plugin_name.'_rating_dismiss=yes';
			
			$dismiss_url = wp_nonce_url( $url, 'qc-'.$this->plugin_name.'-rating-nonce' );

			$_later_link = $_SERVER['REQUEST_URI'] . $scheme . 'qc_'.$this->plugin_name.'_rating_later=yes';
			
			$later_url   = wp_nonce_url( $_later_link, 'qc-'.$this->plugin_name.'-rating-nonce' );
			
		?>
			<div class="notice is-dismissible">
				<div class="wpbot-notice-content">
					<div class="qc-review-thumbnail">
						<img src="<?php echo esc_url($this->logo_url); ?>" alt="">
					</div>
					
					<div class="qc-review-text">
					
						<p><?php esc_html_e( 'Hello! Thank you for using our ChatBot.', 'qc-sld' ) ?></p>
					
						<p style="display:inline-block">
							If you have any feedback or need help, please <a style="display:inline-block" href="https://www.wpbot.pro/free-support/" target="_blank">contact us</a>. We take all user feedback seriously and resolve all issues.<br>If you found our plugin useful, please take a minute to leave the plugin a 5 Star rating on WordPress. That really boosts our confidence and encourages us to keep adding new features to the plugin.
						</p>
						
						<ul class="qc-review-ul">
						
							<li><a href="<?php echo esc_url($this->plugin_rating_url); ?>" target="_blank"><span class="dashicons dashicons-star-filled"></span><?php esc_html_e( 'Leave A Review', 'qc-sld' ) ?></a></li>
							 <li><a href="<?php echo esc_url($dismiss_url) ?>"><span class="dashicons dashicons-yes"></span><?php esc_html_e( 'I\'ve already left a review', 'qc-sld' ) ?></a></li>
							 <li><a href="<?php echo esc_url($later_url) ?>"><span class="dashicons dashicons-calendar"></span><?php esc_html_e( 'Maybe Later', 'qc-sld' ) ?></a></li>
							 <li><a href="<?php echo esc_url($dismiss_url) ?>"><span class="dashicons dashicons-no"></span><?php esc_html_e( 'Never show this again', 'qc-sld' ) ?></a></li>
				 
						</ul>
					</div>
				</div>
			</div>
		<?php
		}
		
	}
}
$qc_wpbot_rating = new Wpbot_rating();

$qc_wpbot_rating->plugin_name = 'wpbot';

$qc_wpbot_rating->run();
