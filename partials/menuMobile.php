
<nav class="uk-padding-small uk-padding-remove-vertical uk-background-secondary uk-header-nav uk-hidden@l"
     uk-sticky uk-navbar>
    <div class="uk-navbar-left">
        <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#" uk-toggle="target: #offcanvas-usage"></a>
    </div>
    <div class="uk-navbar-center">
        <div class="uk-navbar-item">
            <a class="uk-button uk-button-primary uk-border-rounded" href="#modal-full" uk-toggle>Reserver une escorte</a>
        </div>
    </div>
    <div class="uk-navbar-right nav-overlay-mobile">
        <ul class="uk-navbar-nav">
            <li>
                <a href="#"><i class="fal fa-user"></i></a>
                <div class="uk-navbar-dropdown">
                    <?php
                    $defaults = array(
                        'container'       => '',
                        'container_class' => '',
                        'menu_class' => 'uk-nav uk-navbar-dropdown-nav',
                        'theme_location' => 'header-right',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'menu' => ''
                    );
                    wp_nav_menu($defaults);
                    ?>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="uk-position-relative">
    <div id="offcanvas-usage" uk-offcanvas="overlay: true">
        <div class="uk-offcanvas-bar uk-flex uk-flex-column">
            <a class="uk-navbar-item uk-logo" href="<?= home_url() ?>">
                <img src="<?= wp_get_attachment_image_src(tr_options_field('options.logo'), 'full')[0]; ?>" alt="">
            </a>
            <?php
            $defaults = array(
                'container'       => '',
                'container_class' => '',
                'menu_class' => 'uk-nav-primary uk-nav-default uk-nav-parent-icon uk-nav uk-margin-medium-top',
                'theme_location' => 'header-mobile',
                'items_wrap' => '<ul id="%1$s" class="%2$s" uk-nav>%3$s</ul>',
                'menu' => ''
            );
            wp_nav_menu($defaults);
            ?>
        </div>
    </div>
</div>