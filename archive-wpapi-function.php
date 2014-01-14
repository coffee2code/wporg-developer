<?php namespace DevHub; ?>
<?php get_header(); ?>

<div class="<?php body_class( 'pagebody' ) ?>">
	<div class="wrapper">

		<?php breadcrumb_trail(); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php /** @var \WP_Query $wp_query */ if ( $wp_query->current_post ) : ?>
				<hr />
			<?php endif; ?>

			<?php get_template_part( 'content', get_post_type() ); ?>

		<?php endwhile; ?>

		<?php else : ?>

			<h1><?php _e( 'Not Found', 'wporg' ); ?></h1>

		<?php endif; ?>

		<?php loop_pagination(); ?>

	</div>
	<!-- /wrapper -->
</div><!-- /pagebody -->

<?php get_footer(); ?>
