<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;
use WP_Widget;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt',     function ($wpse_excerpt='') {
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            //$wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.

                $excerpt_length = apply_filters('excerpt_length', 55);
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) {

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&raquo;&nbsp;' . sprintf(__( 'Read more about: %s &nbsp;&raquo;', 'wpse' ), get_the_title()) . '</a>';
                $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
                $wpse_excerpt .= $excerpt_more; /*Add read more in new paragraph */



        }
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }
);




//add_filter('wp_nav_menu_items',__NAMESPACE__ . '\\add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary_navigation' )
        $items=$items.'<li class="menu-item search" >'.get_search_form(false).'</li>';
      return $items;


}

// Numbered Pagination
if ( !function_exists( 'wpex_pagination' ) ) {

  function wpex_pagination() {

    $prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
    $next_arrow = is_rtl() ? '&larr;' : '&rarr;';

    global $wp_query;
    $total = $wp_query->max_num_pages;
    $big = 999999999; // need an unlikely integer
    if( $total > 1 )  {
       if( !$current_page = get_query_var('paged') )
         $current_page = 1;
       if( get_option('permalink_structure') ) {
         $format = 'page/%#%/';
       } else {
         $format = '&paged=%#%';
       }
      echo paginate_links(array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => $format,
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $total,
        'mid_size'    => 2,
        'type'      => 'list',
        'prev_text'   => $prev_arrow,
        'next_text'   => $next_arrow,
       ) );
    }
  }

}
//add_action( 'after_setup_theme', __NAMESPACE__ . '\\tgm_envira_define_license_key' );
/*
function tgm_envira_define_license_key() {

    // If the key has not already been defined, define it now.
    if ( ! defined( 'ENVIRA_LICENSE_KEY' ) ) {
        define( 'ENVIRA_LICENSE_KEY', 'f21b503f7793be583daab680a7f8bda7' );
    }

}
*/
add_action( 'wp_ajax_gesualdi_disco', __NAMESPACE__ . '\\gesualdi_disco' );
add_action( 'wp_ajax_nopriv_gesualdi_disco', __NAMESPACE__ . '\\gesualdi_disco' );
function gesualdi_disco() {
    if ( ! wp_verify_nonce( $_POST['nonce'], 'gesualdi-nonce' ) ) die ( 'Non autorizzato!');
    ob_clean();
    $post_link=isset( $_POST['postlink'] ) ? sanitize_text_field($_POST['postlink'] ):'';
    if($post_link !== ''){$post_id=url_to_postid($post_link);}else{
      $data=  __( '<p class="error"><strong>ERROR</strong>: No link. </p>', 'sage' );
    wp_send_json_error($data);
    wp_die();
    }
    if($post_id !==0){
      $disco=get_post($post_id );
      setup_postdata($GLOBALS['post'] =& $disco );
      //$title=mb_convert_encoding(get_the_title(), 'UTF-8', 'HTML-ENTITIES');
      $title=html_entity_decode( get_the_title( ), ENT_QUOTES, 'UTF-8' ) ;
               if(has_post_thumbnail($disco)){
              $thumb= get_the_post_thumbnail($disco->ID,'thumbnail');
            }else{
              $thumb= '<img src="'.get_stylesheet_directory_uri().'/dist/images/avatar-placeholder.png'.'" alt=""> ';
            }

      $strumento=get_field('strumento',$disco->ID);
      $excerpt=get_the_content( );

      wp_reset_postdata();
      $data= array('title'=>$title,'thumb'=>$thumb,'excerpt'=>wpautop($excerpt,true),'strumento'=>$strumento);
        wp_send_json_success( $data );
    }else{
      $data=  __( '<p class="error"><strong>ERROR</strong>: No post with id: </p>', 'sage' ).$post_id ;
    wp_send_json_error($data);
    }
    wp_die();
}
add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

add_action( 'after_setup_theme', __NAMESPACE__ . '\\tgm_envira_define_license_key' );
function tgm_envira_define_license_key() {

    // If the key has not already been defined, define it now.
    if ( ! defined( 'ENVIRA_LICENSE_KEY' ) ) {
        define( 'ENVIRA_LICENSE_KEY', 'f21b503f7793be583daab680a7f8bda7' );
    }

}

function hide_update_notice_to_all_but_admin_users()
{
    if (!current_user_can('update_core')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_head', __NAMESPACE__ . '\\hide_update_notice_to_all_but_admin_users', 1 );

function get_componenti_date(){
      $band=get_posts(array(
      "post_type"=>"band",
      "posts_per_page"=>-1
      ));
      $array=array();
      foreach ($band as $key => $componente) {
        setup_postdata($GLOBALS['post'] =& $componente );
        $perma=get_the_permalink($componente->ID);
        $array[$perma]=get_the_modified_date().' '.get_the_modified_time();
        wp_reset_postdata();
      }
      return $array;
}
