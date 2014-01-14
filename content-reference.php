<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>

	<section class="description">
		<?php the_excerpt(); ?>
	</section>

	<section class="long-description">
		<?php the_content(); ?>
	</section>

	<section class="meta">Used by TODO | Uses TODO | TODO Examples</section>

</article>