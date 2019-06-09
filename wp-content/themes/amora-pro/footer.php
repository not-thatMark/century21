<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package amora
 */
?>

	</div><!-- #content -->

	<?php amora_load_footer_sidebar(); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			
			<?php echo ( esc_html(get_theme_mod('amora_footer_text')) == '' ) ? ('&copy; '.date('Y').' '.get_bloginfo('name').__('. All Rights Reserved. ','amora')) : esc_html( get_theme_mod('amora_footer_text') ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->
<script><?php echo esc_html(get_theme_mod('amora_analytics')); ?></script>


<?php wp_footer(); ?>

</body>
</html>
