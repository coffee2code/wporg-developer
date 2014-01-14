<?php
/**
 * The template for displaying search forms in wporg-developer
 *
 * @package wporg-developer
 */
?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'wporg-developer' ); ?></span>
		<input type="text" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'wporg-developer' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<input type="submit" class="shiny-blue search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'wporg-developer' ); ?>">
</form>
