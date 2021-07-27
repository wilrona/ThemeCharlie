<?php get_header() ?>

<div class="uk-section uk-section-small uk-background-muted">
    <div class="uk-container uk-container-small">
        <h1 class="uk-text-center uk-margin-remove">Devenir escort chez charlie</h1>
        <h4 class="uk-text-center uk-margin-remove uk-text-bold">Etape 2/4</h4>
    </div>
</div>

<div class="uk-section typerocket-container">
    <div class="uk-container uk-container-small uk-flex uk-flex-center">
        <div class="uk-card uk-card-body uk-card-default uk-width-5-6@m uk-width-1-1 uk-border-rounded">
            <h3 class="uk-text-danger-c uk-text-center uk-text-bold uk-margin-medium-bottom ">Completez votre bibliographie</h3>
            <?php

            flash('error-data-inscription');

            $form = tr_form('inscrit', 'inscrireTwo');
            $form->useUrl('post', '/inscrire/two');

            echo $form->open();

            $form->setRenderSetting('raw');
            $form->useOld();

            ?>

            <div class="uk-form-stacked">
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_nationalite">Présentation</label>
                    <div class="uk-form-controls">
                        <?= $form->editor('post_content')->setAttribute('class', 'uk-textarea'); ?>

                        <span class="uk-text-small-c uk-text-warning">Cette présentation sera visible après validation du contenu</span>
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
                        <?= $form->text('taille')->setType('number')->setAttributes(['class' => 'uk-input uk-border-rounded', 'min' => 100]); ?>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_poids">Poids (en Kg) (<span class="uk-text-danger uk-text-small">*</span>)</label>
                    <div class="uk-form-controls">
                        <?= $form->text('poids')->setType('number')->setAttributes(['class' => 'uk-input uk-border-rounded']); ?>
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

<?php get_footer(); ?>
