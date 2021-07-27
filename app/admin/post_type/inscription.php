<?php

$post_type = tr_post_type('Inscrit', 'Inscrits');

$args = $post_type->getArguments();

$label = [
    'add_new'            => 'Ajouter',
];

$args = array_merge( $args, [
    'labels' => $label ]
);

$post_type->setArguments( $args );


$post_type->setIcon('users');
$post_type->setArgument('supports', ['title'] );
$post_type->removeArgument('revisions');
$post_type->setTitlePlaceholder('Nom et prenom');
//$post_type->setAdminOnly();

$post_type->removeColumn('date');

$post_type->addColumn('datenais', true, 'Age', function ($value){

    list($jour, $mois, $annee) = preg_split('[/]', $value);
    $today['mois'] = date('n');
    $today['jour'] = date('j');
    $today['annee'] = date('Y');

    $annees = $today['annee'] - $annee;

    echo $annees . ' ans';
//    echo $value;
}, 'string');


//
//$post_type->addColumn('position', true, 'Ville',  null, 'string');
////$post_type->addColumn('email', true, 'Email');
$post_type->addColumn('phone', true, 'Telephone');


$type_inscrit = tr_posts_field('type_user');

$box = tr_meta_box('listing_image')->setLabel('Image validée');
$box->setPriority('high');
$box->setCallback(function(){
    $photos = tr_posts_field('photos');

    $photos_valide = tr_posts_field('photos_valide') ? tr_posts_field('photos_valide') : [];

    if($photos):
    ?>

    <div uk-slider="center: true" class="uk-position-relative uk-visible-toggle">

        <ul class="uk-slider-items uk-child-width-1-2@m uk-grid-match" uk-lightbox="animation: slide">
            <?php foreach ($photos as $photo): ?>
            <li>
                    <img src="<?= wp_get_attachment_image_src($photo['photo'], 'gallery_user')[0]; ?>" alt="" >
                    <div class="uk-position-bottom uk-padding-small uk-text-truncate <?php if(in_array($photo['photo'], $photos_valide)): ?> uk-overlay-primary <?php else: ?>uk-overlay-default<?php endif; ?>">
                        <?php if(in_array($photo['photo'], $photos_valide)): ?>
                            <span class="uk-text-success">Validée</span>
                        <?php else: ?>
                            <span class="uk-text-danger">Non Validée</span>
                        <?php endif; ?>
                    </div>
            </li>
            <?php endforeach; ?>
        </ul>

        <a class="uk-position-center-left uk-position-small uk-hidden-hover uk-background-default" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover uk-background-default" href="#" uk-slidenav-next uk-slider-item="next"></a>

    </div>

    <?php
    endif;
});

if($type_inscrit === 'e' || $type_inscrit === null):
    $box->apply($post_type);
endif;

$box1 = tr_meta_box('Presentation')->setLabel('Information personnelle');
$box1->setCallback(function (){
    $form = tr_form();

    echo $form->editor('post_content')->setLabel('Presentation');

    echo $form->toggle('active_content')->setLabel('')->setText('Affichez la présentation ?');

    echo $form->date('datenais')->setLabel('Date de naissance')->setAttribute('disabled', true);;
    echo $form->text('nationalite')->setLabel('Nationnalite')->setAttribute('disabled', true);

    $type_inscrit = tr_posts_field('type_user');

    if($type_inscrit === 'e' || $type_inscrit === null):

        echo $form->select('sexe')->setLabel('Sexe')->setOptions([
            'Sexe non défini' => '',
            'Femme' => 'f',
            'Homme' => 'm'
        ])->setAttribute('disabled', true);

        echo $form->text('taille')->setLabel('Taille (en cm)')->setAttribute('disabled', true);

        echo $form->text('poids')->setLabel('Poids (en Kg)')->setAttribute('disabled', true);

        $options = tr_options_field('options.insc_teint') ? tr_options_field('options.insc_teint') : [];
        $value_option = [
            'Teint non défini' => ''
        ];
        foreach ($options as $option):
            if($option['active']):
                $value_option[$option['name']] = strtoupper($option['code']);
            endif;
        endforeach;

        echo $form->select('teint')->setOptions($value_option)->setLabel('Selectionnez un teint')->setAttribute('disabled', true);


        $options = tr_options_field('options.insc_corps') ? tr_options_field('options.insc_corps') : [];
        $value_option = [
            'Type de corps non défini' => ''
        ];
        foreach ($options as $option):
            if($option['active']):
                $value_option[$option['name']] = strtoupper($option['code']);
            endif;
        endforeach;

        echo $form->select('type_corps')->setOptions($value_option)->setLabel('Selectionnez un type de corps')->setAttribute('disabled', true);

    endif;

    echo $form->hidden('post_status_old')->setAttribute('value', tr_posts_field('post_status'));
});

