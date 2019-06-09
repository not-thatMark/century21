<?php
/*
Template Name: Search Page
 */

get_header(); ?>

	<div id="primary-mono" class="content-area <?php do_action('amora_primary-width') ?> page">
		<main id="main" class="site-main" role="main">

	    <?php get_search_form(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
