<?php
class QCLD_openaiaddon_AutoUpdate
{
	/**
	 * The plugin current version
	 * @var string
	 */
	private $current_version;

	/**
	 * The plugin remote update path
	 * @var string
	 */
	private $update_path;

	/**
	 * Plugin Slug (plugin_directory/plugin_file.php)
	 * @var string
	 */
	private $plugin_slug;

	/**
	 * Plugin name (plugin_file)
	 * @var string
	 */
	private $slug;

	/**
	 * License User
	 * @var string
	 */
	private $license_user;

	/**
	 * License Key 
	 * @var string
	 */
	private $license_key;

	/**
	 * Initialize a new instance of the WordPress Auto-Update class
	 * @param string $current_version
	 * @param string $update_path
	 * @param string $plugin_slug
	 */
	public function __construct( $current_version, $update_path, $plugin_slug, $license_user = '', $license_key = '' )
	{
		$qcld_renew_subscription = get_openaiaddon_renew_transient();
		
		// Set the class public variables
		$this->current_version = $current_version;
		$this->update_path = $update_path;

		// Set the License
		$this->license_user = $license_user;
		$this->license_key = $license_key;

		// Set the Plugin Slug	
		$this->plugin_slug = $plugin_slug;
		list ($t1, $t2) = explode( '/', $plugin_slug );
		$this->slug = $t1;	

		// define the alternative API for updating checking
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ) );

		// Define the alternative response for information checking
		add_filter( 'plugins_api', array( $this, 'check_info' ), 10, 3 );

		if( $qcld_renew_subscription ){
			add_action("after_plugin_row_{$this->plugin_slug}", array($this, 'show_upgrade_subscription_on_plugin_row'), 10, 3 );
		}

	}

	/**
	 * Add our self-hosted autoupdate plugin to the filter transient
	 *
	 * @param $transient
	 * @return object $ transient
	 */
	public function check_update( $transient )
	{
		 if ( empty( $transient->checked ) ) {
		 	return $transient;
		 }


		// Get the remote version
		$remote_version = $this->getRemote('info');


		// If a newer version is available, add the update
		if ( version_compare( $this->current_version, $remote_version->new_version, '<' ) ) {
			if(isset($remote_version->subscription_enable->plugin_name) ){
				$subscription_enable = $remote_version->subscription_enable->plugin_name;
			}else{
				$subscription_enable = '';
			}
			
			
			
			if( $this->slug == $subscription_enable ){
				$obj = new stdClass();
				$obj->slug = $this->slug;
				$obj->new_version = $remote_version->new_version;
				$obj->url = $remote_version->url;
				$obj->plugin = $this->plugin_slug;
				$obj->package = $remote_version->package;
				$obj->tested = $remote_version->tested;
				$obj->requires = $remote_version->requires;
				$obj->last_updated = $remote_version->last_updated;
				$obj->sections = $remote_version->sections;

				setqc_openaiaddon_update_transient($obj);
				deleteqc_openaiaddon_renew_transient();
				
				$transient->response[$this->plugin_slug] = $obj;
			 }else{
			 	$obj = new stdClass();
			 	setqc_openaiaddon_renew_transient($obj);
			 	$qcld_renew_subscription = get_openaiaddon_renew_transient();
			 	if( $qcld_renew_subscription ){
			 		add_action("after_plugin_row_{$this->plugin_slug}", array($this, 'show_upgrade_subscription_on_plugin_row'), 10, 3 );
			 	}
			 }
		
		}
		return $transient;
	}

	public function show_upgrade_subscription_on_plugin_row( $plugin_file, $plugin_data, $status ) {
		$qcld_renew_subscription = get_openaiaddon_renew_transient();

		if( $qcld_renew_subscription ){
	  		echo '<tr class="plugin-update-tr">
	  			<td colspan="3" class="plugin-update colspanchange">
		        	<div class="update-message notice inline notice-warning notice-alt">
		        		<p>There is a new version available. <a href="'.esc_url('https://www.ultrawebmedia.com/li/plugins/live-chat-addon/changelog.txt').'" target="_blank">View version details</a>. Automatic update is unavailable for this plugin. To receive automatic updates, valid license is required.</p>
		        	</div>
		        </td>
		    </tr>';
		}
	}

	/**
	 * Add our self-hosted description to the filter
	 *
	 * @param boolean $false
	 * @param array $action
	 * @param object $arg
	 * @return bool|object
	 */
	public function check_info($obj, $action, $arg)
	{
		if (($action=='query_plugins' || $action=='plugin_information') && 
		    isset($arg->slug) && $arg->slug === $this->slug) {
			return $this->getRemote('info');
		}
		
		return $obj;
	}

	/**
	 * Return the remote version
	 * 
	 * @return string $remote_version
	 */
	public function getRemote($action = '')
	{
		$qcld_update_plugin = get_openaiaddon_update_transient();


			
			$params = array(
				'body' => array(
					'action'       => $action,
					'plugin-slug'  => $this->slug,
					'license_user' => $this->license_user,
					'license_key'  => $this->license_key,
				),
			);
			
			// Make the POST request
			$request = wp_remote_post($this->update_path, $params );
			// Check if response is valid

			if ( !is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			
				return @unserialize( $request['body'] );
			}
		
		
		return false;
	}
}