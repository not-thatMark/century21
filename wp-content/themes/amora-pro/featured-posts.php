<?php
if ( (get_theme_mod('amora_featposts_enable') && is_home()) || get_post_meta(get_the_id())): ?>

<div class="featposts container-fluid container">
    <?php if(get_theme_mod('amora_featposts_title'))?>
    <div class="section-title">
        <span><?php
        echo esc_html(get_theme_mod('amora_featposts_title'))?>
            </span>
        <?php ?></div>
    <div class="featposts-wrapper">

    <div class="col-md-1"></div>
        <?php if ( have_posts() ) : ?>

            <?php /* Start the Loop */  ?>
            <?php
            $args = array( 'posts_per_page' =>  5, 'category' => esc_html(get_theme_mod('amora_featposts_cat')) );
            $lastposts = get_posts( $args );
            foreach ( $lastposts as $post ) :
                setup_postdata( $post ); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('item col-md-2 col-sm-2'); ?>>
                    <div class="item-container">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('amora-thumb',array(  'alt' => get_the_title(),'title' => get_the_title() )); ?></a>
                        <?php else : ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder.png"; ?>" alt="<?php the_title()?>"></a>

                        <?php endif; ?>

                    </div>

                    <div class="post-title-parent">
                        <a class="post-title" href="<?php the_permalink() ?>"><?php echo the_title(); ?></a>
                    </div>

                </article><!-- #post-## -->

            <?php endforeach;?>
            <div class="col-md-1"></div>
    </div>

<?php	wp_reset_postdata(); ?>

        <?php endif; ?>

    </div>

<?php endif;?>