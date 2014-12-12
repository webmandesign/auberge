<?php
/**
 * Main Theme Hooks
 *
 * Compatible with Theme Hook Alliance (v1.0-draft)
 * @link https://github.com/zamoose/themehookalliance
 *
 * @package    Auberge
 * @copyright  2014 WebMan - Oliver Juhas
 * @version    1.0
 */





/**
 * Theme Hook Alliance basics
 */

	define( 'THA_HOOKS_VERSION', '1.0-draft' );



	/**
	 * Themes and Plugins can check for tha_hooks using current_theme_supports( 'tha_hooks', $hook )
	 * to determine whether a theme declares itself to support this specific hook type.
	 *
	 * Example:
	 * <code>
	 * 		// Declare support for all hook types
	 * 		add_theme_support( 'tha_hooks', array( 'all' ) );
	 *
	 * 		// Declare support for certain hook types only
	 * 		add_theme_support( 'tha_hooks', array( 'header', 'content', 'footer' ) );
	 * </code>
	 */
	add_theme_support( 'tha_hooks', array( 'all' ) );



	/**
	 * Determines, whether the specific hook type is actually supported.
	 *
	 * Plugin developers should always check for the support of a <strong>specific</strong>
	 * hook type before hooking a callback function to a hook of this type.
	 *
	 * Example:
	 * <code>
	 * 		if ( current_theme_supports( 'tha_hooks', 'header' ) )
	 * 	  		add_action( 'tha_head_top', 'prefix_header_top' );
	 * </code>
	 *
	 * @param   bool  $bool       True
	 * @param   array $args       The hook type being checked
	 * @param   array $registered All registered hook types
	 *
	 * @return  bool
	 */
	function tha_current_theme_supports( $bool, $args, $registered ) {
		return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
	} // /tha_current_theme_supports

	add_filter( 'current_theme_supports-tha_hooks', 'tha_current_theme_supports', 10, 3 );





