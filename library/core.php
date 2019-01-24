<?php
/**
 * A set of core functions.
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    1.0
 * @version  2.5.0
 * @version  2.6.0
 *
 * Contents:
 *
 *   1) Required files
 *  10) Theme upgrade action
 *  20) Branding
 *  30) Post/page
 *  40) CSS functions
 * 100) Helpers
 */





/**
 * 1) Required files
 */

	// Theme Hook Alliance support

		require_once( trailingslashit( dirname( __FILE__ ) ) . 'hooks.php' );

	// Customizer generator

		require_once( trailingslashit( dirname( __FILE__ ) ) . 'customize.php' );

	// Admin required files

		if ( is_admin() ) {
			require_once( trailingslashit( dirname( __FILE__ ) ) . 'admin.php' );
		}





/**
 * 10) Theme upgrade action
 */

	/**
	 * Do action on theme version change
	 *
	 * @since    1.0
	 * @version  2.0
	 * @version  2.6.0
	 */
	if ( ! function_exists( 'wm_theme_upgrade' ) ) {
		function wm_theme_upgrade() {

			// Helper variables

				$current_theme_version = get_transient( 'auberge-version' );
				$new_theme_version     = wp_get_theme( get_template() )->get( 'Version' );


			// Processing

				if (
					empty( $current_theme_version )
					|| $new_theme_version != $current_theme_version
				) {
					do_action( 'wmhook_theme_upgrade', $new_theme_version, $current_theme_version );
					set_transient( 'auberge-version', $new_theme_version );
				}

		}
	} // /wm_theme_upgrade

	add_action( 'init', 'wm_theme_upgrade' );





/**
 * 20) Branding
 */

	/**
	 * Logo
	 *
	 * Accessibility rules applied.
	 *
	 * @link  http://blog.rrwd.nl/2014/11/21/html5-headings-in-wordpress-lets-fight/
	 *
	 * @since    1.0
	 * @version  2.5.0
	 */
	if ( ! function_exists( 'wm_logo' ) ) {
		function wm_logo( $container_class = 'site-branding' ) {

			// Output

				get_template_part( 'template-parts/site', 'branding' );

		}
	} // /wm_logo

	add_action( 'tha_header_top', 'wm_logo', 110, 0 );





