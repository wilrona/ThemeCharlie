<?php /* Template Name: Page Dashboard photo */ ?>

<?php

$current_user = _wp_get_current_user();

// Si l'utilisateur n'a pas de photo, le rediriger vers la page de gestion des photos.

$what_query = tr_query()->table('wp_whatsapp')->where('iduser', '=', $current_user->ID)->first();
$ID = $what_query['idpostuser'];

?>

<?php get_header() ?>

<?php while (have_posts()) : the_post(); ?>

    <div class="uk-section uk-section-small uk-background-muted">
        <div class="uk-container uk-container-small">
            <h1 class="uk-text-center "><?= get_the_title() ?></h1>
            <h4 class="uk-text-center uk-margin-remove uk-text-bold">Mes photos</h4>
        </div>
    </div>

    <div class="uk-section typerocket-container">
        <div class="uk-container uk-container-small">
            <?php
                if(!tr_posts_field('photos', $ID)):
            ?>
            <div class="uk-alert uk-alert-warning uk-text-small">
                Vous devez soumettre des photos pour votre profil. Seul les profils avec des photos ne sont que visible sur notre plateforme. Ces photos seront soumis à validation.
            </div>
            <?php
                endif;
            ?>

            <div class="" uk-grid>
                <div class="uk-width-1-4@m">

                    <div class="uk-alert uk-alert-warning uk-text-small-c">
                        Pour être conforme :

                        <ul class="uk-list uk-list-bullet uk-margin-small-top">
                            <li>La photo doit être claire.</li>
                            <li>La photo ne doit pas afficher votre nudité.</li>
                            <li>La photo ne doit pas être pornographique.</li>
                            <li>La photo ne doit pas avoir de text, ni de détail.</li>
                        </ul>
                    </div>

                </div>
                <div class="uk-width-3-4@m">
                    <div class="uk-card uk-card-body uk-card-default uk-border-rounded uk-card-small">
                        <h3 class="uk-text-danger-c uk-text-center uk-text-bold uk-margin-top">Mes photos</h3>
                        <?php

                        flash('error-data-update');
                        flash('success-data-update');

                        $form = tr_form('inscrit', 'updateTree', $ID);
                        $form->useUrl('post', '/update/tree');

                        echo $form->open();

                        echo $form->hidden('post_id')->setAttribute('value', $ID);

                        $form->setRenderSetting('raw');
                        $form->useOld();

                        ?>

                        <div class="uk-form-stacked">

                            <div class="uk-margin">
                                <div class="uk-form-controls">
                                    <?= $form->repeater('photos')->setFields([
                                        $form->image('photo')->setSettings(['button' => 'Ajouter une image', 'clear' => 'Effacer'])
                                    ])->setSettings([
                                        'add_button' => 'Ajouter les photos',
                                        'controls' => [
                                            'contract' => 'Contracter',
                                            'flip' => 'Renverser',
                                            'limit' => 'Limite de photo atteint',
                                            'clear' => 'Tout effacer'
                                        ]
                                    ])->setLimit(6) ?>
                                </div>
                            </div>



                            <div class="uk-margin">
                                <div class="uk-form-controls uk-text-right@m uk-text-center">
                                    <button class="uk-button uk-button-primary uk-width-1-1" type="submit"
                                            id="submit">Valide les informations
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php
                        echo $form->close();
                        ?>
                    </div>
                </div>
            </div>


        </div>
    </div>


<?php endwhile; ?>

<?php get_footer(); ?>
