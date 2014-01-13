<?php

namespace DevHub;

function wp_doc_comment( $comment, $args, $depth ) {
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<article id="comment-<?php comment_ID(); ?>" class="comment">

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your example is awaiting moderation.', 'wporg' ); ?></em>
			<br />
		<?php endif; ?>

		<pre class="example-content"><?php echo htmlentities( get_comment_text() ); ?></pre>

		<footer class="comment-meta">
			<div class="comment-author vcard">
				<?php
				echo get_avatar( $comment );

				/* translators: 1: comment author, 2: date and time */
				printf( __( 'Contributed by %1$s on %2$s', 'wporg' ),
						sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
						sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'wporg' ), get_comment_date(), get_comment_time() )
						)
				);
				?>

				<?php edit_comment_link( __( 'Edit', 'wporg' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			<!-- .comment-author .vcard -->

		</footer>

	</article>
	<!-- #comment-## -->

<?php
}

/**
 * Get current (latest) since version
 *
 * @return object
 */
function get_current_version() {

	$version = get_terms( 'wpapi-since', array(
			'number' => '1',
			'order'  => 'DESC',
	) );

	return $version[0];
}

/**
 * Retrieve function name and arguments as signature string
 *
 * @param int $post_id
 *
 * @return string
 */
function get_signature( $post_id = null ) {

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	$signature    = get_the_title( $post_id ) . '(';
	$args         = get_post_meta( $post_id, '_wpapi_args', true );
	$args_strings = array();

	foreach ( $args as $arg ) {

		$arg_string = '';
		if ( ! empty ( $arg['type'] ) ) {
			$arg_string .= $arg['type'];
		}

		if ( ! empty ( $arg['name'] ) ) {
			$arg_string .= ' ' . $arg['name'] . ' ';
		}

		if ( array_key_exists( 'default', $arg ) ) {

			if ( null === $arg['default'] ) {
				$arg['default'] = 'null';
			}

			$arg_string .= '= ' . $arg['default'];
		}

		$args_strings[] = $arg_string;
	}


	$signature .= implode( ', ', $args_strings ) . ' )';

	return esc_html( $signature );
}

/**
 * Retrieve return type and description if available
 *
* @param int $post_id
 *
 * @return string
 */
function get_return( $post_id = null ) {

	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	$tags   = get_post_meta( $post_id, '_wpapi_tags', true );
	$return = wp_filter_object_list( $tags, array( 'name' => 'return' ) );

	if ( empty( $return ) ) {
		$description = '';
		$type        = 'void';
	} else {
		$return      = array_shift( $return );
		$description = empty( $return['content'] ) ? '' : esc_html( $return['content'] );
		$type        = empty( $return['types'] ) ? '' : esc_html( implode( '|', $return['types'] ) );
	}

	return "<span class='return-type'>{$type}</span> $description";
}

/**
 * Retrieve URL to since version archive
 *
 * @param string $name
 *
 * @return string
 */
function get_since_link( $name = null ) {

	$since_object = get_term_by( 'name', empty( $name ) ? get_since() : $name, 'wpapi-since' );

	return empty( $since_object ) ? '' : esc_url( get_term_link( $since_object ) );
}

/**
 * Retrieve name of since version
 *
 * @param int $post_id
 *
 * @return string
 */
function get_since( $post_id = null ) {

	$since_object = wp_get_post_terms( empty( $post_id ) ? get_the_ID() : $post_id, 'wpapi-since', array( 'fields' => 'names' ) );

	return empty( $since_object ) ? '' : esc_html( $since_object[0] );
}