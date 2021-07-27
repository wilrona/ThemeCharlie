<?php /* Template Name: Page Inscription Membre */ ?>

<?php

    if(isset($_SESSION['inscriptionMembre']) && !isset($_SESSION['inscriptionMembre']['two']['existCode'])):
        unset($_SESSION['inscriptionMembre']);
    endif;

?>

<?php get_header() ?>


<?php while (have_posts()) : the_post(); ?>

    <div class="uk-section uk-section-small uk-background-muted">
        <div class="uk-container uk-container-small">
            <h1 class="uk-text-center"><?= get_the_title() ?></h1>
        </div>
    </div>


<div class="uk-section typerocket-container">
    <div class="uk-container uk-container-small uk-position-relative">
        <div class="uk-width-1-1 uk-margin-medium-bottom">
            <?php the_content(); ?>
        </div>
        <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-margin uk-flex uk-flex-middle uk-flex-center" uk-grid>


            <div class="uk-margin-medium-top">
                <div class="uk-card uk-card-body uk-card-default uk-width-1-1 uk-border-rounded">
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
                                <?= $form->select('nationalite')->setOptions($values)->setAttribute('class', 'uk-select uk-border-rounded selected')->setDefault(isset($_SESSION['inscription']) && isset($_SESSION['inscription']['two']) ? $_SESSION['inscription']['two']['nationalite'] : ''); ?>
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



<?php endwhile; ?>

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