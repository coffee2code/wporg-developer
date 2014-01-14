<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package wporg-developer
 */
?>

	</div><!-- #content -->

</div><!-- #page -->

<?php wp_footer(); ?>
<?php
#require WPORGPATH . 'footer.php';
get_template_part( 'org', 'footer' );

?>