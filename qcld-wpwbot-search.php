<?php
/**
 * Product indexing, caching & searching features concept is taken from open source 'Advanced wp Search' Wp plugin by ILLID.
 */
//include_once( 'includes/class-wpwbot-cache.php' );

include_once( 'includes/class-wpwbot-table.php' );
include_once( 'includes/class-wpwbot-search.php' );

function wpbo_search_site() {
	
	global $wpdb;
	if(get_option('enable_wp_chatbot_post_content') == 1){
		$keyword = sanitize_text_field($_POST['keyword']);
		$enable_post_types = array( 'post', 'page');
		$query_arg = array(
			'post_type'     => $enable_post_types,
			'post_status'   => 'publish',
			'posts_per_page'=> $total_items,
			's'             => stripslashes( $keyword ),
			'paged'			=> 1,
			'suppress_filters' => true
		);
		$resultss = new WP_Query( $query_arg );
		$results = $resultss->posts;
		

	}else{

		$keyword = sanitize_text_field($_POST['keyword']);

		$sql = $wpdb->prepare("SELECT * FROM ". $wpdb->prefix."posts where post_type in ('page', 'post') and post_status='publish' and ((post_title LIKE %s)) order by ID DESC", '%' . $wpdb->esc_like($keyword) . '%');

		$results = $wpdb->get_results( $sql ); //DB Call OK, No Caching OK

	}
	
	if(!empty( $results )){
		$response['status'] = 'success';
		$response['html'] = '<div class="wpb-search-result">';
		$total_post = 0;
		
		foreach ( $results as $result ) {
			//var_dump($result);wp_die();
			$url_check = str_replace(site_url(), '', get_permalink($result->ID));
			$url_check = explode('/',$url_check);
			$url_check = str_replace('/', '', $url_check);
		
			$total_post = $total_post + 1;
			$responses .='<div class="wpbot_card_wraper">';
			$responses .=	'<div class="wpbot_card_image '.($result->post_type=='product'?'wp-chatbot-product':'').' '.($featured_img_url==''?'wpbot_card_image_saas':'').'"><a href="'.esc_url(get_permalink($result->ID)).'" '.($new_window==1?'target="_blank"':'').' '.($result->post_type=='product'?'wp-chatbot-pid="'.$result->ID.'"':'').'>';
			if($featured_img_url!=''){
				$responses .=		'<img src="'.esc_url_raw($featured_img_url).'" />';
			}
			$responses .=		'<div class="wpbot_card_caption '.($featured_img_url==''?'wpbot_card_caption_saas':'').'">';
			$responses .=			'<h4>'.esc_html($result->post_title).'</h4>';
			if($result->post_type=='product'){
				if ( class_exists( 'WooCommerce' ) ) {
					$product = wc_get_product( $result->ID );
					$responses .=			'<p class="wpbot_product_price">'.get_woocommerce_currency_symbol().$product->get_price_html().'</p>';
				}
			}
			$responses .=		'</div>';
			$responses .=	'</a></div>';
				$responses .='</div>';
			
		}
		$response['html'] .= $responses;
		$response['html'] .='</div>';
	}else{
		$response['status'] = 'success';
		$q = (explode(" ",$keyword)); 
		$n = '%';
		$search =
		$searchand = '';
		$results = [];
		foreach ( (array) $q as $term ) {

			$term = esc_sql( like_escape( $term ) );

			$sql = $wpdb->prepare("SELECT * FROM ". $wpdb->prefix."posts where post_type in ('page', 'post') and post_status='publish' and ((post_title LIKE %s')) order by ID DESC", '%'. $term .'%');

			$results[] = $wpdb->get_results( $sql ); //DB Call OK, No Caching OK

		}
		if(  !empty( $results) ){
			$count = 0;
			$response['html'] = '<div class="wpb-search-result">';
			$total_post = 0;
			foreach ($results as $value) {
				if(!empty($value[0]->guid)){
					if($url_check[1] == $selected_lan){
						$total_post = $total_post + 1;
						$responses .='<div class="wpbot_card_wraper">';
						$responses .=	'<div class="wpbot_card_image '.($featured_img_url==''?'wpbot_card_image_saas':'').'"><a href="'.$value[0]->guid.'" '.($new_window==1?'target="_blank"':'').'>';
						if($featured_img_url!=''){
							$responses .=		'<img src="'.$featured_img_url.'" />';
						}
						$responses .=		'<div class="wpbot_card_caption '.($featured_img_url==''?'wpbot_card_caption_saas':'').'">';
						$responses .=			'<h4>'.$value[0]->post_title.'</h4>';
						$responses .=		'</div>';
						$responses .=	'</a></div>';
						$responses .='</div>';
					}		
				}
			}
			if($total_post > 0 ){
				$response['status'] = 'success';
			}else{
				$response['status'] = 'fail';
			}
			$response['html'] .= '<p>'.$msg.'</p>';
			$response['html'] .= $responses;
			$response['html'] .='</div>';
			if($results->found_posts > $searchlimit){
				$load_more = maybe_unserialize(get_option('qlcd_wp_chatbot_load_more_search'));
				$default_language = qcld_wpbot()->helper->default_langauge();
				$response['html'] .='<button type="button" class="wp-chatbot-loadmore2" data-search-type="default-wp-search" data-keyword="'.$keyword.'" data-page="2">'. (($load_more !='') ? $load_more[$default_language] :'Load More').'  <span class="wp-chatbot-loadmore-loader"></span></button>';
			}
		}
	}
	echo json_encode($response);
	wp_die();
}

