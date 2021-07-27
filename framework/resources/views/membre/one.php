<?php get_header() ?>

<div class="uk-section uk-section-small uk-background-muted">
    <div class="uk-container uk-container-small">
        <h1 class="uk-text-center uk-margin-remove">Devenir membre chez charlie</h1>
        <h4 class="uk-text-center uk-margin-remove uk-text-bold">Suite</h4>
    </div>
</div>

<div class="uk-section typerocket-container">
    <div class="uk-container uk-container-small uk-flex uk-flex-center">
        <div class="uk-card uk-card-body uk-card-default uk-width-1-1 uk-width-1-2@m uk-border-rounded">
            <h3 class="uk-text-danger-c uk-text-center uk-text-bold uk-margin-medium-bottom">Devenir membre</h3>
            <?php

            flash('error-data-inscription-membre');

            $form = tr_form('inscrit', 'inscrireMembre');
            $form->useUrl('post', '/membre/inscrire');

            echo $form->open();

            $form->setRenderSetting('raw');
            $form->useOld();

            ?>

            <div class="uk-form-stacked">
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_pseudo">Votre pseudo</label>
                    <div class="uk-form-controls">
                        <?= $form->text('pseudo')->setAttributes(['class' => 'uk-input']) ?>
                    </div>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label uk-text-bold" for="tr_field_name">Nom complet</label>
                    <div class="uk-form-controls">
                        <?= $form->text('name')->setAttributes(['class' => 'uk-input']) ?>
                        <span class="uk-text-small-c uk-text-warning">Cette information ne sera jamais public et aidera pour vous contacter</span>
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
                    <label class="uk-form-label uk-text-bold" for="tr_field_datenais">Date de naissance</label>
                    <div class="uk-form-controls">
                        <?= $form->text('datenais')->setAttributes(['class' => 'uk-input', 'id' => 'datepickerbirth']) ?>
                        <span id="info-birth" class="uk-hidden uk-text-small-c"></span>
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-form-controls uk-text-right@m uk-text-center">
                        <button class="uk-button uk-button-primary uk-disabled" type="submit" id="submit">Continuer</button>
                    </div>
                </div>
            </div>

            <?php
            echo $form->close();
            ?>
        </div>
    </div>
</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/inputmask.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.inputmask.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.inputmask.bundle.min.js"></script>

<script>
    jQuery(document).ready(function($) {

        MyAge();

        $('#datepickerbirth').on('keyup', function () {
            if($(this).val().length > 7){
                MyAge();
            }
        }).inputmask("date", {placeholder: "__/__/____"});

        function MyAge(){
            // on calcul l'âge
            var maintenant = new Date();
            var dateNais = $('#datepickerbirth').val();

            if(dateNais.length > 0){

                var data = dateNais.split('/');
                var maDateNaissance = new Date(data[2],data[1]-1,data[0]);
                var monAge = maintenant.getFullYear() - maDateNaissance.getFullYear();

                if (maDateNaissance.getMonth()>maintenant.getMonth()) {
                    monAge+=1;
                } else if (maintenant.getMonth() === maDateNaissance.getMonth() && maDateNaissance.getDate() >= maintenant.getDate()) {
                    monAge+=1;
                }

                if(monAge >= 18){
                    $("#info-birth").removeClass('uk-hidden');
                    $("#info-birth").addClass('uk-text-success');
                    $("#info-birth").removeClass('uk-text-danger');
                    $("#info-birth").text('Vous êtes éligible.');
                    $("#submit").removeClass('uk-disabled');

                }else{
                    $('#info-birth').removeClass('uk-hidden');
                    $('#info-birth').addClass('uk-text-danger');
                    $('#info-birth').removeClass('uk-text-success');
                    $('#info-birth').text('Vous n\'êtes pas éligible.');
                    $("#submit").addClass('uk-disabled');
                }

            }

        }
    })
</script>


<?php get_footer(); ?>