/**
 * WebMan Theme Hooks
 */

	/**
	 * $tha_supports[] = 'html';
	 */

		/**
		 * HTML <html> hook
		 * Special case, useful for <DOCTYPE>, etc.
		 */
		function wmhook_html_before() {
			do_action( 'wmhook_html_before' );
			do_action( 'tha_html_before' );
		} // /wmhook_html_before



	/**
	 * $tha_supports[] = 'body';
	 */

		/**
		 * HTML <body> hooks
		 */
		function wmhook_body_top() {
			do_action( 'wmhook_body_top' );
			do_action( 'tha_body_top' );
		} // /wmhook_body_top

		function wmhook_body_bottom() {
			do_action( 'wmhook_body_bottom' );
			do_action( 'tha_body_bottom' );
		} // /wmhook_body_bottom



	/**
	 * $tha_supports[] = 'head';
	 */

		/**
		 * HTML <head> hooks
		 */
		function wmhook_head_top() {
			do_action( 'wmhook_head_top' );
			do_action( 'tha_head_top' );
		} // /wmhook_head_top

		function wmhook_head_bottom() {
			do_action( 'wmhook_head_bottom' );
			do_action( 'tha_head_bottom' );
		} // /wmhook_head_bottom



	/**
	 * $tha_supports[] = 'header';
	 */

		/**
		 * Semantic <header> hooks
		 */
		function wmhook_header_before() {
			do_action( 'wmhook_header_before' );
			do_action( 'tha_header_before' );
		} // /wmhook_header_before

		function wmhook_header_after() {
			do_action( 'wmhook_header_after' );
			do_action( 'tha_header_after' );
		} // /wmhook_header_after

		function wmhook_header() {
			do_action( 'wmhook_header' );
		} // /wmhook_header

		function wmhook_header_top() {
			do_action( 'wmhook_header_top' );
			do_action( 'tha_header_top' );
		} // /wmhook_header_top

		function wmhook_header_bottom() {
			do_action( 'wmhook_header_bottom' );
			do_action( 'tha_header_bottom' );
		} // /wmhook_header_bottom



	/**
	 * $tha_supports[] = 'content';
	 */

		/**
		 * Semantic <content> hooks
		 */
		function wmhook_content_before() {
			do_action( 'wmhook_content_before' );
			do_action( 'tha_content_before' );
		} // /wmhook_content_before

		function wmhook_content_after() {
			do_action( 'wmhook_content_after' );
			do_action( 'tha_content_after' );
		} // /wmhook_content_after

		function wmhook_content_top() {
			do_action( 'wmhook_content_top' );
			do_action( 'tha_content_top' );
		} // /wmhook_content_top

		function wmhook_content_bottom() {
			do_action( 'wmhook_content_bottom' );
			do_action( 'tha_content_bottom' );
		} // /wmhook_content_bottom


		function wmhook_postslist_before() {
			do_action( 'wmhook_postslist_before' );
		} // /wmhook_postslist_before

		function wmhook_postslist_after() {
			do_action( 'wmhook_postslist_after' );
		} // /wmhook_postslist_after

		function wmhook_postslist_top() {
			do_action( 'wmhook_postslist_top' );
		} // /wmhook_postslist_top

		function wmhook_postslist_bottom() {
			do_action( 'wmhook_postslist_bottom' );
		} // /wmhook_postslist_bottom



	/**
	 * $tha_supports[] = 'entry';
	 */

		/**
		 * Semantic <entry> hooks
		 */
		function wmhook_entry_before() {
			do_action( 'wmhook_entry_before' );
			do_action( 'tha_entry_before' );
		} // /wmhook_entry_before

		function wmhook_entry_after() {
			do_action( 'wmhook_entry_after' );
			do_action( 'tha_entry_after' );
		} // /wmhook_entry_after

		function wmhook_entry_top() {
			do_action( 'wmhook_entry_top' );
			do_action( 'tha_entry_top' );
		} // /wmhook_entry_top

		function wmhook_entry_bottom() {
			do_action( 'wmhook_entry_bottom' );
			do_action( 'tha_entry_bottom' );
		} // /wmhook_entry_bottom


		function wmhook_entry_container_atts() {
			do_action( 'wmhook_entry_container_atts' );
		} // /wmhook_entry_container_atts



	/**
	 * $tha_supports[] = 'comments';
	 */

		/**
		 * Comments block hooks
		 */
		function wmhook_comments_before() {
			do_action( 'wmhook_comments_before' );
			do_action( 'tha_comments_before' );
		} // /wmhook_comments_before

		function wmhook_comments_after() {
			do_action( 'wmhook_comments_after' );
			do_action( 'tha_comments_after' );
		} // /wmhook_comments_after



	/**
	 * $tha_supports[] = 'sidebar';
	 */

		/**
		 * Semantic <sidebar> hooks
		 */
		function wmhook_sidebars_before() {
			do_action( 'wmhook_sidebars_before' );
			do_action( 'tha_sidebars_before' );
		} // /wmhook_sidebars_before

		function wmhook_sidebars_after() {
			do_action( 'wmhook_sidebars_after' );
			do_action( 'tha_sidebars_after' );
		} // /wmhook_sidebars_after

		function wmhook_sidebar_top() {
			do_action( 'wmhook_sidebar_top' );
			do_action( 'tha_sidebar_top' );
		} // /wmhook_sidebar_top

		function wmhook_sidebar_bottom() {
			do_action( 'wmhook_sidebar_bottom' );
			do_action( 'tha_sidebar_bottom' );
		} // /wmhook_sidebar_bottom



	/**
	 * $tha_supports[] = 'footer';
	 */

		/**
		 * Semantic <footer> hooks
		 */
		function wmhook_footer_before() {
			do_action( 'wmhook_footer_before' );
			do_action( 'tha_footer_before' );
		} // wmhook_footer_before

		function wmhook_footer_after() {
			do_action( 'wmhook_footer_after' );
			do_action( 'tha_footer_after' );
		} // /wmhook_footer_after

		function wmhook_footer() {
			do_action( 'wmhook_footer' );
		} // /wmhook_footer

		function wmhook_footer_top() {
			do_action( 'wmhook_footer_top' );
			do_action( 'tha_footer_top' );
		} // /wmhook_footer_top

		function wmhook_footer_bottom() {
			do_action( 'wmhook_footer_bottom' );
			do_action( 'tha_footer_bottom' );
		} // /wmhook_footer_bottom

?>