/**
 * 30) Post/page
 */

	/**
	 * Table of contents from <!--nextpage--> tag
	 *
	 * Will create a table of content in multipage post from
	 * the first H2 heading in each post part.
	 * Appends the output at the top and bottom of post content.
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  string $content
	 */
	if ( ! function_exists( 'wm_nextpage_table_of_contents' ) ) {
		function wm_nextpage_table_of_contents( $content ) {

			// Helper variables

				global $page, $numpages, $multipage, $post;

				// Requirements check

					if (
							! $multipage
							|| ! is_singular()
						) {
						return $content;
					}

				$title_text = apply_filters( 'wmhook_wm_nextpage_table_of_contents_title_text', sprintf( esc_html_x( '"%s" table of contents', '%s: post title.', 'auberge' ), the_title_attribute( 'echo=0' ) ) );
				$title      = apply_filters( 'wmhook_wm_nextpage_table_of_contents_title', '<h2 class="screen-reader-text">' . $title_text . '</h2>' );

				$args = apply_filters( 'wmhook_wm_nextpage_table_of_contents_atts', array(
						'disable_first' => true, // First part to have a title of the post (part title won't be parsed)?
						'links'         => array(), // The output HTML links
						'post_content'  => ( isset( $post->post_content ) ) ? ( $post->post_content ) : ( '' ), // Get the whole post content
						'tag'           => 'h2', // HTML heading tag to parse as a post part title
					) );

				// Post part counter

					$i = 0;


			// Processing

				$args['post_content'] = explode( '<!--nextpage-->', (string) $args['post_content'] );

				// Get post parts titles

					foreach ( $args['post_content'] as $part ) {

						// Current post part number

							$i++;

						// Get title for post part

							if ( $args['disable_first'] && 1 === $i ) {

								$part_title = get_the_title();

							} else {

								preg_match( '/<' . tag_escape( $args['tag'] ) . '(.*?)>(.*?)<\/' . tag_escape( $args['tag'] ) . '>/', $part, $matches );

								if ( ! isset( $matches[2] ) || ! $matches[2] ) {
									$part_title = sprintf( esc_html__( 'Page %s', 'auberge' ), number_format_i18n( $i ) );
								} else {
									$part_title = $matches[2];
								}

							}

						// Set post part class

							if ( $page === $i ) {
								$class = ' class="current"';
							} elseif ( $page > $i ) {
								$class = ' class="passed"';
							} else {
								$class = '';
							}

						// Post part item output

							$args['links'][$i] = (string) apply_filters( 'wmhook_wm_nextpage_table_of_contents_part', '<li' . $class . '>' . _wp_link_page( $i ) . $part_title . '</a></li>', $i, $part_title, $class, $args );

					} // /foreach

				// Add table of contents into the post/page content

					$args['links'] = implode( '', $args['links'] );

					$links = apply_filters( 'wmhook_wm_nextpage_table_of_contents_links', array(
							// Display table of contents before the post content only in first post part
								'before' => ( 1 === $page ) ? ( '<div class="post-table-of-contents top" title="' . esc_attr( strip_tags( $title_text ) ) . '">' . $title . '<ol>' . $args['links'] . '</ol></div>' ) : ( '' ),
							// Display table of cotnnets after the post cotnent on each post part
								'after'  => '<div class="post-table-of-contents bottom" title="' . esc_attr( strip_tags( $title_text ) ) . '">' . $title . '<ol>' . $args['links'] . '</ol></div>',
						), $args );

					$content = $links['before'] . $content . $links['after'];


			// Output

				return $content;

		}
	} // /wm_nextpage_table_of_contents

	add_filter( 'the_content', 'wm_nextpage_table_of_contents', 10 );



		/**
		 * Parted post navigation
		 *
		 * Shim for passing the Theme Check review.
		 * Using table of contents generator instead.
		 *
		 * @since    1.0
		 * @version  2.0
		 */
		if ( ! function_exists( 'wm_link_pages_shim' ) ) {
			function wm_link_pages_shim() {

				// Processing

					wp_link_pages();

			}
		} // /wm_link_pages_shim



	/**
	 * Post meta info
	 *
	 * hAtom microformats compatible. @link http://goo.gl/LHi4Dy
	 * Supports WP ULike plugin. @link https://wordpress.org/plugins/wp-ulike/
	 * Supports ZillaLikes plugin. @link http://www.themezilla.com/plugins/zillalikes/
	 * Supports Post Views Count plugin. @link https://wordpress.org/plugins/baw-post-views-count/
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  array $args
	 */
	if ( ! function_exists( 'wm_post_meta' ) ) {
		function wm_post_meta( $args = array() ) {

			// Helper variables

				$output = '';

				$args = wp_parse_args( $args, apply_filters( 'wmhook_wm_post_meta_defaults', array(
						'class'       => 'entry-meta',
						'container'   => 'div',
						'date_format' => null,
						'html'        => '<span class="{class}"{attributes}>{description}{content}</span> ',
						'html_custom' => array(), // Example: array( 'date' => 'CUSTOM_HTML_WITH_{class}_{attributes}_{description}_AND_{content}_HERE' )
						'meta'        => array(), // Example: array( 'date', 'author', 'category', 'comments', 'permalink' )
						'post_id'     => null,
					) ) );
				$args = apply_filters( 'wmhook_wm_post_meta_args', $args );

				$args['meta'] = array_filter( (array) $args['meta'] );

				if ( $args['post_id'] ) {
					$args['post_id'] = absint( $args['post_id'] );
				}


			// Requirements check

				if ( empty( $args['meta'] ) ) {
					return;
				}


			// Processing

				foreach ( $args['meta'] as $meta ) {

						$helper = '';

						$replacements  = (array) apply_filters( 'wmhook_wm_post_meta_replacements', array(), $meta, $args );
						$output_single = apply_filters( 'wmhook_wm_post_meta', '', $meta, $args );
						$output       .= $output_single;

					// Predefined metas

						switch ( $meta ) {

							case 'author':

								if ( apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args ) ) {
									$helper = ( function_exists( 'wm_schema_org' ) ) ? ( wm_schema_org( 'name' ) ) : ( '' );

									$replacements = array(
											'{attributes}'  => ( function_exists( 'wm_schema_org' ) ) ? ( wm_schema_org( 'author' ) . wm_schema_org( 'Person' ) ) : ( '' ),
											'{class}'       => esc_attr( 'byline author vcard entry-meta-element' ),
											'{description}' => '<span class="entry-meta-description">' . esc_html_x( 'Written by:', 'Post meta info description: author name.', 'auberge' ) . ' </span>',
											'{content}'     => '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="url fn n" rel="author"' . $helper . '>' . get_the_author() . '</a>',
										);
								}

							break;
							case 'category':

								if (
										apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args )
										&& wm_is_categorized_blog()
										&& ( $helper = get_the_category_list( ', ', '', $args['post_id'] ) )
									) {
									$replacements = array(
											'{attributes}'  => '',
											'{class}'       => esc_attr( 'cat-links entry-meta-element' ),
											'{description}' => '<span class="entry-meta-description">' . esc_html_x( 'Categorized in:', 'Post meta info description: categories list.', 'auberge' ) . ' </span>',
											'{content}'     => $helper,
										);
								}

							break;
							case 'comments':

								if (
										apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args )
										&& ! post_password_required()
										&& (
											comments_open( $args['post_id'] )
											|| get_comments_number( $args['post_id'] )
										)
									) {
									$helper       = get_comments_number( $args['post_id'] );
									$element_id   = ( $helper ) ? ( '#comments' ) : ( '#respond' );
									$replacements = array(
											'{attributes}'  => '',
											'{class}'       => esc_attr( 'comments-link entry-meta-element' ),
											'{description}' => '<span class="entry-meta-description">' . esc_html_x( 'Comments:', 'Post meta info description: comments count.', 'auberge' ) . ' </span>',
											'{content}'     => '<a href="' . esc_url( get_permalink( $args['post_id'] ) ) . $element_id . '" title="' . esc_attr( sprintf( esc_html_x( 'Comments: %s', '%s: number of comments.', 'auberge' ), number_format_i18n( $helper ) ) ) . '"><span class="comments-title">' . esc_html_x( 'Comments:', 'Title for number of comments in post meta.', 'auberge' ) . ' </span><span class="comments-count">' . $helper . '</span></a>',
										);
								}

							break;
							case 'date':

								if ( apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args ) ) {
									$helper = ( function_exists( 'wm_schema_org' ) ) ? ( wm_schema_org( 'datePublished' ) ) : ( '' );

									$replacements = array(
											'{attributes}'  => '',
											'{class}'       => esc_attr( 'entry-date entry-meta-element' ),
											'{description}' => '<span class="entry-meta-description">' . esc_html_x( 'Posted on:', 'Post meta info description: publish date.', 'auberge' ) . ' </span>',
											'{content}'     => '<a href="' . esc_url( get_permalink( $args['post_id'] ) ) . '" rel="bookmark"><time datetime="' . esc_attr( get_the_date( 'c' ) ) . '" class="published" title="' . esc_attr( get_the_date() ) . ' | ' . esc_attr( get_the_time( '', $args['post_id'] ) ) . '"' . $helper . '>' . esc_html( get_the_date( $args['date_format'] ) ) . '</time></a>',
										);

									if ( function_exists( 'wm_schema_org' ) ) {
										$replacements['{content}'] = $replacements['{content}'] . wm_schema_org( 'dateModified', get_the_modified_date( 'c' ) );
									}
								}

							break;
							case 'edit':

								if (
										apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args )
										&& ( $helper = get_edit_post_link( $args['post_id'] ) )
									) {
									$the_title_attribute_args = array( 'echo' => false );
									if ( $args['post_id'] ) {
										$the_title_attribute_args['post'] = $args['post_id'];
									}

									$replacements = array(
											'{attributes}'  => '',
											'{class}'       => esc_attr( 'entry-edit entry-meta-element' ),
											'{description}' => '',
											'{content}'     => '<a href="' . esc_url( $helper ) . '" title="' . esc_attr( sprintf( esc_html__( 'Edit the "%s"', 'auberge' ), the_title_attribute( $the_title_attribute_args ) ) ) . '"><span>' . esc_html_x( 'Edit', 'Edit post link.', 'auberge' ) . '</span></a>',
										);
								}

							break;
							case 'likes':

								if ( apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args ) ) {

									if ( function_exists( 'wp_ulike' ) ) {
									// WP ULike first

										$replacements = array(
												'{attributes}'  => '',
												'{class}'       => esc_attr( 'entry-likes entry-meta-element' ),
												'{description}' => '',
												'{content}'     => wp_ulike( 'put' ),
											);

									} elseif ( function_exists( 'zilla_likes' ) ) {
									// ZillaLikes after

										global $zilla_likes;

										$replacements = array(
												'{attributes}'  => '',
												'{class}'       => esc_attr( 'entry-likes entry-meta-element' ),
												'{description}' => '',
												'{content}'     => $zilla_likes->do_likes(),
											);

									}

								}

							break;
							case 'permalink':

								if ( apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args ) ) {
									$the_title_attribute_args = array( 'echo' => false );
									if ( $args['post_id'] ) {
										$the_title_attribute_args['post'] = $args['post_id'];
									}

									$replacements = array(
											'{attributes}'  => ( function_exists( 'wm_schema_org' ) ) ? ( wm_schema_org( 'url' ) ) : ( '' ),
											'{class}'       => esc_attr( 'entry-permalink entry-meta-element' ),
											'{description}' => '<span class="entry-meta-description">' . esc_html_x( 'Bookmark link:', 'Post meta info description: post bookmark link.', 'auberge' ) . ' </span>',
											'{content}'     => '<a href="' . esc_url( get_permalink( $args['post_id'] ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'Permalink to "%s"', 'auberge' ), the_title_attribute( $the_title_attribute_args ) ) ) . '" rel="bookmark"><span>' . get_the_title( $args['post_id'] ) . '</span></a>',
										);
								}

							break;
							case 'tags':

								if (
										apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args )
										&& ( $helper = get_the_tag_list( '', ' ', '', $args['post_id'] ) )
									) {
									$replacements = array(
											'{attributes}'  => ( function_exists( 'wm_schema_org' ) ) ? ( wm_schema_org( 'keywords' ) ) : ( '' ),
											'{class}'       => esc_attr( 'tags-links entry-meta-element' ),
											'{description}' => '<span class="entry-meta-description">' . esc_html_x( 'Tagged as:', 'Post meta info description: tags list.', 'auberge' ) . ' </span>',
											'{content}'     => $helper,
										);
								}

							break;
							case 'views':

								if (
										apply_filters( 'wmhook_wm_post_meta_enable_' . $meta, true, $args )
										&& function_exists( 'bawpvc_views_sc' )
										&& ( $helper = bawpvc_views_sc( array() ) )
									) {
									$replacements = array(
											'{attributes}'  => ' title="' . esc_attr__( 'Views count', 'auberge' ) . '"',
											'{class}'       => esc_attr( 'entry-views entry-meta-element' ),
											'{description}' => '',
											'{content}'     => wp_strip_all_tags( $helper ),
										);
								}

							break;

							default:
							break;

						} // /switch

						// Single meta output

							$replacements = (array) apply_filters( 'wmhook_wm_post_meta_replacements_' . $meta, $replacements, $args );

							if (
									empty( $output_single )
									&& ! empty( $replacements )
								) {

								if ( isset( $args['html_custom'][ $meta ] ) ) {
									$output .= strtr( $args['html_custom'][ $meta ], (array) $replacements );
								} else {
									$output .= strtr( $args['html'], (array) $replacements );
								}

							}

				} // /foreach

				if ( $output ) {
					$output = '<' . tag_escape( $args['container'] ) . ' class="' . esc_attr( $args['class'] ) . '">' . $output . '</' . tag_escape( $args['container'] ) . '>';
				}


			// Output

				return $output;

		}
	} // /wm_post_meta



	/**
	 * Paginated heading suffix
	 *
	 * @since    1.0
	 * @version  2.5.0
	 *
	 * @param  string $tag           Wrapper tag
	 * @param  string $singular_only Display only on singular posts of specific type
	 */
	if ( ! function_exists( 'wm_paginated_suffix' ) ) {
		function wm_paginated_suffix( $tag = '', $singular_only = false ) {

			// Requirements check

				if (
					$singular_only
					&& ! is_singular( $singular_only )
				) {
					return;
				}


			// Helper variables

				global $page, $paged;

				$output    = '';
				$paginated = max( absint( $page ), absint( $paged ) );

				$tag = trim( $tag );
				if ( $tag ) {
					$tag = array( '<' . tag_escape( $tag ) . '>', '</' . tag_escape( $tag ) . '>' );
				} else {
					$tag = array( '', '' );
				}


			// Processing

				if ( 1 < $paginated ) {
					$output = ' ' . $tag[0] . sprintf( esc_html_x( '(page %s)', 'Paginated content title suffix, %s: page number.', 'auberge' ), number_format_i18n( $paginated ) ) . $tag[1];
				}


			// Output

				return apply_filters( 'wmhook_wm_paginated_suffix_output', $output );

		}
	} // /wm_paginated_suffix



	/**
	 * Checks for <!--more--> tag in post content
	 *
	 * @since    1.0
	 * @version  2.5.0
	 *
	 * @param  obj/absint $post
	 */
	if ( ! function_exists( 'wm_has_more_tag' ) ) {
		function wm_has_more_tag( $post = null ) {

			// Helper variables

				$output = false;

				if ( empty( $post ) ) {
					$post = $GLOBALS['post'];
				} elseif ( is_numeric( $post ) ) {
					$post = get_post( $post );
				}


			// Requirements check

				if ( ! $post instanceof WP_Post ) {
					return;
				}


			// Processing

				if ( preg_match( '/<!--more(.*?)?-->/', $post->post_content, $matches ) ) {
					$output = true;
					if ( ! empty( $matches[1] ) ) {
						$output = strip_tags( wp_kses_no_null( trim( $matches[1] ) ) );
					}
				}


			// Output

				return $output;

		}
	} // /wm_has_more_tag





