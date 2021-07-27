<?php get_header() ?>

<div class="uk-section uk-section-small uk-background-muted">
    <div class="uk-container uk-container-small">
        <h1 class="uk-text-center uk-margin-remove">Devenir membre chez charlie</h1>
        <h4 class="uk-text-center uk-margin-remove uk-text-bold">Suite</h4>
    </div>
</div>

<div class="uk-section typerocket-container">
    <div class="uk-container uk-container-small uk-flex uk-flex-center">
        <div class="uk-card uk-card-body uk-card-default uk-width-5-6@m uk-width-1-1 uk-border-rounded">
            <h3 class="uk-text-danger-c uk-text-center uk-text-bold uk-margin-medium-bottom ">Vos informations de contact</h3>

            <?php

            flash('error-data-inscription-membre');

            $form = tr_form('inscrit', 'inscrireMembreTwo');
            $form->useUrl('post', '/membre/inscrire/two');

            echo $form->open();

            $form->setRenderSetting('raw');
            $form->useOld();

            ?>

            <div class="uk-form-stacked">

                <?php

                    $showActivation = true;

                    if(isset($_SESSION['inscriptionMembre']['two']['codeparrainnee'])):
                        $showActivation = false;
                    endif;

                    if(isset($_SESSION['inscriptionMembre']['two']['existCode'])):
                        $showActivation = false;
                    endif;

                    if($showActivation):

                ?>

                <div class="uk-margin">
                    <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-card-small">
                        <h3 class="uk-text-center">Synchronisez votre numéro WHATSAPP</h3>
                        <div class="uk-text-small">
                            <span class="uk-text-center uk-margin-bottom uk-display-block">Ce numéro whatsapp que vous allez synchroniser sera utilisé pour:</span>
                            <div class="uk-flex uk-flex-center">
                                <ul class="uk-list uk-list-bullet">
                                    <li>Recevoir les notifications des reservations validées par vos escorts</li>
                                    <li>Facilier la mise en relation direct avec vos escorts</li>
                                </ul>
                            </div>
                            
                            <div class="uk-flex uk-flex-center uk-margin-top uk-margin-bottom">
                                <div class="uk-padding-small uk-background-muted uk-width-1-2@l uk-h3 uk-text-center">
                                    Envoie ce code  <span class="uk-text-danger-c"><?= $_SESSION['inscriptionMembre']['two']['codeconfirmation'] ?></span>

                                    <a href="<?= home_url('/inscription-membre/two/') ?>?generate=1" class="uk-margin-top uk-display-block uk-text-small-c uk-link-muted">Génére un nouveau code</a>
                                </div>

                            </div>
                            
                            <span class="uk-text-center uk-display-block uk-h4 uk-margin-remove">Par whatsapp au numéro <br> <strong><?= tr_options_field('options.online') ?></strong></span>
                            <span class="uk-text-center uk-margin-bottom uk-display-block uk-text-small-c uk-text-danger-c">Faite cette action avant de terminer votre inscription</span>
                            
                        </div>
                    </div>
                </div>

                <?php
                    endif;
                ?>

                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_disponibilite">Numéro de téléphone valide pour vous contacter en cas de problème (<span class="uk-text-danger uk-text-small">*</span>)</label>
                    <div class="uk-form-controls">
                        <?= $form->hidden('codeconfirmation')->setDefault($_SESSION['inscriptionMembre']['two']['codeconfirmation']); ?>
                        <?= $form->text('phone')->setAttribute('class', 'uk-input uk-border-rounded'); ?>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-form-controls uk-text-right@m uk-text-center">
                        <button class="uk-button uk-button-primary" type="submit" id="submit">Terminez votre inscription</button>
                    </div>
                </div>


            </div>

            <?php
            echo $form->close();
            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>