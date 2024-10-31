<?php
/*
Plugin Name: Quick Find
Plugin URI: http://wpquicktips.wordpress.com
Description: This plugin adds a hierarchical navigation to your 'Pages' menu. This enables you to quickly find the page you want to edit.
Author: Vincent Boiardt
Version: 1.1
Author URI: http://boiardt.se
*/

function quickfind_menu(){
	add_pages_page( __( 'Quick Find' ), __( 'Quick Find' ), 'edit_pages', 'quickfind', 'quickfind' );
}
add_action( 'admin_menu', 'quickfind_menu' );

function quickfind_head() { ?>
<link type="text/css" href="<?php echo WP_PLUGIN_URL . '/quick-find/quickfind.css'; ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WP_PLUGIN_URL . '/quick-find/quickfind.js'; ?>"></script>
<?php
}
add_action( 'admin_head', 'quickfind_head' );

function quickfind_get_pages() {
	$walker = new QuickFind_Walker();
	echo '<ul class="quickfind">';
	wp_list_pages( array( 'title_li' => '', 'walker' => $walker ) );
	echo '</ul>';
	die();
}
add_action( 'wp_ajax_quickfind_get_pages', 'quickfind_get_pages' );

class QuickFind_Walker extends Walker_Page {
	function start_el(&$output, $page, $depth, $args, $current_page) {
		$output .= '<li><a href="post.php?action=edit&post=' . $page->ID . '" title="' . esc_attr( wp_strip_all_tags( apply_filters( 'the_title', $page->post_title ) ) ) . '"><span class="toggle" />' . apply_filters( 'the_title', $page->post_title ) . '</a>';
	}
}
?>