add_action( 'wp_ajax_wpbo_search_site',        'wpbo_search_site' );
add_action( 'wp_ajax_nopriv_wpbo_search_site', 'wpbo_search_site' );

add_action( 'wp_ajax_wpbo_search_responseby_intent',        'qc_wpbo_search_responseby_intent' );
add_action( 'wp_ajax_nopriv_wpbo_search_responseby_intent', 'qc_wpbo_search_responseby_intent' );

function qc_wpbo_search_responseby_intent(){

	global $wpdb;

	$keyword = sanitize_text_field($_POST['keyword']);

	$table = $wpdb->prefix.'wpbot_response';

	$result = $wpdb->get_row( $wpdb->prepare("SELECT `response` FROM `$table` WHERE 1 and `intent` = '%s'", $keyword) ); //DB Call OK, No Caching OK
	
	$response = array('status'=>'fail');
	
	if(!empty($result)){

		$response['status'] = 'success';
		$response['html'] = $result->response;

	}

	echo json_encode($response);

	die();

}

add_action( 'wp_ajax_wpbo_search_response_catlist',        'wpbo_search_response_catlist' );
add_action( 'wp_ajax_nopriv_wpbo_search_response_catlist', 'wpbo_search_response_catlist' );

function wpbo_search_response_catlist(){
	global $wpdb;
	$table = $wpdb->prefix.'wpbot_response_category';
	
	$status = array('status'=>'fail');
	$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$table`")); //DB Call OK, No Caching OK
	$response_result = array();
	
	if(!empty($results)){
		foreach($results as $result){
			
			$response_result[] = array('name'=>$result->name);
			
		}
	}
	
	if(!empty($response_result)){

		$status = array('status'=>'success', 'data'=>$response_result);
		

	}
	
	echo json_encode($status);

	die();
	
}

add_action( 'wp_ajax_wpbo_search_response',        'qc_wpbo_search_response' );
add_action( 'wp_ajax_nopriv_wpbo_search_response', 'qc_wpbo_search_response' );



function qc_wpbo_search_response(){
	global $wpdb;
	$keyword = (sanitize_text_field($_POST['keyword']));
	$strid = (sanitize_text_field($_POST['strid']));
	$table = $wpdb->prefix.'wpbot_response';
	

	$response_result = array();

	$status = array('status'=>'fail', 'multiple'=>false);
	$field = "ID";
	if(($strid != '') && empty($response_result)){
		$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM %i WHERE %i = %d",$table,$field,$strid)); //DB Call OK, No Caching OK
		if(!empty($results)){
			foreach($results as $result){
				
				$response_result[] = array('id'=>$result->id,'query'=>$result->query, 'response'=>$result->response, 'score'=>1);
				
			}
		}
	}
	$field = "query";
	$sql_text = $wpdb->prepare("SELECT `id`, `query`, `response` FROM %i WHERE 1 and %i =  %s", $table, $field,$keyword);
	$results = $wpdb->get_results($sql_text); //DB Call OK, No Caching OK
	
	
	if(!empty($results)){
		foreach($results as $result){
			
			$response_result[] = array('id'=>$result->id,'query'=>$result->query, 'response'=>$result->response, 'score'=>1);
			
		}
	}

	$field = "category";
	if(empty($response_result)){
		$sql = $wpdb->prepare("SELECT `id`, `query`, `response` FROM %i  WHERE 1 and %i = %s", $table,$field, $keyword);
		$results = $wpdb->get_results($sql ); //DB Call OK, No Caching OK
		
		
		if(!empty($results)){
			foreach($results as $result){
				$response_result[] = array('id'=>$result->id,'query'=>$result->query, 'response'=>$result->response, 'score'=>1);
			}
			if(count($response_result)>1){
				$status = array('status'=>'success','category'=> true, 'multiple'=>true, 'data'=>$response_result);
			}else{
				$status = array('status'=>'success', 'category'=> true, 'multiple'=>false, 'data'=>$response_result);
			}
			
			echo json_encode($status);

			die();
		}
		
	}
	
	if(class_exists('Qcld_str_pro')){
		if(get_option('qc_bot_str_remove_stopwords') && get_option('qc_bot_str_remove_stopwords')==1){
			$keyword = qc_strpro_remove_stopwords($keyword);
		}
	}
	
	
	if(empty($response_result)){

		$fields = get_option('qc_bot_str_fields');

		if($fields && !empty($fields)){
			$qfields = implode(', ', $fields);
		}else{
			$qfields = '`query`,`keyword`,`response`';
		}

		$sql = "ALTER TABLE `{$table}` ADD FULLTEXT($qfields);";

		$wpdb->query( $sql ); //DB Call OK, No Caching OK
		
		$sql_text = $wpdb->prepare("SELECT `id`, `query`, `response`, MATCH($qfields) AGAINST(%s IN NATURAL LANGUAGE MODE) as score FROM %i WHERE MATCH($qfields) AGAINST(%s IN NATURAL LANGUAGE MODE) order by score desc limit 15",$keyword,$table,$keyword);

		$results = $wpdb->get_results($sql_text); //DB Call OK, No Caching OK

		$weight = get_option('qc_bot_str_weight')!=''?get_option('qc_bot_str_weight'):'0.4';
		
		if(!empty($results)){
			foreach($results as $result){
				if(($result->score) >= ($weight)){
					$response_result[] = array('id'=>$result->id,'query'=>$result->query, 'response'=>$result->response, 'score'=>$result->score);
				}
			}
		}
	}
	$field = "keyword";
	if( empty( $response_result ) ){
		
		$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM %i WHERE %i REGEXP %s", $table,$field,$keyword)); //DB Call OK, No Caching OK
		
		
		if(!empty($results)){
			foreach($results as $result){
				$response_result[] = array('id'=>$result->id,'query'=>$result->query, 'response'=>$result->response, 'score'=>1);
			}
		}
	}
	if(!empty($response_result)){
		
		if(count($response_result)>1){
			$status = array('status'=>'success', 'multiple'=>true, 'data'=>$response_result);
		}else{
			$status = array('status'=>'success', 'multiple'=>false, 'data'=>$response_result);
		}

	}
	if(empty($result->query)){
		$status = array('status'=>'fail', 'multiple'=>false, 'data'=>$response_result);
	}
	echo json_encode($status);

	die();

}

function qc_strpro_remove_stopwords($keyword){
	
	if(get_option('qlcd_wp_chatbot_stop_words') && get_option('qlcd_wp_chatbot_stop_words')!=''){
		$commonWords = explode(',', get_option('qlcd_wp_chatbot_stop_words'));
		return preg_replace('/\b('.implode('|',$commonWords).')\b/','',$keyword);
	}else{
		return $keyword;
	}
	
 
	
}
