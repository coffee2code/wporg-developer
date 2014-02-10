<?php namespace DevHub; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1><a href="<?php the_permalink() ?>"><?php echo get_signature(); ?></a></h1>

	<section class="description">
		<?php the_excerpt(); ?>
	</section>
	<section class="long-description">
		<?php the_content(); ?>
	</section>
	<section class="return"><p><strong>Return:</strong> <?php echo get_return(); ?></p></section>

	<?php
	$since = get_since();
	if ( ! empty( $since ) ) :
		?>
		<section class="since">
			<p><strong>Since:</strong> WordPress <a href="<?php echo get_since_link( $since ); ?>"><?php echo $since; ?></a></p>
		</section>
	<?php endif; ?>
	<?php if ( is_archive() ) : ?>
	<section class="meta">Used by TODO | Uses TODO | TODO Examples</section>
	<?php endif; ?>
	<?php if ( is_single() ) : ?>
	<hr/>
	<section class="explanation">
		<h2><?php _e( 'Explanation', 'wporg-developer' ); ?></h2>
	</section>
	<hr/>
	<section class="arguments">
		<h2><?php _e( 'Arguments', 'wporg-developer' ); ?></h2>
	</section>
	<hr/>
	<section class="learn-more">
		<h2><?php _e( 'Learn More', 'wporg-developer' ); ?></h2>
	</section>
	<hr/>
	<section class="examples">
		<h2><?php _e( 'Examples', 'wporg-developer' ); ?></h2>
	</section>
	<?php endif; ?>

</article>
