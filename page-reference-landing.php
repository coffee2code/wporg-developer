<?php
/**
 * The template for displaying the Code Reference landing page.
 *
 * Template Name: Reference
 *
 * @package wporg-developer
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="reference-landing">

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="search-guide section clear">
					<h4 class="ref-intro"><?php _e( 'Welcome to the WordPress Code Reference Manual, the online manual for WordPress development and a living repository for WordPress coding info and documentation.', 'wporg' ); ?></h4>
					<h3 class="search-intro"><?php _e( 'Find what you need:', 'wporg' ); ?></h3>
					<?php get_search_form(); ?>
				</div><!-- /search-guide -->

				<div class="topic-guide section">
					<h4><?php _e( 'Or browse through topics:', 'wporg' ); ?></h4>
					<ul class="unordered-list horizontal-list no-bullets">
						<li><a href="#">Some topic</a></li>
						<li><a href="#">Some other topic</a></li>
						<li><a href="#">Another new topic</a></li>
					</ul>
				</div><!-- /topic-guide -->

				<div class="new-in-guide section two-columns clear">
					<div class="widget box gray">
						<h3 class="widget-title"><?php _e( 'New in 3.5:', 'wporg' ); ?></h3>
						<div class="widget-content">
							<ul class="unordered-list no-bullets">
								<li><a href="#">Some function</a></li>
								<li><a href="#">Some other function</a></li>
								<li><a href="#">Another new function</a></li>
							</ul>
						</div>
					</div>
					<div class="widget box gray">
						<h3 class="widget-title"><?php _e( 'APIs', 'wporg' ); ?></h3>
						<div class="widget-content">
							<ul class="unordered-list no-bullets">
								<li><a href="#">Some API</a></li>
								<li><a href="#">Some other API</a></li>
								<li><a href="#">Another new API</a></li>
							</ul>
						</div>
					</div>
				</div><!-- /new-in-guide -->

			</div><!-- /reference-landing -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
