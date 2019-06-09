<?php
/*
** Template to Render Social Icons on Top Bar
*/
$social_icon_styles = get_theme_mod('amora_social_icon_style','hvr-ripple-out');
for ($i = 1; $i < 8; $i++) :
	$social = esc_html(get_theme_mod('amora_social_'.$i));
	if ( ($social != 'none') && ($social != '') ) : ?>
	<a class="<?php echo $social_icon_styles?>" href="<?php echo esc_url( get_theme_mod('amora_social_url'.$i) ); ?>"><i class="fa fa-fw fa-<?php echo $social; ?>"></i></a>
	<?php endif;

endfor; ?>