$box1->apply($post_type);

$box2 = tr_meta_box('adresse')->setLabel('Localisation et Contact');
$box2->setCallback(function (){
    $form = tr_form();

    echo $form->text('phone')->setLabel('Téléphone portable')->setHelp('Numero de telephone utilise pour la mise en relation')->setAttribute('disabled', true);
    echo $form->text('phonewhatsapp')->setLabel('Téléphone Whatsapp')->setHelp('Numero de telephone utilise pour whatsapp')->setAttribute('disabled', true);

    $type_inscrit = tr_posts_field('type_user');

    if($type_inscrit === 'e' || $type_inscrit === null):

        $option_ville = tr_options_field('options.insc_ville') ? tr_options_field('options.insc_ville') : [];
        $value_option = [
            'Ville non définie' => ''
        ];
        foreach ($option_ville as $option):
            if($option['active']):
                $value_option[$option['name']] = strtoupper($option['code']);
            endif;
        endforeach;

        echo $form->select('ville')->setOptions($value_option)->setLabel('Selectionner une ville')->setAttribute('disabled', true);

        echo $form->text('quartier_recevoir')->setLabel('Quartier de reception')->setAttribute('disabled', true);

    endif;
});

$box2->apply($post_type);

$box3 = tr_meta_box('user_service')->setLabel('Service proposé');
$box3->setCallback(function(){
   ?>
    <table class="uk-table uk-table-small uk-table-divider">
        <tr>
            <td class="uk-text-bold uk-width-1-2">Disponible pour</td>
            <td >
                <?php $disponibilite = tr_posts_field('disponibilite'); ?>
                <?php

                if($disponibilite){
                    if($disponibilite === 'out') echo 'Me Déplacer';
                    if($disponibilite === 'in') echo 'Recevoir';
                    if($disponibilite === 'both') echo 'Me deplacer - Recevoir';
                }else {

                    echo 'Non défini';

                }
                ?>
            </td>
        </tr>
        <tr>
            <td class="uk-text-bold">Service offert pour</td>
            <td >
                <?php $service_offert = tr_posts_field('service_offert'); ?>
                <?php

                    if($service_offert){

                            if($service_offert === 'm') echo 'Homme';
                            if($service_offert === 'f') echo 'Femme';
                            if($service_offert === 'b') echo 'Homme - Femme';
                    }else {

                        echo 'Non défini';

                    }
                ?>
            </td>
        </tr>
        <tr>
            <td class="uk-text-bold">Service proposé</td>
            <td>
                <?php $service_propose = tr_posts_field('service_propose'); ?>


                <?php

                $option_service = tr_options_field('options.insc_service') ? tr_options_field('options.insc_service') : [];

                if($service_propose):
                    foreach ($service_propose as $service):

                        $title = '';
                        $active = false;
                        foreach ($option_service as $option):
                            if($option['active'] && strtoupper($option['code']) === strtoupper($service)):
                                $active = true;
                                $title = $option['name'];
                            endif;
                        endforeach;

                        if($active) echo '<span class="uk-label uk-margin-small-right" uk-tooltip="'.$title.'">'.$service.'</span>';

                    endforeach;
                else:

                    echo 'Non défini';

                endif;
                ?>
            </td>
        </tr>
    </table>

    <?php $option_horaire = tr_options_field('options.insc_horaire') ? tr_options_field('options.insc_horaire') : []; ?>

    <?php $service_price = tr_posts_field('service_price'); ?>

    <table class="uk-table uk-table-small uk-table-divider">
        <caption class="uk-text-bold">Coût horaire des services</caption>
        <thead>
            <tr>
                <th>Duree</th>
                <th>Prix</th>
                <th>shots</th>
            </tr>
        </thead>
        <tbody>
        <?php if($service_price): ?>
            <?php
                foreach ($service_price as $price):

                    $active = false;

                    foreach ($option_horaire as $option):
                        if($option['active'] && $option['name'] === $price['name']):
                            $active = true;
                        endif;
                    endforeach;

                    if($active):
            ?>
                        <tr>
                            <td><?= $price['name'] ?></td>
                            <td><?= $price['amount'] ?> FCFA</td>
                            <td><?= $price['shot'] ?></td>
                        </tr>
            <?php
                    endif;

                endforeach;
            ?>
        <?php else: ?>
            <tr>
                <td colspan="3"><h3 class="uk-text-center">Aucune information</h3></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php
});

