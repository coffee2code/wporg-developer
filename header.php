<?php
global $pagetitle;
$pagetitle = wp_title( '&laquo;', false, 'right' ) . ' ' . get_bloginfo( 'name' );
wp_enqueue_style( 'wporg-developer', get_bloginfo( 'stylesheet_url' ), array(), 1, 'screen' );
require WPORGPATH . 'header.php';
?>
<div class="devhub-wrap">

<div id="headline">
        <div class="wrapper">
					<?php if ( is_post_type_archive() ) : ?>
						<h2><a href="<?php $post_type = get_queried_object();
							echo get_post_type_archive_link( $post_type->name ); ?>"><?php echo esc_html( $post_type->labels->name ); ?></a>
						</h2>
					<?php else : ?>
						<h2><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
					<?php endif; ?>
        </div>
</div>

<div id="wrapper">
