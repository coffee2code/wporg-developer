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
		<?php breadcrumb_trail(); ?>

			<div class="reference-landing">
				<div class="search-guide section clear">
					<h4 class="ref-intro"><?php _e( 'Want to know what&#39;s going on inside WordPress? Search the Code Reference for more information about WordPress&#39; functions, hooks, and filters.', 'wporg' ); ?></h4>
					<h3 class="search-intro"><?php _e( 'Try it out:', 'wporg' ); ?></h3>
					<?php get_search_form(); ?>
				</div><!-- /search-guide -->

				<div class="topic-guide section">
					<h4><?php _e( 'Or browse through topics:', 'wporg' ); ?></h4>
					<ul class="unordered-list horizontal-list no-bullets">
						<li><a href="<?php echo get_post_type_archive_link( 'wpapi-function' ) ?>"><?php _e( 'Functions', 'wporg' ); ?></a></li>
						<li><a href="<?php echo get_post_type_archive_link( 'wpapi-hook' ) ?>"><?php _e( 'Hooks', 'wporg' ); ?></a></li>
						<li><a href="<?php echo get_post_type_archive_link( 'wpapi-class' ) ?>"><?php _e( 'Classes', 'wporg' ); ?></a></li>
					</ul>
				</div><!-- /topic-guide -->

				<div class="new-in-guide section two-columns clear">
					<div class="widget box gray">
						<h3 class="widget-title"><?php $version = DevHub\get_current_version(); printf( __( 'New in %s:', 'wporg' ), $version->name ); ?></h3>
						<div class="widget-content">
							<ul class="unordered-list no-bullets">
								<?php

								$list = new WP_Query( array(
									'posts_per_page' => 10,
									'post_type'      => array( 'wpapi-function', 'wpapi-hook', 'wpapi-class' ),
									'orderby'        => 'title',
									'order'          => 'ASC',
									'tax_query'      => array( array(
										'taxonomy' => 'wpapi-since',
										'field'    => 'ids',
										'terms'    => $version->term_id,
									) ),
								) );

								while ( $list->have_posts() ) : $list->the_post();

									echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';

								endwhile;
								?>
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
