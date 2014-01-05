<?php get_header(); ?>

<div class="<?php body_class( 'pagebody' ) ?>">
	<div class="wrapper">
		TODO Breadcrumb
		<?php // get_template_part( 'breadcrumbs' ); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php if ( $wp_query->current_post ) : ?>
				<hr />
			<?php endif; ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<h1><?php the_title(); ?></h1>

				<section class="content">
					<?php the_content(); ?>
				</section>

				<section class="return"><strong>Return:</strong> TODO</section>

				<section class="since"><strong>Since:</strong> WordPress TODO</section>

				<section class="meta">Used by TODO | Uses TODO | TODO Examples</section>

			</article>
		<?php endwhile; ?>

		<?php else : ?>

			<h1><?php _e( 'Not Found', 'wporg' ); ?></h1>

		<?php endif; ?>

		TODO pagination

	</div>
	<!-- /wrapper -->
</div><!-- /pagebody -->

<?php get_footer(); ?>
