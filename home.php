<?php /* Template Name: Page accueil */ ?>

<?php get_header() ?>

<?php while (have_posts()) : the_post(); ?>

    <div class="uk-section uk-position-relative uk-section-large">


        <div class="uk-container uk-padding-large uk-padding-remove-vertical">
            <div class="uk-width-1-1 uk-text-center uk-margin-large-bottom uk-margin-cm">
                <h2 class="uk-text-bold uk-text-uppercase uk-margin-remove">Comment ça marche ?</h2>
                <h3 class="uk-text-muted uk-margin-remove">Cela n'a jamais été aussi facile</h3>
                <hr class="uk-divider-small uk-divider-c uk-margin-small-top">
            </div>
            <div class="uk-child-width-1-1 uk-child-width-1-3@l uk-grid-match" uk-grid>
                <div class="uk-flex uk-flex-middle">

                    <div>
                        <?php
                            foreach (tr_posts_field('list_how_gauche') as $gauche):
                        ?>
                            <div uk-grid class="uk-background-default uk-padding-small uk-border-rounded uk-grid-collapse uk-margin uk-card uk-card-default">
                                <div class="uk-width-1-6 uk-text-lead uk-text-bold">
                                    <?= $gauche['number']; ?>
                                </div>
                                <div class="uk-width-expand">
                                    <h4 class="uk-margin-remove uk-text-bold"><?= $gauche['title']; ?></h4>
                                    <div class="uk-margin-small-top">
                                        <?= $gauche['desc']; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>

                </div>
                <div class="uk-visible@l">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/iphone-1.png" alt="">
                </div>
                <div class="uk-flex-middle uk-flex">

                    <div>
                        <?php
                        foreach (tr_posts_field('list_how_droite') as $gauche):
                            ?>
                            <div uk-grid class="uk-background-default uk-padding-small uk-border-rounded uk-grid-collapse uk-margin uk-card uk-card-default">
                                <div class="uk-width-1-6 uk-text-lead uk-text-bold">
                                    <?= $gauche['number']; ?>
                                </div>
                                <div class="uk-width-expand">
                                    <h4 class="uk-margin-remove uk-text-bold"><?= $gauche['title']; ?></h4>
                                    <div class="uk-margin-small-top">
                                        <?= $gauche['desc']; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </div>


        <div id="extended_5de03709d37a7" class="morph-svg"
             style="top:2%;left:5%;width:90%;height:90%;transform: rotate(0deg);">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="fill:#fdfdfd; " x="0px" y="0px"
                 viewBox="0 0 180 180">
                <path d="M 161.5 95.7 c -0.49848 -1.22928 -1.06464 -2.66312 -1.9 -4.3 c -4.1 -8.1 -4.7 -17.5 -2.1 -26.6 c 3.8 -13.2 1.3 -20.5 0.1 -25.1 c -3.2 -12.6 -12.8 -20.4 -15.4 -22.4 C 126.5 5 105.2 5.7 90.9 11.8 c -0.2 0.1 -0.1 0 -0.5 0.2 c -12.2 5.3 -25 9.3 -38 11.1 c -6.40001 0.9 -12.8 2.9 -18.9 6.3 C 11.6182 41.3586 -0.470719 69.8536 8.9 90.6 c 7.82735 16.6334 29.7995 20.6191 41.6569 29.9471 c 7.71601 2.84144 13.7012 8.42472 16.5431 15.5529 c 0.1 0.3 0.3 0.6 0.4 0.9 c 11.803 24.2707 42.1924 33.749 67.551 21.4703 C 161.37 146.064 168.986 114.414 161.5 95.7 Z">
                    <animate repeatCount="indefinite" attributeName="d" dur="10s" values="
                        M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
                        c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
                        c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
                        c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z;

                        M163.7,95.5c0.2-2,0.3-4,0.3-4c0.5-7.2,1.2-15.6,0.3-24.7c-1.1-12-4.4-21.6-6.6-27.1c-2.4-5.8-4-9.7-7.1-13.8
                        C138.2,9.3,113.4,3.8,95.3,8.2c-2.5,0.6-1.8,0.6-6.7,2c-16.3,4.5-23.5,3.9-32.3,6.3c0,0-12.6,3.5-23,12.9
                        c-17.4,16-26.2,47.3-14.7,63.4c8.4,11.8,20.7,5.7,29,19.7c3.5,5.9,5.8,14.5,15.3,24.7c0,0,1.4,1.5,3,3c9.4,8.8,52.1,35.9,76.3,19.3 C158.7,148.2,161.3,120.5,163.7,95.5z;

                        M161.5,95.7c-0.3-0.7-0.8-2.2-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
                        c-3.2-12.6-12.8-20.4-15.4-22.4c-15.7-12.3-37-11.6-51.3-5.5c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
                        C46,24,39.6,26,33.5,29.4C14,40.3-1,72.5,8.9,90.6c11.4,21,51.5,14.4,57.8,36.1c1.1,3.9,0.8,7.3,0.4,9.4c0.1,0.3,0.3,0.6,0.4,0.9
                        c12.2,24.8,41.2,35.8,65.5,26.3C166.2,150.1,167.2,107.6,161.5,95.7z;

                        M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
                        c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
                        c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
                        c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z">
                    </animate>
                </path>
            </svg>
        </div>
        <div id="extended_5de03709d37be" class="morph-svg"
             style="top:16%; left:18%; width:62%; height:62%; transform: rotate(0deg); ">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="fill:#eef0f5a8; " x="0px" y="0px"
                 viewBox="0 0 180 180">
                <path d="M 161.5 95.7 c -0.583243 -1.45532 -1.17766 -2.8609 -1.9 -4.3 c -4.1 -8.1 -4.7 -17.5 -2.1 -26.6 c 3.8 -13.2 1.3 -20.5 0.1 -25.1 c -3.2 -12.6 -12.8 -20.4 -15.4 -22.4 C 126.5 5 105.2 5.7 90.9 11.8 c -0.2 0.1 -0.1 0 -0.5 0.2 c -12.2 5.3 -25 9.3 -38 11.1 c -6.4 0.9 -12.8 2.9 -18.9 6.3 C 10.6011 41.8106 -0.244684 68.7234 8.9 90.6 c 6.30162 14.7686 20.5321 23.275 34.7629 27.3195 c 10.5414 2.38937 19.2108 8.90505 23.4371 18.1805 c 0.1 0.3 0.3 0.6 0.4 0.9 c 11.6335 24.0447 42.6162 32.8732 68.4268 19.4077 C 159.308 144.341 169.749 117.325 161.5 95.7 Z">
                    <animate repeatCount="indefinite" attributeName="d" dur="10s" values="
					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z;

					M163.7,95.5c0.2-2,0.3-4,0.3-4c0.5-7.2,1.2-15.6,0.3-24.7c-1.1-12-4.4-21.6-6.6-27.1c-2.4-5.8-4-9.7-7.1-13.8
					C138.2,9.3,113.4,3.8,95.3,8.2c-2.5,0.6-1.8,0.6-6.7,2c-16.3,4.5-23.5,3.9-32.3,6.3c0,0-12.6,3.5-23,12.9
					c-17.4,16-26.2,47.3-14.7,63.4c8.4,11.8,20.7,5.7,29,19.7c3.5,5.9,5.8,14.5,15.3,24.7c0,0,1.4,1.5,3,3c9.4,8.8,52.1,35.9,76.3,19.3 C158.7,148.2,161.3,120.5,163.7,95.5z;

					M161.5,95.7c-0.3-0.7-0.8-2.2-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4c-15.7-12.3-37-11.6-51.3-5.5c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					C46,24,39.6,26,33.5,29.4C14,40.3-1,72.5,8.9,90.6c11.4,21,51.5,14.4,57.8,36.1c1.1,3.9,0.8,7.3,0.4,9.4c0.1,0.3,0.3,0.6,0.4,0.9
					c12.2,24.8,41.2,35.8,65.5,26.3C166.2,150.1,167.2,107.6,161.5,95.7z;

					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z"></animate>
                </path>
            </svg>
        </div>
        <div id="extended_5de03709d37d5" class="morph-svg"
             style="top:27%; left:27%; width:45%; height:45%; transform: rotate(0deg); ">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="fill:#1f1f1f; " x="0px" y="0px"
                 viewBox="0 0 180 180">
                <path d="M 161.88 95.6655 c -0.461973 -1.58627 -0.941199 -3.08979 -1.52042 -4.24824 c -3.30634 -7.94472 -3.68205 -17.1722 -1.68592 -26.2722 c 2.95458 -12.993 0.316555 -20.6898 -1.05598 -25.4451 c -3.06197 -11.4268 -11.2817 -18.5539 -13.968 -20.9162 C 128.519 5.7419 106.615 5.37218 91.6591 11.1789 c -0.596829 0.186267 -0.393308 0.103521 -1.56971 0.510562 c -12.9074 5.16197 -24.7412 8.36832 -37.0166 10.2718 c -5.29578 0.744719 -12.7655 3.00352 -19.6074 7.43873 C 11.3489 42.5039 1.0595 69.9148 10.5736 90.9796 c 6.41408 13.9514 19.0451 20.6771 32.6409 25.575 c 9.78874 2.92112 17.7983 9.94894 23.1609 19.7352 c 0.0827466 0.24824 0.489788 0.755281 0.848589 1.26232 c 11.2204 21.3775 44.3218 33.2521 69.9285 19.0518 C 158.865 144.725 168.416 118.349 161.88 95.6655 Z">
                    <animate repeatCount="indefinite" attributeName="d" dur="10s" values="
					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z;

					M163.7,95.5c0.2-2,0.3-4,0.3-4c0.5-7.2,1.2-15.6,0.3-24.7c-1.1-12-4.4-21.6-6.6-27.1c-2.4-5.8-4-9.7-7.1-13.8
					C138.2,9.3,113.4,3.8,95.3,8.2c-2.5,0.6-1.8,0.6-6.7,2c-16.3,4.5-23.5,3.9-32.3,6.3c0,0-12.6,3.5-23,12.9
					c-17.4,16-26.2,47.3-14.7,63.4c8.4,11.8,20.7,5.7,29,19.7c3.5,5.9,5.8,14.5,15.3,24.7c0,0,1.4,1.5,3,3c9.4,8.8,52.1,35.9,76.3,19.3 C158.7,148.2,161.3,120.5,163.7,95.5z;

					M161.5,95.7c-0.3-0.7-0.8-2.2-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4c-15.7-12.3-37-11.6-51.3-5.5c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					C46,24,39.6,26,33.5,29.4C14,40.3-1,72.5,8.9,90.6c11.4,21,51.5,14.4,57.8,36.1c1.1,3.9,0.8,7.3,0.4,9.4c0.1,0.3,0.3,0.6,0.4,0.9
					c12.2,24.8,41.2,35.8,65.5,26.3C166.2,150.1,167.2,107.6,161.5,95.7z;

					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z"></animate>
                </path>
            </svg>
        </div>
    </div>

    <div class="uk-section uk-background-secondary">
        <div class="uk-container uk-container-small">
            <div class="uk-child-width-1-1 uk-child-width-1-2@m" uk-grid>
                <div class="uk-text-center uk-text-left@m">

                    <span class="uk-text-lead uk-text-danger-c uk-text-uppercase">Pas encore membre ?</span>
                    <span class="uk-text-uppercase uk-h1 uk-text-white">Inscription Gratuite</span>

                    <div class="uk-margin-top">
                        <a class="uk-button uk-button-primary uk-border-rounded" href="<?= get_the_permalink(tr_options_field('options.page_inscription_membre')) ?>">INSCRIVEZ-VOUS GRATUITEMENT</a>
                    </div>

                </div>
                <div class="uk-text-white uk-text-center uk-text-left@m">
                    <hr class="uk-divider-icon uk-hidden@m">
                    <span class="uk-text-lead uk-text-white">Inscrivez-vous et profitez des avantages</span> :


                    <ul class="uk-text-left">
                        <li>Reservez vos escorts préferées</li>
                        <li>Ajoutez des commentaires</li>
                        <li>Envoyez des méssages privés </li>
                        <li>Tchatez avec les escorts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(tr_posts_field('show_listing')):
    ?>

    <div class="uk-section uk-section-large uk-padding-remove-bottom">
        <div class="uk-container uk-padding-large uk-padding-remove-vertical uk-position-relative">

            <h2 class="uk-text-bold uk-text-uppercase uk-margin-remove uk-text-center">Actuellement disponible chez nous</h2>
            <hr class="uk-divider-small uk-divider-c uk-margin-small-top uk-text-center">

            <div uk-slider class="uk-margin-large-top uk-margin-large-bottom">

                <div class="uk-position-relative">

                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-grid uk-grid-small uk-margin">
                            <li>
                                <div class="uk-inline-clip escort-item uk-width-1-1">
                                    <figure class="ribbon uk-margin-remove">Nouveau</figure>
                                    <figure class="stamp stamp-complex is-vip uk-margin-remove">
                                        <span>VIP</span>
                                    </figure>

                                    <img src="<?= get_stylesheet_directory_uri() ?>/img/slider3.jpg" alt="">

                                    <div class="uk-overlay-primary-c uk-position-bottom">
                                        <div class="uk-padding-small">
                                            <span class="uk-display-block uk-margin-remove uk-text-truncate">NomEscorte <span class="uk-text-small-c uk-text-success">(En ligne)</span></span>
                                            <span class="uk-text-small-c uk-text-success">(21 ans <i class="fal fa-check"></i>)</span> - <span class="uk-text-small-c">159 cm</span> - <span class="uk-text-small-c">Slim</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="uk-inline-clip escort-item uk-width-1-1">
                                    <figure class="ribbon uk-margin-remove">Nouveau</figure>
                                    <figure class="stamp stamp-complex is-vip uk-margin-remove">
                                        <span>VIP</span>
                                    </figure>

                                    <img src="<?= get_stylesheet_directory_uri() ?>/img/slider2.jpg" alt="">

                                    <div class="uk-overlay-primary-c uk-position-bottom">
                                        <div class="uk-padding-small">
                                            <span class="uk-display-block uk-margin-remove uk-text-truncate">NomEscorte</span>
                                            <span class="uk-text-small-c">21 ans</span> - <span class="uk-text-small-c">159 cm</span> - <span class="uk-text-small-c">Slim</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>

                                <div class="uk-inline-clip escort-item uk-width-1-1">
                                    <figure class="ribbon">Vérifié</figure>
                                    <figure class="stamp stamp-complex is-vip uk-margin-remove">
                                        <span>VIP</span>
                                    </figure>

                                    <img src="<?= get_stylesheet_directory_uri() ?>/img/slider3.jpg" alt="">

                                    <div class="uk-overlay-primary-c uk-position-bottom">
                                        <div class="uk-padding-small">
                                            <span class="uk-display-block uk-margin-remove uk-text-truncate">NomEscorte</span>
                                            <span class="uk-text-small-c uk-text-success">(21 ans <i class="fal fa-check"></i>)</span> - <span class="uk-text-small-c">159 cm</span> - <span class="uk-text-small-c">Slim</span>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li>

                                <div class="uk-inline-clip uk-transition-toggle escort-item uk-width-1-1 uk-card uk-card-default">
                                    <figure class="ribbon">Vérifié</figure>
                                    <figure class="stamp stamp-complex is-vip uk-margin-remove">
                                        <span>VIP</span>
                                    </figure>

                                    <img src="<?= get_stylesheet_directory_uri() ?>/img/slider4.jpg" alt="">
                                    <div class="uk-overlay-primary-c uk-position-bottom">
                                        <div class="uk-padding-small">
                                            <span class="uk-display-block uk-margin-remove uk-text-truncate">NomEscorte</span>
                                            <span class="uk-text-small-c">21 ans</span> - <span class="uk-text-small-c">159 cm</span> - <span class="uk-text-small-c">Slim</span>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>

                    <div class="uk-hidden@s uk-light">
                        <a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous
                           uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next
                           uk-slider-item="next"></a>
                    </div>

                    <div class="uk-visible@s">
                        <a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous
                           uk-slider-item="previous"></a>
                        <a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next
                           uk-slider-item="next"></a>
                    </div>

                </div>

            </div>

            <div class="uk-width-1-1 uk-text-center">
                <a class="uk-button uk-button-primary uk-button-large uk-border-rounded" href="#modal-full-3" uk-toggle>Reserver une escorte</a>
            </div>
            <div id="extended_5de03601caace" class="morph-svg"
                 style="top:5%; left:-35%; width:100%; height:100%; transform: rotate(160deg); ">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" style="fill:#eef0f5a8; " x="0px" y="0px"
                     viewBox="0 0 180 180">
                    <path d="M 161.836 95.6694 c -0.223536 -0.898805 -0.63178 -2.47527 -1.56356 -4.25412 c -3.39654 -7.96237 -3.79773 -17.2094 -1.73298 -26.3094 c 3.05066 -13.0165 0.428316 -20.6682 -0.924611 -25.4059 c -3.07766 -11.5601 -11.4542 -18.7637 -14.1307 -21.0848 c -15.1953 -12.9576 -37.0306 -13.2057 -51.9117 -7.36571 c -0.551732 0.176464 -0.359976 0.0917562 -1.44815 0.475269 c -12.827 5.17766 -24.7706 8.47419 -37.1283 10.366 C 47.5751 22.853 40.227 25.0824 33.4694 29.4 C 14.2906 41.0799 0.238708 73.1423 10.3834 90.9364 c 10.9412 19.5931 46.7898 13.0695 53.3957 33.592 c 1.46702 4.20585 1.56464 8.40107 2.67861 11.7398 c 0.0847073 0.254122 0.46822 0.737634 0.79761 1.22115 c 11.7718 22.3532 42.8669 35.8153 67.1516 25.2295 C 165.053 149.809 166.298 109.573 161.836 95.6694 Z">
                        <animate repeatCount="indefinite" attributeName="d" dur="10s" values="
					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z;

					M163.7,95.5c0.2-2,0.3-4,0.3-4c0.5-7.2,1.2-15.6,0.3-24.7c-1.1-12-4.4-21.6-6.6-27.1c-2.4-5.8-4-9.7-7.1-13.8
					C138.2,9.3,113.4,3.8,95.3,8.2c-2.5,0.6-1.8,0.6-6.7,2c-16.3,4.5-23.5,3.9-32.3,6.3c0,0-12.6,3.5-23,12.9
					c-17.4,16-26.2,47.3-14.7,63.4c8.4,11.8,20.7,5.7,29,19.7c3.5,5.9,5.8,14.5,15.3,24.7c0,0,1.4,1.5,3,3c9.4,8.8,52.1,35.9,76.3,19.3 C158.7,148.2,161.3,120.5,163.7,95.5z;

					M161.5,95.7c-0.3-0.7-0.8-2.2-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4c-15.7-12.3-37-11.6-51.3-5.5c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					C46,24,39.6,26,33.5,29.4C14,40.3-1,72.5,8.9,90.6c11.4,21,51.5,14.4,57.8,36.1c1.1,3.9,0.8,7.3,0.4,9.4c0.1,0.3,0.3,0.6,0.4,0.9
					c12.2,24.8,41.2,35.8,65.5,26.3C166.2,150.1,167.2,107.6,161.5,95.7z;

					M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1
					c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1
					c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7
					c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z"></animate>
                    </path>
                </svg>
            </div>

        </div>
    </div>

    <?php
        endif;
    ?>

    <div class="uk-section">
        <div class="uk-container uk-container-small uk-padding-large uk-padding-remove-vertical">
            <?php
                the_content()
            ?>
        </div>
    </div>


<?php endwhile; ?>
<?php get_footer(); ?>