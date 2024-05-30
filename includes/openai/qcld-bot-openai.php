<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

if(!class_exists('qcld_wpopenai_addons')){


    /**
     * Main Class.
     */
    final class qcld_wpopenai_addons
    {
        private $id = 'Open AI';

        /**
         * WPBot Pro version.
         *
         * @var string
         */
        public $version = '1.0.6';
        
        /**
         * WPBot Pro helper.
         *
         * @var object
         */
        public $helper;

        /**
         * The single instance of the class.
         *
         * @var qcld_wb_Chatbot
         * @since 1.0.0
         */
        protected static $_instance = null;
        
        /**
         * Main wpbot Instance.
         *
         * Ensures only one instance of wpbot is loaded or can be loaded.
         *
         * @return qcld_wb_Chatbot - Main instance.
         * @since 1.0.0
         * @static
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        public $response_list;

        /**
         *  Constructor
         */
        public function __construct()
        {
            $this->define_constants();
            $this->includes();
            add_action('wp_ajax_openai_settings_option', [$this, 'openai_settings_option_callback']);
            add_action('wp_ajax_openai_response',[$this,'openai_response_callback']);
           // add_action('wp_ajax_openai_file_list',[$this,'openai_file_list_callback']);
           // add_action('wp_ajax_openai_file_upload',[$this,'openai_file_upload_callback']);
           // add_action('wp_ajax_openai_file_delete',[$this,'openai_file_delete_callback']);
            add_action('wp_ajax_nopriv_openai_response', [$this, 'openai_response_callback']);
           // add_action('wp_ajax_qcld_openai_file_dowload',[$this,'qcld_openai_file_dowload']);
            
            if (is_admin() && !empty($_GET["page"]) && (($_GET["page"] == "openai-panel_dashboard") || ($_GET["page"] == "openai-panel_file") || ($_GET["page"] == "openai-panel_help"))) {
                add_action('admin_enqueue_scripts', array($this, 'qcld_wb_chatbot_admin_scripts'));
            }
    
     
        }

        
        /**
         * Define wpbot Constants.
         *
         * @return void
         * @since 1.0.0
         */
        public function define_constants() {
            if( ! defined( 'QCLD_openai_addon_VERSION' ) ){
                define('QCLD_openai_addon_VERSION', $this->version);
            }
           //define('QCLD_openai_addon_REQUIRED_wpCOMMERCE_VERSION', 2.2);

            if( ! defined( 'QCLD_openai_addon_PLUGIN_DIR_PATH' ) ){
                define('QCLD_openai_addon_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
            }
            if( ! defined( 'QCLD_openai_addon_PLUGIN_URL' ) ){
                define('QCLD_openai_addon_PLUGIN_URL', plugin_dir_url(__FILE__));
            }
            if( ! defined( 'QCLD_openai_addon_IMG_URL' ) ){
                define('QCLD_openai_addon_IMG_URL', QCLD_openai_addon_PLUGIN_URL . "images/");
            }
            if( ! defined( 'QCLD_openai_addon_IMG_ABSOLUTE_PATH' ) ){
                define('QCLD_openai_addon_IMG_ABSOLUTE_PATH', plugin_dir_path(__FILE__) . "images");
            }

        }


        public function qcld_wb_chatbot_admin_scripts(){
            // wp_register_style('qlcd-open-ai-bootstap', QCLD_openai_addon_PLUGIN_URL . 'css/openai-bootstrap.css', '', QCLD_openai_addon_VERSION, 'screen');
            // wp_enqueue_style('qlcd-open-ai-bootstap');
            // wp_register_style('qlcd-open-ai-admin-style', QCLD_openai_addon_PLUGIN_URL . 'css/openai-admin-style.css', '', QCLD_openai_addon_VERSION, 'screen');
            // wp_enqueue_style('qlcd-open-ai-admin-style');
            // wp_register_script('qlcd-openai_collapse', QCLD_openai_addon_PLUGIN_URL . 'js/collapse.js', array('jquery'),'',QCLD_openai_addon_VERSION,true);
            // wp_enqueue_script('qlcd-openai_collapse');
            // wp_register_script('qlcd-openai_settings', QCLD_openai_addon_PLUGIN_URL . 'js/openai_settings.js', array('jquery'),'',QCLD_openai_addon_VERSION,true);
            // wp_enqueue_script('qlcd-openai_settings');
            
            // wp_localize_script( 'qlcd-openai_settings', 'openai_ajax', array(
            //     'url' => admin_url( 'admin-ajax.php' ),
            // ) );
            
        }
        /**
         * Include all required files
         *
         * since 1.0.0
         *
         * @return void
         */
        public function includes() {
            require_once( QCLD_wpCHATBOT_PLUGIN_DIR_PATH . "includes/openai/qcld_wp_OpenAI.php" );
            require_once( QCLD_wpCHATBOT_PLUGIN_DIR_PATH . "includes/openai/OpenAi_WPBot_Menu.php" );
          
        }
        // public function openai_file_delete_callback(){
        //     $file_id = sanitize_text_field($_POST['file_id']);
        //     $url = 'https://api.openai.com/v1/files/'. $file_id;
        //     $apt_key = "Authorization: Bearer ". get_option('open_ai_api_key');
        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, $url);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        //     $headers = array(
        //         $apt_key,
        //     );
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //     $result = curl_exec($ch);
        //     if (curl_errno($ch)) {
        //         echo 'Error:' . curl_error($ch);
        //     }
        //     curl_close($ch);
        //    wp_send_json( json_decode($result));
		//    wp_die();
        // }
      
        public function buildFormBody( $fields, $boundary )
        {
            $body = '';
            foreach ( $fields as $name => $value ) {
            if ( $name == 'data' ) {
                continue;
            }
            $body .= "--$boundary\r\n";
            $body .= "Content-Disposition: form-data; name=\"$name\"";
            if ( $name == 'file' ) {
                $body .= "; filename=\"{$value}\"\r\n";
                $body .= "Content-Type: application/json\r\n\r\n";
                $body .= $fields['data'] . "\r\n";
            }else {
                $body .= "\r\n\r\n$value\r\n";
            }
            }
            $body .= "--$boundary--\r\n";
            return $body;
        }

        // public function openai_file_list_callback(){
        //     $url = 'https://api.openai.com/v1/files';
        //     $apt_key = "Authorization: Bearer ". get_option('open_ai_api_key');
        //     $curl = curl_init();
        //     curl_setopt($curl, CURLOPT_URL, $url);
        //     $headers = array(
        //         "Content-Type: application/json",
        //         $apt_key,
        //     );
        //     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //     $response = curl_exec($curl);
        //     curl_close($curl);
        //     wp_send_json( json_decode($response));
		//     wp_die();
        // }
        public function qcld_sanitize_text_or_array_field($array_or_string) {
            if( is_string($array_or_string) ){
                $array_or_string = sanitize_text_field($array_or_string);
            }elseif( is_array($array_or_string) ){
                foreach ( $array_or_string as $key => &$value ) {
                    if ( is_array( $value ) ) {
                        $value = $this->sanitize_text_or_array_field($value);
                    }
                    else {
                        $value = sanitize_text_field( $value );
                    }
                }
            }

            return $array_or_string;
        }
     
        // public function openai_file_upload_callback(){
        //     $uploadedfile = $_FILES['file'];
        //     $url = 'https://api.openai.com/v1/files';
        //     $apt_key = "Authorization: Bearer ". get_option('open_ai_api_key');
        //     $curl = curl_init($url);
        //     curl_setopt($curl, CURLOPT_URL, $url);
        //     curl_setopt($curl, CURLOPT_POST, true);
        //     $headers = array(
        //         "Content-Type: multipart/form-data",
        //         $apt_key,
        //     );
        //     if (function_exists('curl_file_create')) { 
        //         $tmp_file = curl_file_create($uploadedfile['tmp_name'], 'jsonl', $uploadedfile['name']);
        //     } else { 
        //         $tmp_file = open($uploadedfile['tmp_name']);
        //     }
        //     $data = array('file'=> $tmp_file,'purpose'=> 'fine-tune');
        //     $init = curl_init();
        //     //function parameteres
        //     curl_setopt($init, CURLOPT_URL,$url);
        //     curl_setopt($init, CURLOPT_HTTPHEADER, $headers);
        //     curl_setopt($init, CURLOPT_POSTFIELDS, $data);
        //     curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        //     $res = json_decode(curl_exec ($init));
            
        //     curl_close ($init);
        //     if(!empty($res->error)){
        //         $response['status'] = 'error';
        //         $response['message'] = $res->error->message;
        //     }
            
        //     if(!empty($res->status)){
        //         $response['status'] = 'success';
        //         $response['message'] = 'Successfully Created file' . $res->id ; 
                
        //     }
        //     echo wp_send_json([$response]);
        //     wp_die();
        // }
        public function openai_finetune_create($file_id,$ft_suffix,$ft_engines){
            $apt_key = "Authorization: Bearer ". get_option('open_ai_api_key');
            $headers = array(
                "Content-Type: application/json",
                $apt_key,
            );
            $curl = curl_init();
            $qcld_openai_suffix = isset($ft_suffix) ? $ft_suffix : get_option('qcld_openai_suffix');
            $openai_engines = isset($ft_engines) ? $ft_engines : get_option('openai_engines');
            $base_engine = explode('-',$openai_engines);
            if( $base_engine[0] == 'gpt'){
                $data = json_encode(array('training_file'=>$file_id,'model' => $openai_engines, 'suffix' => $qcld_openai_suffix ));
                $url = "https://api.openai.com/v1/fine_tuning/jobs";
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                $result = json_decode(curl_exec($curl));
                curl_close($curl);
            }else{

                $data = json_encode(array('training_file'=>$file_id,'model' => $base_engine[1], 'suffix' => $qcld_openai_suffix ));
                $url = "https://api.openai.com/v1/fine-tunes";
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                $result = json_decode(curl_exec($curl));
                curl_close($curl);
            }
            return $result;  
        }
     
        public function openai_retrive_fine_tune($keyword){
           
            $apt_key = "Authorization: Bearer ". get_option('open_ai_api_key');
            $headers = array(
                "Content-Type: application/json",
                $apt_key,
            );
            $curl = curl_init();
            $max_tokens =  (int)get_option( 'openai_max_tokens');
            $temp = (float)get_option( 'openai_temperature');
            $frequency_penalty = (float)get_option( 'frequency_penalty');
            $presence_penalty = (float)get_option( 'presence_penalty');
            $engines = explode('-',get_option( 'openai_engines'));
            $custom_model = get_option( 'qcld_openai_custom_model');
            $custom_model = (explode(":",$custom_model));
            $prompts = $this->get_prompt($keyword);
            
            if($custom_model[1] != 'gpt-3.5-turbo-0613'){
                $data = json_encode(array(
                    'prompt'=>  $prompts,
                    'model'=> get_option( 'qcld_openai_custom_model'),
                    "max_tokens" => $max_tokens,
                    "temperature" => $temp,
                    "top_p" => 1,
                    "presence_penalty" => $frequency_penalty,
                    "frequency_penalty"=> $presence_penalty,
                    "best_of"=> 1,
                    "stop"=> ["\n###\n","###"]
                 )); 
                $url = "https://api.openai.com/v1/completions";
    
                $ch = curl_init();
    
                curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                // curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
                $result = (curl_exec($ch));
                $result = str_replace("#","",$result );
               
                return $result; 
                if (curl_errno($ch)) {
                    // phpcs:ignore
                    echo 'Error:' . curl_error($ch);
                }
                curl_close($ch);
            }else{
                $data = json_encode(array(
                    'model'=> get_option( 'qcld_openai_custom_model'),
                    "messages"=>  [
                      
                          [
                            "role"=> "user",
                            "content"=>$keyword
                          ]
                          
                    ],
                    
                 ));
                $ch = curl_init();
    
                curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
                $results = (curl_exec($ch));
                $results = str_replace("#","",$result );
                $result = (json_decode($results)->choices[0]->message->content);
                return $result; 
            
              
            }
            
        }
        public function response_form_file($keyword){
            $max_tokens =  (int)get_option( 'openai_max_tokens');
            $temp = (float)get_option( 'openai_temperature');
            $frequency_penalty = (float)get_option( 'frequency_penalty');
            $presence_penalty = (float)get_option( 'presence_penalty');
            $engines = explode('-',get_option( 'openai_engines'));
            if($engines[0] != 'gpt'){
               // $prompts = $this->get_prompt($keyword);
            }
         
            $request_body = [
                "prompt" =>   $keyword,
                "model" => get_option( 'qcld_openai_custom_model'),
                "max_tokens" => $max_tokens,
                "temperature" => 0,
                "top_p" => 1,
                "stop" => [], 
                "presence_penalty" => 0,
                "frequency_penalty"=> 0,
                "best_of"=> 1,
            ];
            $postFields = json_encode($request_body);
            $OpenAI =  new qcld_wp_OpenAI();
            $result = $OpenAI->get_response($postFields);

            return $result;
        }
        public function get_prompt($keyword){
          $openai_include_keyword =  get_option( 'openai_include_keyword'); 
          $openai_exclude_keyword = get_option( 'openai_exclude_keyword'); 
          $qcld_openai_prompt = get_option('qcld_openai_prompt',true);
      
        }
        public function include_exclude_prompt($keyword){
            $openai_include_keyword = strtolower(get_option('openai_include_keyword'));
            $openai_exclude_keyword = strtolower(get_option('openai_exclude_keyword'));
           
            if((get_option('openai_include_keyword')  != '') || (get_option('openai_exclude_keyword')  == '')){
                $prompts    = 'If the query is not relevant  to one of the keywords: '.$openai_include_keyword .' then only say DUH. Provide a response only if the following query is relevant to one of the keywords: '.$openai_include_keyword .' The actual query is as follows: '. $keyword;
                return $prompts;
            }else if((get_option('openai_include_keyword')  == '') || (get_option('openai_exclude_keyword')  != '')){
                
                $prompts = 'If the query is relevant to one of the keywords: ' .$openai_exclude_keyword . ',  then do not respond and only say "DUH."   The actual query is as follows: '. $keyword. '?/n';
                return $prompts;
            }else if((get_option('openai_include_keyword')  != '') || (get_option('openai_exclude_keyword')  != '')){
                $prompts    = 'If the query is not relevant  to one of the keywords: '.$openai_include_keyword .' then only say "DUH." Provide a response only if the following query is relevant to one of the keywords: '.$openai_include_keyword .' The actual query is as follows: '. $keyword;
                return $prompts;
            }
        }
        public function qcld_include_keyword_exist( $keyword ){
            $keyword = isset($keyword) ? $keyword : '';
            $openai_include_keywords = strtolower(get_option('openai_include_keyword'));
            if(!empty($keyword)){
                $openai_include_keyword = ( isset( $openai_include_keywords ) ?  $openai_include_keywords : '');
    
                if( !empty($openai_include_keyword)){
                    $include_items = explode(',', $openai_include_keyword);
                    if(!empty($include_items)){
                        foreach($include_items as $k => $item){
                            if((strpos($keyword,trim($item)) !== false) && !empty($item)){
                                return true;
                            }
                        }
                    }
                    return false;
                }
            }
        
            return false;
    
        }
        public function openai_response_callback() {
            // $nonce =  sanitize_text_field($_POST['nonce']);
            // if (! wp_verify_nonce($nonce,'qcsecretbotnonceval123qc')) {
            //     wp_send_json(array('success' => false, 'msg' => esc_html__('Failed in Security check', 'sm')));
            //     wp_die();

            // }else{
                $response['status'] = 'success';
                $response['message'] ='A preset message';
                $OpenAI =  new qcld_wp_OpenAI();
                $gptkeyword = [];
                $keyword = sanitize_text_field($_POST['keyword']);
               if(get_option( 'is_asst_enabled') != 1){
                    $response_files = $this->openai_retrive_fine_tune($keyword);
                    $response_file = json_decode($response_files, true);
                    $gptkeywords = [];
                    if((empty($response_file['choices'][0]["text"])) && empty($response_file['choices'][0]["message"]['content'])){
                    
                            
                            if(empty($_COOKIE["last_five_prompt"])){
                                array_push($gptkeyword, array(
                                    "role" => "user",
                                    "content" =>  $keyword
                                ));
                                setcookie('last_five_prompt', base64_encode(maybe_serialize($gptkeyword)) , time() + (60000), "/");
                            }else{
                                $data = ($_COOKIE['last_five_prompt']);
                                $data = (base64_decode($data));
                                $gptkeyword =  maybe_unserialize($data);
                                if(is_array($gptkeyword)){
                                    array_push( $gptkeyword, array(
                                        "role" => "user",
                                        "content" => $keyword
                                    ));
                                    setcookie('last_five_prompt', base64_encode(maybe_serialize($gptkeyword)) , time() + (60000), "/");
                                }
                            }
                            if(((get_option('openai_include_keyword')  != '') ||  (get_option('openai_exclude_keyword')  != '')) && (get_option('qcld_openai_relevant_enabled') == '1') ){
                                $prompts =  $this->include_exclude_prompt($keyword);
                            
                                $gptkeyword = [];
                                array_push($gptkeyword, array(
                                    "role" => "user",
                                    "content" =>  $prompts,
                                ));
                            }else if(((get_option('openai_include_keyword')  != '') ||  (get_option('openai_exclude_keyword')  != '')) && (get_option('qcld_openai_relevant_enabled') == '0')){
                                if($this->qcld_include_keyword_exist($keyword) == false){
                                
                                    $response['message'] = 'Sorry, No result found!';
                                    echo json_encode($response);
                                    wp_die();
                                }else{
                                    array_push($gptkeyword, array(
                                        "role" => "user",
                                        "content" =>  $keyword
                                    ));
                                }
                                
                            }
                            
                            $res = $OpenAI->gptcomplete(
                                $gptkeyword
                            );   
                            $mess = json_decode($res); 
                            $response['message'] = $mess->choices[0]->message->content;
                            if(($response['message'] == 'DUH.') || ($response['message'] == 'DUH')){
                                $response['message'] = 'Sorry, No result found!';
                            }
                            if(get_option('conversation_continuity') == 1){
                                $data = ($_COOKIE['last_five_prompt']);
                                $data = (base64_decode($data));
                                $gptkeywords =  maybe_unserialize($data);
                                if(is_array($gptkeywords)){
                                    array_push( $gptkeywords, array(
                                        "role" => "assistant",
                                        "content" =>  $response['message']
                                    ));
                                    setcookie('last_five_prompt', base64_encode(maybe_serialize($gptkeywords)) , time() + (60000), "/");
                                }
                            }
        
                    
                    }else if(!empty($response_file['choices'][0]["message"]['content'])){
                        $result = $response_file['choices'][0]["message"]['content'];
                        $response['message'] = $result;
                    }else{
                        $result = $response_file['choices'][0]["text"];
                        $message = explode(">",$result);
                        if(empty($message)){
                            $message = $result;
                        }elseif(empty($message[1])){
                            $message = $message[0];
                        }else{
                            $message = $message[1];
                        }
                        if(get_option('conversation_continuity') == 1){
                            $lasfivecookie = $_COOKIE["last_five_prompt"] . $message . '###';
                            setcookie('last_five_prompt', $lasfivecookie, time() + (60000), "/");
                            $response['cookie'] =  $lasfivecookie;
                        }
                        $response['message'] = $message;
                    }
                }else{
                        $url = 'https://api.openai.com/v1/threads';
                        $api_key = get_option('open_ai_api_key');
                        $engines = get_option( 'openai_engines');
                        
                        $header  = [
                            'Content-Type: application/json',
                            'OpenAI-Beta: assistants=v1',
                            'Authorization: Bearer ' . $api_key
                        ];
                      //  $threads_id = '';
                        $threads_id_COOKIE = $_COOKIE["qcld_threads_id"];
                        $threads_id = $threads_id_COOKIE;
                        if(($threads_id == '')){
                               
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt($ch, CURLOPT_POST, 1);
                        //    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_fields));
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                            $threads = curl_exec($ch);
                            $threads_id = json_decode($threads)->id;
                            setcookie('qcld_threads_id',$threads_id  , time() + (60000), "/");
                            if (curl_errno($ch)) {
                                // phpcs:ignore
                                echo 'Error: ' . curl_error($ch);
                            }
                            curl_close($ch);
                        }
                        
                        $msg = $this->add_on_thrrads($threads_id,$keyword);
                        $response['message'] = $msg;

                }
                echo json_encode($response);
                wp_die();
            //}
        }
        public function openai_settings_option_callback() {
		    $nonce =  sanitize_text_field($_POST['nonce']);

            if (! wp_verify_nonce($nonce,'wp_chatbot')) {
                wp_send_json(array('success' => false, 'msg' => esc_html__('Failed in Security check', 'sm')));
                wp_die();

            }else{
               
                $api_key = sanitize_text_field($_POST['api_key']);
                $openai_engines = sanitize_text_field($_POST['openai_engines']);
                $qcld_openai_prompt = sanitize_text_field($_POST['qcld_openai_prompt']);
                $max_tokens = sanitize_text_field($_POST['max_tokens']);
                $qcld_openai_suffix = (!empty($_POST['qcld_openai_suffix'])) ? sanitize_text_field($_POST['qcld_openai_suffix']) : '';
                $qcld_openai_custom_model = sanitize_text_field($_POST['qcld_openai_custom_model']);
                $frequency_penalty = sanitize_text_field($_POST['frequency_penalty']);
                $presence_penalty = sanitize_text_field($_POST['presence_penalty']);
                $temperature = sanitize_text_field($_POST['temperature']);
                $ai_enabled = sanitize_text_field($_POST['ai_enabled']);
               
                $is_relevant_enabled = sanitize_text_field($_POST['is_relevant_enabled']);
              
                $ai_only_mode =  sanitize_text_field($_POST['ai_only_mode']);
                $file_id = (!empty($_POST['file_id'])) ? sanitize_text_field($_POST['file_id']) : '';
                $qcld_openai_prompt_custom = sanitize_text_field($_POST['qcld_openai_prompt_custom']);
                $conversation_continuity = sanitize_text_field($_POST['conversation_continuity']);
				
				/* Customized by Kadir on 05-12-2023 : To set empty value for API field */

                $disable_ss = sanitize_text_field($_POST['disable_ss']);
                
                if($api_key  != ''){
                    update_option( 'open_ai_api_key', $api_key );
                }
                else{
                    delete_option( 'open_ai_api_key');
                }
                
                /* Ends: Customized by Kadir on 05-12-2023 : To set empty value for API field */
				
                if($openai_engines  != ''){
                    update_option( 'openai_engines', $openai_engines );
                }
                if($conversation_continuity  != ''){
                    update_option( 'conversation_continuity', $conversation_continuity );
                }
                update_option( 'openai_max_tokens', $max_tokens );
                
                if($qcld_openai_suffix != ''){
                update_option('qcld_openai_suffix', $qcld_openai_suffix);
                }
                if($frequency_penalty  != ''){
                update_option( 'frequency_penalty', $frequency_penalty );
                }
                if($presence_penalty  != ''){
                    update_option( 'presence_penalty', $presence_penalty );
                }
                if($temperature  != ''){
                update_option( 'openai_temperature', $temperature );
                }
                if($qcld_openai_prompt_custom  != ''){
                    update_option('qcld_openai_prompt_custom', $qcld_openai_prompt_custom );
                }
                update_option('qcld_openai_custom_model',$qcld_openai_custom_model);
                
                update_option('ai_enabled',$ai_enabled);
                update_option('qcld_openai_relevant_enabled',$is_relevant_enabled);
                
                if($file_id  != ''){
                    update_option('file_id',$file_id);
                }
                $openai_include_keyword = sanitize_text_field($_POST['openai_include_keyword']);
                update_option('openai_include_keyword',$openai_include_keyword);
                $openai_exclude_keyword = sanitize_text_field($_POST['openai_exclude_keyword']);
                update_option('openai_exclude_keyword',$openai_exclude_keyword);
				
				
				/* Customized by Kadir on 05-12-2023 : To Disable Site Search*/
                //Disable Site Search
                if( $disable_ss == 1 ){
                    update_option('disable_wp_chatbot_site_search',1);
                }
                /* Ends: Customized by Kadir on 05-12-2023 : To Disable Site Search*/
				
				
              
            }
               
                if(($ai_only_mode != '') && ($ai_only_mode == 0)){
                
                    update_option('ai_only_mode', $ai_only_mode);
                   // update_option('enable_wp_chatbot_disable_allicon', 0);
                  //  update_option('qcld_disable_start_menu', 0);
                  //  update_option('show_menu_after_greetings', 0);
                  //  update_option('skip_wp_greetings', 0);
                   // update_option('disable_wp_chatbot_site_search',0);
                    // update_option('disable_wp_chatbot_call_gen',0);
                    // update_option('disable_wp_chatbot_feedback',0);
                    // update_option('disable_wp_chatbot_faq',0);
                    // update_option('disable_email_subscription',0);
                    // update_option('disable_str_categories',0);
                    // update_option('disable_good_bye',0);

                }else if(($ai_only_mode != '') && ($ai_only_mode == 1)){
                    update_option('ai_only_mode', $ai_only_mode);
                    update_option('enable_wp_chatbot_disable_allicon', 1);
                    update_option('qcld_disable_start_menu', 1);
                    update_option('show_menu_after_greetings', 1);
                    update_option('skip_wp_greetings', 1);
                    update_option('disable_wp_chatbot_site_search',1);
                    update_option('disable_wp_chatbot_call_gen',1);
                    update_option('disable_wp_chatbot_feedback',1);
                    update_option('disable_wp_chatbot_faq',1);
                    update_option('disable_email_subscription',1);
                    update_option('disable_str_categories',1);
                    update_option('disable_good_bye',1);
                }
                
                if($qcld_openai_prompt != ''){
                    update_option('qcld_openai_prompt', $qcld_openai_prompt);
                }
                $tem = get_option( 'openai_temperature', $temperature );
            
                echo json_encode($ai_enabled);wp_die();
            
        }

    }

    /**
     * @return qcld_wpopenai_addon
     */
    if(!function_exists('qcld_wpopenai_addons')){
        function qcld_openais() {
            $qcld_wpopenai_addon = new qcld_wpopenai_addons();
            return $qcld_wpopenai_addon->instance();
        
        }
    }
  
    //fire off the plugin
    qcld_openais();

}