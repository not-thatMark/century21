<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package amora
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

$sidebar_style = get_theme_mod('amora_sidebar_style', 'default');
if ( amora_load_sidebar() ) : ?>
<div id="secondary" class="widget-area <?php do_action('amora_secondary-width') . printf(' ' . $sidebar_style); ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
