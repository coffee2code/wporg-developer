<?php namespace DevHub; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1><a href="<?php the_permalink() ?>"><?php echo get_signature(); ?></a></h1>

	<section class="description">
		<?php the_excerpt(); ?>
	</section>

	<section class="long-description">
		<?php the_content(); ?>
	</section>

	<section class="return"><strong>Return:</strong> <?php echo get_return(); ?></section>

	<?php
	$since = get_since();
	if ( ! empty( $since ) ) :
		?>
		<section class="since">
			<strong>Since:</strong> WordPress
			<a href="<?php echo get_since_link( $since ); ?>"><?php echo $since; ?></a>
		</section>
	<?php endif; ?>

	<section class="meta">Used by TODO | Uses TODO | TODO Examples</section>

</article>
