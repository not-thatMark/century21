<!--<!--front page builder start-->-->
<?php //if ( get_theme_mod('amora_hero_enable') && is_home() ) : ?>
<!--    <div id="hero" class="hero-content">-->
<!--        <div class="layer"></div>-->
<!--        <div class="container hero-container">-->
<!---->
<!--            --><?php //$class = wp_get_attachment_url( get_post_thumbnail_id(get_theme_mod('amora_hero1_selectpage')) ) ? 'col-md-8 col-sm-8' : 'col-md-12 centered'?>
<!---->
<!---->
<!--            <div class ="--><?php //echo $class;?><!-- h-content">-->
<!--                <h1 class="title">-->
<!--                    --><?php //echo get_the_title(get_theme_mod('amora_hero1_selectpage')); ?>
<!--                </h1>-->
<!--                --><?php //if(get_theme_mod('amora_hero1_full_content', true)) : ?>
<!--                    <div class="excerpt">-->
<!--                        --><?php //$my_postid = get_theme_mod('amora_hero1_selectpage');
//                        $content_post = get_post($my_postid);
//                        $content = $content_post->post_content;
//                        $content = apply_filters('the_content', $content);
//                        echo $content; ?>
<!--                    </div>-->
<!--                --><?php //else : ?>
<!--                    <div class="excerpt">-->
<!--                        --><?php //$my_postid = get_theme_mod('amora_hero1_selectpage');
//                        $content_post = get_post($my_postid);
//                        $content = $content_post->post_content;
//                        $content = apply_filters('the_content', $content);
//                        echo substr($content, 0, 200)."..."; ?>
<!--                    </div>-->
<!--                --><?php //endif; ?>
<!--                --><?php //if ( get_theme_mod('amora_hero1_button') != '') : ?>
<!--                    <a href="--><?php //the_permalink(get_theme_mod('amora_hero1_selectpage')); ?><!--" class="more-button">-->
<!--                        --><?php //echo get_theme_mod('amora_hero1_button'); ?>
<!--                    </a>-->
<!--                --><?php //endif; ?>
<!--            </div>-->
<!---->
<!--            --><?php //if(wp_get_attachment_url( get_post_thumbnail_id(get_theme_mod('amora_hero1_selectpage')) )):?>
<!--            <div class="f-image col-md-4 col-sm-4">-->
<!--                --><?php //$a =  wp_get_attachment_url( get_post_thumbnail_id(get_theme_mod('amora_hero1_selectpage')) ); ?>
<!--                <a href="--><?php //the_permalink(get_theme_mod('amora_hero1_selectpage')); ?><!--"><img src="--><?php //echo $a; ?><!--" alt="--><?php //the_title() ?><!--"></a>-->
<!--            </div>-->
<!--            --><?php //endif;?>
<!--        </div>-->
<!--    </div>-->
<?php //endif; ?>
<!--<!--front page builder end-->-->