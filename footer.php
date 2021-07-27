

<div class="uk-section uk-background-secondary uk-section-footer">
    <div class="uk-container uk-padding-large uk-padding-remove-vertical uk-container-small">

        <div class="uk-grid-match uk-child-width-1-2@m" uk-grid>
            <div class="uk-flex uk-flex-left">
                <div class="uk-width-1-2">
                    <img src="<?= wp_get_attachment_image_src(tr_options_field('options.footer_image'), 'full')[0]; ?>" class="">
                </div>
                <h5 class="uk-text-white uk-margin-remove"><?= bloginfo('description') ?></h5>
            </div>
            <div class="">
                <h4 class="uk-text-white">Qui sommes nous ?</h4>
                <?php
                $defaults = array(
                    'container'       => '',
                    'container_class' => '',
                    'menu_class' => 'uk-list uk-margin-remove',
                    'theme_location' => 'footer',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'menu' => ''
                );
                wp_nav_menu($defaults);
                ?>
            </div>
        </div>

    </div>
</div>
<div class="uk-footer">
    <div class="uk-container uk-padding-large uk-padding-remove-vertical">
        <p class="uk-text-small uk-padding-small uk-text-center">
            © 2019
            <a href="<?= home_url() ?>">Charliescorte</a>,
            <a href="<?= get_the_permalink(tr_options_field('options.page_condition')) ?>">Termes et conditions</a>. Pour vous inscrire sur le site vous devez avoir plus de 18 ans le jour
            de l’inscription.</p>
    </div>
</div>


<div id="modal-full" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-outside" type="button" uk-close></button>
        <h2 class="uk-modal-title uk-text-center uk-text-danger-c uk-margin-bottom">Reservation des escorts</h2>

        <div class="uk-margin-medium-bottom uk-text-center uk-text-lead">
            Bienvenu sur charliescort.tk <br>
            Les réservations d'escort seront disponibles très bientôt.
        </div>

        <div class="uk-grid-small uk-child-width-auto uk-margin uk-flex-center" uk-grid uk-countdown="date: 2020-01-30T00:00:00+00:00">
            <div>
                <div class="uk-countdown-number uk-countdown-days"></div>
            </div>
            <div class="uk-countdown-separator">:</div>
            <div>
                <div class="uk-countdown-number uk-countdown-hours"></div>
            </div>
            <div class="uk-countdown-separator">:</div>
            <div>
                <div class="uk-countdown-number uk-countdown-minutes"></div>
            </div>
            <div class="uk-countdown-separator">:</div>
            <div>
                <div class="uk-countdown-number uk-countdown-seconds"></div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>


</body>

</html>