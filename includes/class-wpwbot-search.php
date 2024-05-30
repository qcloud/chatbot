<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists( 'wpwBot_Search' ) ) :
    /**
     * Class for plugin search
     */
    class wpwBot_Search {
        /**
         * @var AWS_Search Array of all plugin data $data
         */
        private $data = array();
        /**
         * Return a singleton instance of the current class
         *
         * @return object
         */
        public static function factory() {
            static $instance = false;
            if ( ! $instance ) {
                $instance = new self();
            }
            return $instance;
        }
        /**
         * Constructor
         */
        public function __construct() {}
        /*
         * Search
         */
        public function search( $keyword = ''  ) {
            global $wpdb;
            $special_chars = $this->get_special_chars();
            $s = $keyword ? esc_attr( $keyword ) : esc_attr( $_POST['keyword'] );
            $s = stripslashes( $s );
            $s = str_replace( array( "\r", "\n" ), '', $s );
            $s = str_replace( $special_chars, '', $s );
            $show_cats     = 'true';
            $show_tags     = 'true';
            $search_in     = 'true';
            $outofstock    = 'true';
            $search_in_arr = explode( ',',  'title,content,category,excerpt,tag,sku');
            // Search in title if all options is disabled
            if ( ! $search_in ) {
                $search_in_arr = array( 'title' );
            }
            $categories_array = array();
            $tags_array = array();
            $this->data['s'] = $s;
            $this->data['results_num']  =  50;//This static before setting option on wpwbot admin panel.
            $this->data['search_terms'] = array();
            $this->data['search_terms'] = array_unique( explode( ' ', $s ) );
            $this->data['search_in']    = $search_in_arr;
            $this->data['outofstock']   = $outofstock;
            $posts_ids = $this->query_index_table();
            $products_array = $this->get_products( $posts_ids );
            return $products_array;
        }
        /*
        * Get special characters that must be striped
        */
       public function get_special_chars() {
            $chars = array(
                '-',
                '_',
                '|',
                '+',
                '`',
                '~',
                '!',
                '@',
                '#',
                '$',
                '%',
                '^',
                '&',
                '*',
                '(',
                ')',
                '\\',
                '?',
                ';',
                ':',
                "'",
                '"',
                ".",
                ",",
                "<",
                ">",
                "{",
                "}",
                "/",
                "[",
                "]",
            );
            return apply_filters( 'aws_special_chars', $chars );
        }
        /*
         * Query in index table
         */
        private function query_index_table() {
            global $wpdb;
            $table_name = $wpdb->prefix . QCLD_wpCHATBOT_INDEX_TABLE;
            $search_in_arr    = $this->data['search_in'];
            $results_num      = $this->data['results_num'];
            $outofstock       = $this->data['outofstock'];
            $reindex_version = get_option( 'aws_reindex_version' );
            $query = array();
            $query['search'] = '';
            $query['source'] = '';
            $query['relevance'] = '';
            $query['stock'] = '';
            $query['visibility'] = '';
            $query['lang'] = '';
            $search_array = array();
            $source_array = array();
            $relevance_array = array();
            $new_relevance_array = array();
            foreach ( $this->data['search_terms'] as $search_term ) {
                $search_term_len = strlen( $search_term );
                $relevance_title        = 200 + 20 * $search_term_len;
                $relevance_content      = 35 + 4 * $search_term_len;
                $relevance_title_like   = 40 + 2 * $search_term_len;
                $relevance_content_like = 35 + 1 * $search_term_len;
                $search_term_like = preg_replace( '/(s|es|ies)$/i', '', $search_term );
                $like = '%' . $wpdb->esc_like( $search_term_like ) . '%';
                if ( $search_term_len > 1 ) {
                    $search_array[] = $wpdb->prepare( '( term LIKE %s )', $like );
                } else {
                    $search_array[] = $wpdb->prepare( '( term = "%s" )', $search_term );
                }
                foreach ( $search_in_arr as $search_in_term ) {
                    switch ( $search_in_term ) {
                        case 'title':
                            $relevance_array['title'][] = $wpdb->prepare( "( case when ( term_source = 'title' AND term = '%s' ) then {$relevance_title} * count else 0 end )", $search_term );
                            $relevance_array['title'][] = $wpdb->prepare( "( case when ( term_source = 'title' AND term LIKE %s ) then {$relevance_title_like} * count else 0 end )", $like );
                            break;
                        case 'content':
                            $relevance_array['content'][] = $wpdb->prepare( "( case when ( term_source = 'content' AND term = '%s' ) then {$relevance_content} * count else 0 end )", $search_term );
                            $relevance_array['content'][] = $wpdb->prepare( "( case when ( term_source = 'content' AND term LIKE %s ) then {$relevance_content_like} * count else 0 end )", $like );
                            break;
                        case 'excerpt':
                            $relevance_array['content'][] = $wpdb->prepare( "( case when ( term_source = 'excerpt' AND term = '%s' ) then {$relevance_content} * count else 0 end )", $search_term );
                            $relevance_array['content'][] = $wpdb->prepare( "( case when ( term_source = 'excerpt' AND term LIKE %s ) then {$relevance_content_like} * count else 0 end )", $like );
                            break;
                        case 'category':
                            $relevance_array['category'][] = $wpdb->prepare( "( case when ( term_source = 'category' AND term = '%s' ) then 35 else 0 end )", $search_term );
                            $relevance_array['category'][] = $wpdb->prepare( "( case when ( term_source = 'category' AND term LIKE %s ) then 5 else 0 end )", $like );
                            break;
                        case 'tag':
                            $relevance_array['tag'][] = $wpdb->prepare( "( case when ( term_source = 'tag' AND term = '%s' ) then 35 else 0 end )", $search_term );
                            $relevance_array['tag'][] = $wpdb->prepare( "( case when ( term_source = 'tag' AND term LIKE %s ) then 5 else 0 end )", $like );
                            break;
                        case 'sku':
                            $relevance_array['sku'][] = $wpdb->prepare( "( case when ( term_source = 'sku' AND term = '%s' ) then 300 else 0 end )", $search_term );
                            $relevance_array['sku'][] = $wpdb->prepare( "( case when ( term_source = 'sku' AND term LIKE %s ) then 50 else 0 end )", $like );
                            break;
                    }
                }
            }
            // Sort 'relevance' queries in the array by search priority
            foreach ( $search_in_arr as $search_in_item ) {
                if ( isset( $relevance_array[$search_in_item] ) ) {
                    $new_relevance_array[$search_in_item] = implode( ' + ', $relevance_array[$search_in_item] );
                }
            }
            foreach ( $search_in_arr as $search_in_term ) {
                $source_array[] = "term_source = '{$search_in_term}'";
            }
            $query['relevance'] .= sprintf( ' (SUM( %s )) ', implode( ' + ', $new_relevance_array ) );
            $query['search'] .= sprintf( ' AND ( %s )', implode( ' OR ', $search_array ) );
            $query['source'] .= sprintf( ' AND ( %s )', implode( ' OR ', $source_array ) );
            if ( $reindex_version && version_compare( $reindex_version, '1.16', '>=' ) ) {
                if ( $outofstock !== 'true' ) {
                    $query['stock'] .= " AND in_stock = 1";
                }
                $query['visibility'] .= " AND NOT visibility LIKE '%hidden%'";
            }
            if ( ( defined( 'ICL_SITEPRESS_VERSION' ) || function_exists( 'pll_current_language' ) ) && $reindex_version && version_compare( $reindex_version, '1.20', '>=' ) ) {
                $current_lang = false;
                if ( has_filter('wpml_current_language') ) {
                    $current_lang = apply_filters( 'wpml_current_language', NULL );
                } elseif ( function_exists( 'pll_current_language' ) ) {
                    $current_lang = pll_current_language();
                }
                if ( $current_lang ) {
                    $query['lang'] .= $wpdb->prepare( " AND ( lang LIKE %s OR lang = '' )", $current_lang );
                }
            } elseif( function_exists( 'qtranxf_getLanguage' ) ) {
                $current_lang = qtranxf_getLanguage();
                if ( $current_lang ) {
                    $query['lang'] .= $wpdb->prepare( " AND ( lang LIKE %s OR lang = '' )", $current_lang );
                }
            }

            $sql = $wpdb->prepare("SELECT
                    distinct ID,
                    {$query['relevance']} as relevance
                FROM
                    {$table_name}
                WHERE
                    type = 'product'
                {$query['source']}
                {$query['search']}
                {$query['stock']}
                {$query['visibility']}
                {$query['lang']}
                GROUP BY ID
                ORDER BY
                    relevance DESC
				LIMIT 0, %d
		    ", $results_num);

            //SQL was processed through $wpdb->prepare() in many steps.
            $posts_ids = $this->get_posts_ids( $sql ); //DB Call OK, No Caching OK

            return $posts_ids;

        }
        /*
         * Get array of included to search result posts ids
         */
        private function get_posts_ids( $sql ) {

            global $wpdb;

            $posts_ids = array();

            /**Passed SQL was processed using $wpdb->prepare() in line 198 and above*/
            // phpcs:ignore
            $search_results = $wpdb->get_results( $sql ); //DB Call OK, No Caching OK

            if ( !empty( $search_results ) && !is_wp_error( $search_results ) && is_array( $search_results ) ) {
                foreach ( $search_results as $search_result ) {
                    $post_id = intval( $search_result->ID );
                    if ( ! in_array( $post_id, $posts_ids ) ) {
                        $posts_ids[] = $post_id;
                    }
                }
            }

            unset( $search_results );

            return $posts_ids;

        }
        /**
         * @param $posts_ids
         * @return array
         */
        public function get_load_more_products($posts_ids){
            return $this->get_products($posts_ids);
        }
        /*
         * Get products info
         */
        private function get_products( $posts_ids ) {
           $product_per_page = get_option('qlcd_wp_chatbot_ppp') != '' ? get_option('qlcd_wp_chatbot_ppp') : 10;
           $products_array = array();
           $more_product_ids=array();
           $products_num =count( $posts_ids );
            if ( $products_num > 0 ) {
           //if result products ids are more than per_page then keep remaing ids as load more option.
               if($products_num >$product_per_page){
                   $more_product_ids=array_slice($posts_ids,$product_per_page);
                   $current_product_ids=array_slice($posts_ids,0,$product_per_page);
               }else{
                   $current_product_ids=$posts_ids;
               }
                foreach ( $current_product_ids as $post_id ) {
                    $product = wc_get_product( $post_id );
                    $products_array[] = $product;
                }
            }
            return array('products'=>$products_array,'more_ids'=>$more_product_ids,'total_products'=>$products_num);
        }
    }
endif;