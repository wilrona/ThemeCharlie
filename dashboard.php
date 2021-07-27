<?php /* Template Name: Page Tableau de board */ ?>

<?php

    $current_user = _wp_get_current_user();

    $what_query = tr_query()->table('wp_whatsapp')->where('iduser', '=', $current_user->ID)->first();
    $ID = $what_query['idpostuser'];

?>

<?php get_header() ?>

<?php while (have_posts()) : the_post(); ?>

<div class="uk-section uk-section-small uk-background-muted">
    <div class="uk-container uk-container-small">
        <h1 class="uk-text-center "><?= get_the_title() ?></h1>
        <h4 class="uk-text-center uk-margin-remove uk-text-bold">Bibliographie</h4>
    </div>
</div>

<div class="uk-section typerocket-container">
    <div class="uk-container uk-container-small">
        
        <div class="" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-card uk-card-body uk-card-default uk-border-rounded uk-card-small">
                    <h3 class="uk-text-danger-c uk-text-center uk-text-bold uk-margin-top">Bibliographie</h3>
                    <?php

                    flash('error-data-update');
                    flash('success-data-update');

                    $form = tr_form('inscrit', 'updateOne', $ID);
                    $form->useUrl('post', '/update/one');

                    echo $form->open();

                    $form->setRenderSetting('raw');
                    $form->useOld();

                    echo $form->hidden('post_id')->setAttribute('value', $ID);

                    ?>

                    <div class="uk-form-stacked">
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_pseudo">Votre pseudo</label>
                            <div class="uk-form-controls">
                                <?= $form->text('pseudo')->setAttributes(['class' => 'uk-input uk-border-rounded uk-disabled', 'value' => $current_user->user_login]) ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_name">Nom complet</label>
                            <div class="uk-form-controls">
                                <?= $form->text('name')->setAttributes(['class' => 'uk-input uk-border-rounded', 'value' => $current_user->display_name]) ?>
                                <span class="uk-text-small-c uk-text-warning">Cette information ne sera jamais public et aidera pour vous contacter</span>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_sexe">Sexe</label>
                            <div class="uk-form-controls">
                                <?php
                                $value = [
                                    'Choix du sexe' => '',
                                    'Femmes' => 'f',
                                    'Hommes' => 'm'
                                ]
                                ?>
                                <?= $form->select('sexe')->setOptions($value)->setAttribute('class', 'uk-select uk-border-rounded'); ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_datenais">Date de naissance</label>
                            <div class="uk-form-controls">
                                <?= $form->text('datenais')->setAttributes(['class' => 'uk-input uk-border-rounded uk-disabled']) ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_nationalite">Présentation</label>
                            <div class="uk-form-controls">
                                <?= $form->editor('post_content')->setAttributes(['class' => 'uk-textarea']); ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_nationalite">Nationalité (<span class="uk-text-danger uk-text-small">*</span>)</label>
                            <div class="uk-form-controls">
                                <?php $nationalite = nationalite(); ?>
                                <?php

                                $values = [
                                    'Choix de la nationalité' => ''
                                ];
                                foreach ($nationalite as $key => $value):

                                    $values[$value] = $key;

                                endforeach;
                                ?>
                                <?= $form->select('nationalite')->setOptions($values)->setAttribute('class', 'uk-select uk-border-rounded selected'); ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_ville">Ville de residence (<span class="uk-text-danger uk-text-small">*</span>)</label>
                            <div class="uk-form-controls">
                                <?php
                                $option_ville = tr_options_field('options.insc_ville') ? tr_options_field('options.insc_ville') : [];
                                $value_option = [
                                    'Choix de la ville' => ''
                                ];
                                foreach ($option_ville as $option):
                                    if($option['active']):
                                        $value_option[$option['name']] = strtoupper($option['code']);
                                    endif;
                                endforeach;
                                ?>
                                <?= $form->select('ville')->setOptions($value_option)->setAttribute('class', 'uk-select uk-border-rounded selected'); ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_taille">Taille (en cm) (<span class="uk-text-danger uk-text-small">*</span>)</label>
                            <div class="uk-form-controls">
                                <?= $form->text('taille')->setType('number')->setAttributes(['class' => 'uk-input uk-border-rounded', 'min' => 100]) ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_poids">Poids (en Kg) (<span class="uk-text-danger uk-text-small">*</span>)</label>
                            <div class="uk-form-controls">
                                <?= $form->text('poids')->setType('number')->setAttributes(['class' => 'uk-input uk-border-rounded']) ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_teint">Teint (<span class="uk-text-danger uk-text-small">*</span>)</label>
                            <div class="uk-form-controls">
                                <?php
                                $options = tr_options_field('options.insc_teint') ? tr_options_field('options.insc_teint') : [];
                                $value_option = [
                                    'Choix du teint' => ''
                                ];
                                foreach ($options as $option):
                                    if($option['active']):
                                        $value_option[$option['name']] = strtoupper($option['code']);
                                    endif;
                                endforeach;
                                ?>
                                <?= $form->select('teint')->setOptions($value_option)->setAttribute('class', 'uk-select uk-border-rounded selected'); ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label uk-text-bold" for="tr_field_type_corps">Type de corps (<span class="uk-text-danger uk-text-small">*</span>)</label>
                            <div class="uk-form-controls">
                                <?php
                                $options = tr_options_field('options.insc_corps') ? tr_options_field('options.insc_corps') : [];
                                $value_option = [
                                    'Choix du type de corps' => ''
                                ];
                                foreach ($options as $option):
                                    if($option['active']):
                                        $value_option[$option['name']] = strtoupper($option['code']);
                                    endif;
                                endforeach;
                                ?>
                                <?= $form->select('type_corps')->setOptions($value_option)->setAttribute('class', 'uk-select uk-border-rounded selected'); ?>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <div class="uk-form-controls uk-text-right@m uk-text-center">
                                <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="submit">Valide les informations</button>
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