/**
 * 40) CSS functions
 */

	// Escape inline CSS

		add_filter( 'wmhook_esc_css', 'wp_strip_all_tags' );





/**
 * 100) Helpers
 */

	/**
	 * Remove shortcodes from string
	 *
	 * This function keeps the text between shortcodes,
	 * unlike WordPress native strip_shortcodes() function.
	 *
	 * @since    1.0
	 * @version  2.0
	 *
	 * @param  string $content
	 */
	if ( ! function_exists( 'wm_remove_shortcodes' ) ) {
		function wm_remove_shortcodes( $content ) {

			// Output

				return preg_replace( '|\[(.+?)\]|s', '', $content );

		}
	} // /wm_remove_shortcodes

	add_filter( 'the_excerpt', 'wm_remove_shortcodes', 10 );



	/**
	 * Returns true if a blog has more than 1 category
	 *
	 * @since    1.0
	 * @version  1.0
	 */
	if ( ! function_exists( 'wm_is_categorized_blog' ) ) {
		function wm_is_categorized_blog() {

			// Processing

				if ( false === ( $all_the_cool_cats = get_transient( 'wm-all-categories' ) ) ) {

					// Create an array of all the categories that are attached to posts

						$all_the_cool_cats = get_categories( array(
								'fields'     => 'ids',
								'hide_empty' => 1,
								'number'     => 2, //we only need to know if there is more than one category
							) );

					// Count the number of categories that are attached to the posts

						$all_the_cool_cats = count( $all_the_cool_cats );

					set_transient( 'wm-all-categories', $all_the_cool_cats );

				}


			// Output

				if ( $all_the_cool_cats > 1 ) {

					// This blog has more than 1 category

						return true;

				} else {

					// This blog has only 1 category

						return false;

				}

		}
	} // /wm_is_categorized_blog



		/**
		 * Flush out the transients used in wm_is_categorized_blog
		 */
		if ( ! function_exists( 'wm_all_categories_transient_flusher' ) ) {
			function wm_all_categories_transient_flusher() {

				// Requirements check

					if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
						return;
					}

				// Processing

					// Like, beat it. Dig?

						delete_transient( 'wm-all-categories' );

			}
		} // /wm_all_categories_transient_flusher

		add_action( 'edit_category', 'wm_all_categories_transient_flusher' );
		add_action( 'save_post',     'wm_all_categories_transient_flusher' );



	/**
	 * Cache: Get transient key.
	 *
	 * @since    2.6.0
	 * @version  2.6.0
	 *
	 * @param  string $context
	 */
	if ( ! function_exists( 'wm_get_transient_key' ) ) {
		function wm_get_transient_key( $context = '' ) {

			// Output

				return 'auberge-' . sanitize_title( $context );

		}
	} // /wm_get_transient_key
