<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package wporg-developer
 */
get_template_part( 'org', 'header' );
wp_head();
?>

<div id="page" class="hfeed site devhub-wrap">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="inner-wrap">
			<div class="site-branding">
				<?php if ( ! is_front_page() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<h1 class="home-site-title site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
			</div>
		</div><!-- .inner-wrap -->
	</header><!-- #masthead -->
	<?php if ( ! is_front_page() ) : ?>
			<div class="wp-logo">
				<div class="dashicons dashicons-wordpress-alt"></div>
			</div>
	<?php endif; ?>
	<div id="content" class="site-content">
