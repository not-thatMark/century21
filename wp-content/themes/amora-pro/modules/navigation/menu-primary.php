<div id="mobile-menu">
    <?php wp_nav_menu( array( 'theme_location' => 'mobile' ) ); ?>
</div>
<nav id="site-navigation" class="main-navigation title-font" role="navigation">
    <div class="container">
        <?php
        // Get the Appropriate Walker First.
        $walker = has_nav_menu('primary') ? new Amora_Menu_With_Icon : '';
        //Display the Menu.
        wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
    </div>
</nav><!-- #site-navigation -->