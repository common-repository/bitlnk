<?php
/**
 * @package BitLnk
 * @version 1.4
 */
/*
Plugin Name: BitLnk for Wordpress
Plugin URI: http://bitlnk.co
Description: Create tiny urls from your posts with this super easy to use BitLnk plugin for Wordpress.
Author: BitLnk.co
Version: 1.4
Author URI: http://bitlnk.co
*/

add_action( 'post_submitbox_misc_actions', 'bitLnk' );


function bitLnk() {
    global $post;
    if (get_post_type($post) == 'post') {
        echo '<hr><div class="misc-pub-section misc-pub-section-last">';
        wp_nonce_field( plugin_basename(__FILE__), 'article_or_box_nonce' );
        $val = get_post_meta( $post->ID, '_article_or_box', true ) ? get_post_meta( $post->ID, '_article_or_box', true ) : 'article';
        echo '<label for="bitLnk">Generated BitLnk</label><br /><input type="text" name="bitLnk" id="bitLnk" value="'.generateBitlnk().'"/> ';
      	echo '<a href="'.generateBitlnk().'" target="_blank"><input class="button tagadd" value="Open" type="button"></a>';
        echo '</div><hr>';

    }
}


function generateBitlnk() {
	$permalink = get_permalink();
	$get = "http://bitlnk.co/api/shorten/?data=" . $permalink;
	$result = file_get_contents($get);
	if($result == FALSE) {
	return "Error";
	}
	else {
	return $result;
	}
}
?>