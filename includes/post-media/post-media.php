<?php
/**
 * Post media display functions
 *
 * @package    Auberge
 * @copyright  WebMan Design, Oliver Juhas
 *
 * @since    2.0
 * @version  2.7.0
 */





/**
 * Thumbnail size setup
 */

	/**
	 * Post thumbnail (featured image) display size
	 *
	 * @since    1.4.2
	 * @version  2.1
	 *
	 * @param  string $image_size
	 */
	if ( ! function_exists( 'wm_post_thumbnail_size' ) ) {
		function wm_post_thumbnail_size( $image_size ) {

			// Processing

				if (
						is_single( get_the_ID() )
						|| is_page( get_the_ID() )
						|| is_attachment()
					) {

					$image_size = 'large';

				} else {

					$image_size = ( 'nova_menu_item' == get_post_type( get_the_ID() ) ) ? ( 'auberge_banner_small' ) : ( 'thumbnail' );

				}


			// Output

				return $image_size;

		}
	} // /wm_post_thumbnail_size

	add_filter( 'wmhook_entry_featured_image_size', 'wm_post_thumbnail_size' );



/**
 * Post formats media
 */

	/**
	 * Featured image
	 *
	 * @since    2.0
	 * @version  2.0
	 */
	if ( ! function_exists( 'wm_post_media' ) ) {
		function wm_post_media() {

			// Requirements check

				if ( wm_paginated_suffix( 'small', 'post' ) ) {
					return;
				}


			// Helper variables

				$output = '';
				$class  = 'entry-media';

				$image_size = apply_filters( 'wmhook_entry_featured_image_size', 'thumbnail' );


			// Processing

				if ( apply_filters( 'wmhook_wm_post_media_condition', ( ! is_single() || ! class_exists( 'WM_Post_Formats' ) ) ) ) {

					switch ( apply_filters( 'wmhook_wm_post_media_post_format', get_post_format() ) ) {

						case 'audio':
							$output .= wm_post_media_audio( $image_size );
							break;

						case 'gallery':
							$output .= wm_post_media_gallery( $image_size );
							break;

						case 'image':
							$output .= wm_post_media_image_content( $image_size );
							break;

						case 'quote':
							$output = '';
							break;

						case 'status':
							$output .= wm_post_media_image_avatar( $image_size );
							break;

						case 'video':
							$output .= wm_post_media_video( $image_size );
							break;

						default:
							$output .= wm_post_media_image_featured( $image_size );
							break;

					}

				} else {

					$output .= wm_post_media_image_featured( $image_size );

				}


			// Output

				if ( $output ) {
					echo '<div class="' . esc_attr( $class ) . '">' . $output . '</div>';
				}

		}
	} // /wm_post_media

	add_action( 'tha_entry_top', 'wm_post_media', 5 );



	/**
	 * Featured image
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  string $image_size
	 */
	if ( ! function_exists( 'wm_post_media_image_featured' ) ) {
		function wm_post_media_image_featured( $image_size ) {

			// Helper variables

				$output = '';

				$image_id = ( is_attachment() ) ? ( get_the_ID() ) : ( get_post_thumbnail_id() );


			// Processing

				if (
						( has_post_thumbnail() && apply_filters( 'wmhook_entry_featured_image_display', true ) )
						|| is_attachment()
					) {

					$image_link = ( is_single() || is_attachment() ) ? ( wp_get_attachment_image_src( $image_id, 'full' ) ) : ( array( esc_url( get_permalink() ) ) );
					$image_link = array_filter( (array) apply_filters( 'wmhook_entry_image_link', $image_link ) );

					$output .= '<figure class="post-thumbnail"' . wm_schema_org( 'image' ) . '>';

						if ( ! empty( $image_link ) ) {
							$output .= '<a href="' . esc_url( $image_link[0] ) . '">';
						}

						if ( is_attachment() ) {

							$output .= wp_get_attachment_image(
									$image_id,
									(string) $image_size
								);

							// Schema.org markup

								$schema_image = wp_get_attachment_image_src(
										$image_id,
										(string) $image_size
									);

								$output .= wm_schema_org( 'url', esc_url( $schema_image[0] ) );
								$output .= wm_schema_org( 'width', absint( $schema_image[1] ) );
								$output .= wm_schema_org( 'height', absint( $schema_image[2] ) );

						} else {

							$output .= get_the_post_thumbnail(
									null,
									(string) $image_size
								);

							// Schema.org markup

								$schema_image = wp_get_attachment_image_src(
										get_post_thumbnail_id(),
										(string) $image_size
									);

								if ( $schema_image ) {
									$output .= wm_schema_org( 'url', esc_url( $schema_image[0] ) );
									$output .= wm_schema_org( 'width', absint( $schema_image[1] ) );
									$output .= wm_schema_org( 'height', absint( $schema_image[2] ) );
								}

						}

						if ( ! empty( $image_link ) ) {
							$output .= '</a>';
						}

					$output .= '</figure>';

				}


			// Output

				return $output;

		}
	} // /wm_post_media_image_featured



	/**
	 * Featured or content image
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  string $image_size
	 */
	if ( ! function_exists( 'wm_post_media_image_content' ) ) {
		function wm_post_media_image_content( $image_size ) {

			// Requirements check

				if ( ! class_exists( 'WM_Post_Formats' ) ) {
					return;
				}


			// Helper variables

				$output = $schema_image = '';


			// Processing

				if ( has_post_thumbnail() ) {

					$output .= wm_post_media_image_featured( $image_size );

				} else {

					$image_link = ( is_single() || is_attachment() ) ? ( wp_get_attachment_image_src( $image_id, 'full' ) ) : ( array( esc_url( get_permalink() ) ) );
					$image_link = array_filter( (array) apply_filters( 'wmhook_post_media_image_content_link', $image_link ) );

					$post_media = (string) WM_Post_Formats::get();
					$image_alt  = the_title_attribute( 'echo=0' );

					// Get the image size URL if we got image ID

						if ( is_numeric( $post_media ) ) {
							$image_alt  = get_post_meta( absint( $post_media ), '_wp_attachment_image_alt', true );
							$post_media = wp_get_attachment_image_src( absint( $post_media ), $image_size );

							$schema_image = $post_media;

							$post_media = $post_media[0];
						}

					// Set the output

						if ( $post_media ) {

							$output .= '<figure class="post-thumbnail"' . wm_schema_org( 'image' ) . '>';

								if ( ! empty( $image_link ) ) {
									$output .= '<a href="' . esc_url( $image_link[0] ) . '">';
								}

								$output .= '<img src="' . esc_url( $post_media ) . '" alt="' . esc_attr( $image_alt ) . '" title="' . the_title_attribute( 'echo=0' ) . '" />';

								// Schema.org markup

									if ( ! empty( $schema_image ) ) {
										$output .= wm_schema_org( 'url', esc_url( $schema_image[0] ) );
										$output .= wm_schema_org( 'width', absint( $schema_image[1] ) );
										$output .= wm_schema_org( 'height', absint( $schema_image[2] ) );
									}

								if ( ! empty( $image_link ) ) {
									$output .= '</a>';
								}

							$output .= '</figure>';

						}

				}


			// Output

				return $output;

		}
	} // /wm_post_media_image_content



	/**
	 * Featured image or avatar
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  string $image_size
	 */
	if ( ! function_exists( 'wm_post_media_image_avatar' ) ) {
		function wm_post_media_image_avatar( $image_size ) {

			// Helper variables

				$output = '';


			// Processing

				if ( has_post_thumbnail() ) {

					$output .= wm_post_media_image_featured( $image_size );

				} else {

					// Get image width for avatar

						if ( in_array( $image_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

							$image_width = get_option( $image_size . '_size_w' );

						} else {

							global $_wp_additional_image_sizes;

							$image_width = 420;

							if ( isset( $_wp_additional_image_sizes[ $image_size ] ) ) {
								$image_width = $_wp_additional_image_sizes[ $image_size ]['width'];
							}

						}

					// Set the output

						$output .= '<figure class="post-thumbnail"' . wm_schema_org( 'image' ) . '>';

							$output .= get_avatar( get_the_author_meta( 'ID' ), absint( $image_width ) );

							// Schema.org markup

								$schema_image = get_avatar_url(
										get_the_author_meta( 'ID' ),
										array(
											'size' => absint( $image_width )
										)
									);

								$output .= wm_schema_org( 'url', esc_url( $schema_image ) );
								$output .= wm_schema_org( 'width', absint( $image_width ) );
								$output .= wm_schema_org( 'height', absint( $image_width ) );

						$output .= '</figure>';

				}


			// Output

				return $output;

		}
	} // /wm_post_media_image_avatar



	/**
	 * Gallery
	 *
	 * Displays images from gallery first.
	 * If no gallery exists, displays featured image.
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  string $image_size
	 */
	if ( ! function_exists( 'wm_post_media_gallery' ) ) {
		function wm_post_media_gallery( $image_size ) {

			// Requirements check

				if ( ! class_exists( 'WM_Post_Formats' ) ) {
					return;
				}


			// Helper variables

				$output = '';

				$images_count = apply_filters( 'wmhook_wm_post_media_gallery_images_count', 3 );

				$post_media = array_filter( array_slice( explode( ',', (string) WM_Post_Formats::get() ), 0, absint( $images_count ) ) ); // Get only $images_count images from gallery


			// Processing

				if (
						is_array( $post_media )
						&& ! empty( $post_media )
					) {

					$output .= '<div class="enable-slider">';

					foreach( $post_media as $image_id ) {
						$output .= '<a href="' . esc_url( get_permalink() ) . '" class="slide">';
						$output .= wp_get_attachment_image( absint( $image_id ), $image_size );
						$output .= '</a>';
					}

					$output .= '</div>';

				} else {

					$output .= wm_post_media_image_featured( $image_size );

				}


			// Output

				return $output;

		}
	} // /wm_post_media_gallery



	/**
	 * Audio
	 *
	 * Displays featured image only if it's a shortcode
	 * and it's not a playlist shortcode.
	 * After the image it displays audio player.
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  string $image_size
	 */
	if ( ! function_exists( 'wm_post_media_audio' ) ) {
		function wm_post_media_audio( $image_size ) {

			// Requirements check

				if ( ! class_exists( 'WM_Post_Formats' ) ) {
					return;
				}


			// Helper variables

				$output = '';

				$post_media = (string) WM_Post_Formats::get();

				$is_shortcode = ( 0 === strpos( $post_media, '[' ) );


			// Processing

				if (
						(
							false === strpos( $post_media, '[playlist' )
							|| ! $is_shortcode
						)
						&& false === strpos( $post_media, 'soundcloud.com' )
					) {

					$output .= wm_post_media_image_featured( $image_size );

				}

				if ( $post_media ) {

					if ( $is_shortcode ) {

						$post_media = do_shortcode( $post_media );

					} else {

						$post_media = wp_oembed_get( $post_media );

					}

					$output .= $post_media;

				}


			// Output

				return $output;

		}
	} // /wm_post_media_audio



	/**
	 * Video
	 *
	 * @since    2.0
	 * @version  2.0
	 *
	 * @param  string $image_size
	 */
	if ( ! function_exists( 'wm_post_media_video' ) ) {
		function wm_post_media_video( $image_size ) {

			// Requirements check

				if ( ! class_exists( 'WM_Post_Formats' ) ) {
					return;
				}


			// Helper variables

				$output = '';

				$post_media = (string) WM_Post_Formats::get();


			// Processing

				if ( $post_media ) {

					if ( 0 === strpos( $post_media, '[' ) ) {

						$post_media = do_shortcode( $post_media );

					} else {

						/**
						 * Filter the oEmbed HTML
						 *
						 * This is to provide compatibility with Jetpack Responsive Videos.
						 *
						 * By default there is no filter hook in `wp_oembed_get()` that Jetpack
						 * Responsive Videos hooks onto, that's why we need to add it here.
						 *
						 * @param  mixed  $html    The HTML output.
						 * @param  string $url     The attempted embed URL (the $post_media variable).
						 * @param  array  $attr    An array of shortcode attributes.
						 * @param  int    $post_id Post ID.
						 */
						$post_media = apply_filters( 'embed_oembed_html', wp_oembed_get( $post_media ), $post_media, array(), get_the_ID() );

					}

					$output .= $post_media;

				} else {

					$output .= wm_post_media_image_featured( $image_size );

				}


			// Output

				return $output;

		}
	} // /wm_post_media_video



	/**
	 * @todo  Remove with WP 5.2+?
	 *
	 * Fix for retrieving Gutenberg gallery setup parameters in array.
	 *
	 * @link  https://core.trac.wordpress.org/ticket/43826
	 *
	 * @since    2.7.0
	 * @version  2.7.0
	 *
	 * @param  array       $gallery  The first-found post gallery.
	 * @param  int|WP_Post $post     Post ID or object.
	 */
	if ( ! function_exists( 'wm_get_post_gallery_fix' ) ) {
		function wm_get_post_gallery_fix( $gallery, $post ) {

			// Variables

				$post = get_post( $post );


			// Requirements check

				if (
					$gallery
					|| ! $post
					|| ! function_exists( 'has_blocks' )
					|| ! has_blocks( $post->post_content )
				) {
					return $gallery;
				}


			// Processing

				preg_match_all(
					'/wp:gallery(.*)-->/i',
					$post->post_content,
					$galleries
				);

				if ( ! empty( $galleries[1] ) ) {
					$gallery = json_decode( reset( $galleries[1] ), true );
					foreach ( $gallery as $key => $value ) {
						if ( is_array( $value ) ) {
							$gallery[ $key ] = implode( ',', $value );
						}
					}
				}


			// Output

				return $gallery;

		}
	} // /wm_get_post_gallery_fix

	add_filter( 'get_post_gallery', 'wm_get_post_gallery_fix', 10, 2 );
