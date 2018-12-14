<?php
/*
Template Name: Full Width
*/

/**
 * Copied from the template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package undercore
 */

get_header();
?>

	<div id="primary" class="<?php undercore_content_wrapper_classes('primary'); ?>">
		<main id="main" class="<?php undercore_content_wrapper_classes('main'); ?>">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
