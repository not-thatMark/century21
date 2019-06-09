<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package amora
 */

get_header(); ?>

	<div id="primary" class="content-area page404">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'amora' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'What you are looking for does not exist on this site. Try Searching For something else?', 'amora' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts', array('title' => __( 'Some Posts You may find interesting','amora' ), 'number' => 15)); ?>


				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
