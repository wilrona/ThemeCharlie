<?php get_header() ?>

<div class="uk-section uk-section-small uk-background-muted">
    <div class="uk-container uk-container-small">
        <h1 class="uk-text-center uk-margin-remove">Devenir escort chez charlie</h1>
        <h4 class="uk-text-center uk-margin-remove uk-text-bold">Etape 3/4</h4>
    </div>
</div>

<div class="uk-section typerocket-container">
    <div class="uk-container uk-container-small uk-flex uk-flex-center">
        <div class="uk-card uk-card-body uk-card-default uk-width-5-6@m uk-width-1-1 uk-border-rounded">
            <h3 class="uk-text-danger-c uk-text-center uk-text-bold uk-margin-medium-bottom ">Vos services proposés</h3>

            <?php

            flash('error-data-inscription');

            $form = tr_form('inscrit', 'inscrireTree');
            $form->useUrl('post', '/inscrire/tree');

            echo $form->open();

            $form->setRenderSetting('raw');
            $form->useOld();

            ?>

            <div class="uk-form-stacked">

                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_disponibilite">Disponible pour (<span class="uk-text-danger uk-text-small">*</span>)</label>
                    <div class="uk-form-controls">
                        <?php

                        $values = [
                            'Choix du deplacement' => '',
                            'Me déplacer' => 'out',
                            'Recevoir' => 'in',
                            'Me déplacer - Recevoir' => 'both'
                        ];
                        ?>
                        <?= $form->select('disponibilite')->setOptions($values)->setAttribute('class', 'uk-select uk-border-rounded'); ?>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_quartier_search">Si vous recevez, désignez le quartier ou le lieu le plus proche de votre lieu de reception :</label>
                    <div class="uk-form-controls uk-margin-small-bottom">
                        <?= $form->text('quartier_search')->setAttributes(['class' =>'uk-input uk-border-rounded', 'placeholder'=> 'Recherche de lieu ou de quartier', 'id' => 'search_input']); ?>
                        <?= $form->hidden('quartier_recevoir')->setAttributes(['id' => 'result_input']); ?>
                    </div>
                    <div class="uk-form-controls">
                        <?= $form->text('quartier_result')->setAttributes(['class' =>'uk-input uk-disabled uk-border-rounded', 'id' => 'quartier_result']); ?>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_service_offert">J'offre mes services pour (<span class="uk-text-danger uk-text-small">*</span>)</label>
                    <div class="uk-form-controls">
                        <?php

                        $values = [
                            'Choix du genre' => '',
                            'Homme' => 'm',
                            'Femme' => 'f',
                            'Homme - Femme' => 'b'
                        ];
                        ?>
                        <?= $form->select('service_offert')->setOptions($values)->setAttribute('class', 'uk-select uk-border-rounded'); ?>
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_service_propose">Liste des services inclus dans le taux horaire proposé (<span class="uk-text-danger uk-text-small">*</span>)</label>
                    <div class="uk-form-controls">

                        <?php
                            $options = tr_options_field('options.insc_service') ? tr_options_field('options.insc_service') : [];
                            $value_option = [];
                            foreach ($options as $option):
                                if($option['active']):
                                    $value_option[$option['code'].' - '.$option['name']] = strtoupper($option['code']);
                                endif;
                            endforeach;
                        ?>
                        <?= $form->select('service_propose')->setOptions($value_option)->multiple()->setAttribute('class', 'uk-select selected'); ?>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold " for="tr_field_service_price">Définiser vos taux horaires(<span class="uk-text-danger uk-text-small">*</span>)</label>
                    <div class="uk-form-controls">

                        <span class="uk-text-warning uk-text-small-c uk-margin-bottom uk-display-block">(*) - c'est le nombre de coup autorisé que le client peut effectuer en votre compagnie</span>
                        <span class="uk-text-small uk-margin-bottom uk-display-block"><span class="uk-text-bold uk-text-danger">Recommandation :</span> Nous vous conseillons de remplir le maximum afin que les clients puissent avoir une idée de comment travailler avec vous avant de vous faire une reservation.</span>

                        <?php
                        $options = tr_options_field('options.insc_horaire') ? tr_options_field('options.insc_horaire') : [];

                        ?>
                        <div class="">
                            <table class="uk-table uk-table-small uk-table-divider uk-table-middle uk-table-responsive">
                                <thead>
                                    <tr>
                                        <th class="uk-width-small">Duree</th>
                                        <th class="uk-table-expand">Montant (FCFA)</th>
                                        <th class="uk-table-expand">shots (<span class="uk-text-danger-c">*</span>)</th>
                                        <th class="uk-table-shrink uk-text-nowrap">Affichez ?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $key = 1;
                                    foreach ($options as $option):
                                        if($option['active']):
                                            $actif = false;
                                ?>

                                        <tr>
                                            <td class="" data-label="Duree">
                                                <?= $option['name']; ?> <?php if($key === 1): echo '(<span class="uk-text-danger-c uk-text-small-c">Obligatoire</span>)'; $actif = true; endif; ?>
                                                <?= $form->hidden('name')->setGroup(''.$key.'')->setDefault($option['name']); ?>
                                            </td>
                                            <td data-label="Montant (FCFA)"><?= $form->text('amount')->setType('number')->setGroup(''.$key.'')->setAttributes(['class' => 'uk-input uk-border-rounded numeric', 'min' => 0, 'step' => 1])->setDefault(isset($_SESSION['inscription']) && isset($_SESSION['inscription']['tree']) ? $_SESSION['inscription']['tree'][$key]['amount'] : 0) ?></td>
                                            <td data-label="Shots"><?= $form->text('shot')->setType('number')->setGroup(''.$key.'')->setAttributes(['class' => 'uk-input uk-border-rounded numeric', 'min' => 1, 'step' => 1])->setDefault(isset($_SESSION['inscription']) && isset($_SESSION['inscription']['tree']) ? $_SESSION['inscription']['tree'][$key]['shot'] : 1) ?></td>
                                            <td data-label="Affichez ?"><?= $form->toggle('actif')->setGroup(''.$key.'')->setAttributes(['class' => 'uk-checkbox'])->setSetting('default', isset($_SESSION['inscription']) && isset($_SESSION['inscription']['tree']) ? boolval($_SESSION['inscription']['tree'][$key]['actif']) : $actif) ?></td>
                                        </tr>

                                <?php
                                        $key++;
                                        endif;
                                    endforeach;
                                ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-controls uk-text-right@m uk-text-center">
                        <button class="uk-button uk-button-primary" type="submit" id="submit">Continuer</button>
                    </div>
                </div>


            </div>

            <?php
            echo $form->close();
            ?>

        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyC_EN0njvHqGMTe7f4OggDagKuBPODPyQE"></script>
    <script>
        var searchInput = 'search_input';

        jQuery(document).ready(function ($) {
            var autocomplete;
            autocomplete = new google.maps.places.Autocomplete(document.getElementById(searchInput), {
                componentRestrictions: {
                    country: "cm"
                }
            });


            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var near_place = autocomplete.getPlace();

                document.getElementById('result_input').value = near_place.name;
                document.getElementById('quartier_result').value = near_place.name;
            });
        });

        jQuery(document).on('change', '#'+searchInput, function ($) {
            document.getElementById('quartier_result').value = '';
            document.getElementById('result_input').value = '';
        });
    </script>
<?php get_footer(); ?>