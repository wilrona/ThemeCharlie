<nav class="uk-padding-small uk-padding-remove-vertical uk-background-secondary uk-header-nav" uk-navbar>
    <div class="uk-navbar-center">
        <div class="uk-navbar-center-left uk-height-1-1 uk-flex uk-flex-middle uk-visible@l uk-width-1-1 uk-flex-left">
            <?php
            $defaults = array(
                'container'       => '',
                'container_class' => '',
                'menu_class' => 'uk-navbar-nav',
                'theme_location' => 'header-left',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'menu' => ''
            );
            wp_nav_menu($defaults);
            ?>
        </div>
        <a class="uk-navbar-item uk-logo" href="<?= home_url() ?>">
            <img src="<?= wp_get_attachment_image_src(tr_options_field('options.logo'), 'full')[0]; ?>" alt="">
        </a>

        <div class="uk-navbar-center-right uk-height-1-1 uk-flex uk-flex-middle uk-visible@l uk-width-1-1 uk-flex-right">
            <?php
            $defaults = array(
                'container'       => '',
                'container_class' => '',
                'menu_class' => 'uk-navbar-nav',
                'theme_location' => 'header-right',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'menu' => ''
            );
            wp_nav_menu($defaults);
            ?>
        </div>
    </div>
</nav>
<?php get_template_part('partials/menuMobile'); ?>