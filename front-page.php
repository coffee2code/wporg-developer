<?php get_header(); ?>

<div class="pagebody">
	<div class="wrapper">

		<div class="reference-landing">

			<div class="search-guide section clear">
				<h3><?php _e( 'Find what you need:', 'wporg' ); ?></h3>
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

			<div class="new-in-guide section clear">
				<div class="widget box box-left">
					<h3 class="widget-title"><?php $version = DevHub\get_current_version(); printf( __( 'New in %s:', 'wporg' ), $version->name ); ?></h3>
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
				<div class="widget box box-right">
					<h3 class="widget-title"><?php _e( 'APIs', 'wporg' ); ?></h3>
					<ul class="unordered-list no-bullets">
						<li><a href="#">Some API</a></li>
						<li><a href="#">Some other API</a></li>
						<li><a href="#">Another new API</a></li>
					</ul>
				</div>
			</div><!-- /new-in-guide -->

		</div><!-- /reference-landing -->

	</div><!-- /wrapper -->
</div><!-- /pagebody -->

<?php get_footer(); ?>