if($type_inscrit === 'e' || $type_inscrit === null):
    $box3->apply($post_type);
endif;

$box5 = tr_meta_box('user_infos')->setLabel('Infos de l\'utilisateur');
$box5->setPriority('high');
$box5->setContext('side');
$box5->setCallback(function(){
    $form = tr_form();

    $user_id = tr_posts_field('user_id');

    if($user_id):

        $user_data = get_user_by('id', $user_id);

        echo $form->text('pseudo')->setLabel('Pseudo')->setAttributes(['disabled' => true, 'value' => $user_data->user_login]);

    endif;

    echo $form->select('type_user')->setLabel('Type inscrit')->setOptions([
        'Selectionnez le type' => '',
        'Escorte' => 'e',
        'Membre' => 'm'
    ])->setAttribute('disabled', true);

    echo $form->toggle('active')->setLabel('')->setText('Compte actif ?');

});

$box5->apply($post_type);

$box4 = tr_meta_box('user_image')->setLabel('Photo à valider de l\'utilisateur');
$box4->setContext('side');
$box4->setCallback(function(){
    $form = tr_form();

    echo $form->toggle('valid_photo')->setLabel('')->setText('Validez les photos ?')->setSetting('default', false);
    echo $form->toggle('delete_photo')->setLabel('')->setText('Supprimer les photos ?')->setSetting('default', false);

    $repeater = $form->repeater('photos')->setFields([
        $form->image('photo')->setSettings(['button' => 'Ajouter une image', 'clear' => 'Effacer'])
    ])->setSettings([
        'add_button' => 'Ajouter les photos',
        'controls' => [
            'contract' => 'Contracter',
            'flip' => 'Renverser',
            'limit' => 'Limite de photo atteint',
            'clear' => 'Tout effacer'
        ]
    ])->setLabel('Liste des photos');

    echo $repeater;
});

if($type_inscrit === 'e' || $type_inscrit === null):
    $box4->apply($post_type);
endif;


add_filter( 'bulk_actions-edit-inscrit', 'inscrit_bulk_actions' );
function inscrit_bulk_actions( $actions ){
    unset( $actions[ 'trash' ] );
    return $actions;
}


//add_action('wp_trash_post', 'prevent_inscrit_deletion');
function prevent_inscrit_deletion($postid){
    $post = get_post($postid);
    if ($post->post_type == 'inscrit') {
        wp_die('Cette information ne peut être supprimée. <br><br> <a href="'.tr_redirect()->back()->url.'">Retour</a>');
    }
}

function inscrit_action_row($actions, $post){

    if ($post->post_type =="inscrit"){
        unset( $actions[ 'trash' ] );
//        $actions['print'] = '<a href="'.tr_redirect()->toHome('/inscrit/formulaire/'.tr_posts_field('codeins', $post->ID))->url.'" target="_blank">Imprimer</a>';
    }

    return $actions;
}

//add_filter('post_row_actions','inscrit_action_row', 10, 2);

function inscrit_admin_notice(){
    global $post_type;
    global $pagenow;

    if ( $post_type == 'inscrit' && $pagenow !== 'post.php' ) {

         $inscrits= tr_query()->table('wp_miss_inscrit')->findAll()->get();

         if($inscrits){

             echo '<div class="notice notice-warning" data-class="is-dismissible">
                 <p>Vous avez des données des candidates encore présentes dans la version ancienne du Site Miss Orangina. <br> Cliquez sur <a class="uk-text-success" href="'.tr_redirect()->toHome('/inscrit/import')->url.'">Importer les données</a> pour importer.</p>
            </div>';

         }

    }
}
//add_action('admin_notices', 'inscrit_admin_notice');

//add_filter('views_edit-inscrit','export_inscrit_filter');

function export_inscrit_filter($views){
    $url = tr_redirect()->toHome('/inscrit/export/?s='.$_GET['s'].'&slug='.$_GET['slug'].'&slug-year='.$_GET['slug-year'])->url;
    $views['import'] = '<a href="'.$url.'" class="primary" target="_blank">Exporter le tableau</a>';
    return $views;
}
