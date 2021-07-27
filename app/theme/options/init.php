<?php
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

// Setup Form
$form = tr_form()->useJson()->setGroup($this->getName());
?>

<h1>Theme Options</h1>
<div class="typerocket-container">
    <?php
    echo $form->open();

    $company_infos = function () use ($form) {

        echo '<h2 class="uk-padding-remove-bottom uk-text-center uk-margin-top">Information de l\'entreprise</h2>';
        echo $form->text('online')->setLabel('Téléphone Whatsapp');
        echo '<hr />';

        echo $form->text('secret_prefix')->setLabel('Le prefix du code secret');
        echo $form->text('activa_prefix')->setLabel('Le prefix du code d\'activation');

        echo '<hr />';

        echo $form->image('icon')->setLabel('Icone du site')->setHelp('Visible dans le coin de l\'onglet du navigateur')->setSetting('button', 'Inserer l\'icone');
        echo $form->image('logo')->setLabel('Logo du site web')->setSetting('button', 'Inserer le logo');
        echo $form->image('footer_image')->setLabel('Image du slogan du pied de page')->setSetting('button', 'Insérer l\'image slogan');
    };

    $param_villes = function () use ($form) {

        echo '<h2 class="uk-padding-remove uk-text-center uk-margin-top">Paramètre des villes</h2>';

        echo $form->repeater('insc_ville')->setFields([
            $form->text('name')->setLabel('Nom de la ville'),
            $form->text('code')->setLabel('Code de la ville'),
            $form->toggle('active')->setText('Inscription dans cette ville ?')->setLabel('')
        ])->setLabel('Liste des villes')->setSettings([
            'add_button' => 'Ajouter une ligne',
            'controls' => [
                'contract' => 'Contracter',
                'flip' => 'Renverser',
                'clear' => 'Tout effacer'
            ]
        ]);

    };

    $config_page = function () use ($form){
        
        echo '<h2 class="uk-padding-remove-bottom uk-text-center uk-margin-top">Configuration des pages</h2>';

        echo $form->search('page_connexion')->setLabel('Page de connexion')->setPostType('page');
        echo $form->search('page_inscription_membre')->setLabel('Page d\'inscription des membres')->setPostType('page');
        echo $form->search('page_inscription')->setLabel('Page d\'inscription des escortes')->setPostType('page');
        echo $form->search('page_dashboard')->setLabel('Page de dashboard')->setPostType('page');
        echo $form->search('page_service')->setLabel('Page de dashboard service')->setPostType('page');
        echo $form->search('page_photo')->setLabel('Page de dashboard photo')->setPostType('page');
        echo $form->search('page_condition')->setLabel('Page de condition d\'utilisation')->setPostType('page');

    };

    $param_teint = function () use ($form) {

        echo '<h2 class="uk-padding-remove uk-text-center uk-margin-top">Paramètre des teints</h2>';

        echo $form->repeater('insc_teint')->setFields([
            $form->text('name')->setLabel('Nom du teint'),
            $form->text('code')->setLabel('Code du teint'),
            $form->toggle('active')->setText('Afficher ce teint ?')->setLabel('')
        ])->setLabel('Liste des teints')->setSettings([
            'add_button' => 'Ajouter une ligne',
            'controls' => [
                'contract' => 'Contracter',
                'flip' => 'Renverser',
                'clear' => 'Tout effacer'
            ]
        ]);

    };

    $param_service = function () use ($form) {

        echo '<h2 class="uk-padding-remove uk-text-center uk-margin-top">Paramètre des services</h2>';

        echo $form->repeater('insc_service')->setFields([
            $form->text('name')->setLabel('Nom du service'),
            $form->text('code')->setLabel('Code du service'),
            $form->toggle('active')->setText('Afficher ce service ?')->setLabel('')
        ])->setLabel('Liste des services')->setSettings([
            'add_button' => 'Ajouter une ligne',
            'controls' => [
                'contract' => 'Contracter',
                'flip' => 'Renverser',
                'clear' => 'Tout effacer'
            ]
        ]);

    };

    $param_corps = function () use ($form) {

        echo '<h2 class="uk-padding-remove uk-text-center uk-margin-top">Paramètre des types de corps</h2>';

        echo $form->repeater('insc_corps')->setFields([
            $form->text('name')->setLabel('Nom du type de corps'),
            $form->text('code')->setLabel('Code du type de corps'),
            $form->toggle('active')->setText('Afficher ce type de corps ?')->setLabel('')
        ])->setLabel('Liste des types de corps')->setSettings([
            'add_button' => 'Ajouter une ligne',
            'controls' => [
                'contract' => 'Contracter',
                'flip' => 'Renverser',
                'clear' => 'Tout effacer'
            ]
        ]);

    };

    $param_horaire = function () use ($form) {

        echo '<h2 class="uk-padding-remove uk-text-center uk-margin-top">Paramètre des horaires</h2>';

        echo $form->repeater('insc_horaire')->setFields([
            $form->text('name')->setLabel('Nombre d\'heure'),
            $form->toggle('active')->setText('Afficher cet horaire ?')->setLabel('')
        ])->setLabel('Liste des horaires')->setSettings([
            'add_button' => 'Ajouter une ligne',
            'controls' => [
                'contract' => 'Contracter',
                'flip' => 'Renverser',
                'clear' => 'Tout effacer'
            ]
        ]);

    };

    $param_indication = function () use ($form){

        echo '<h2 class="uk-padding-remove uk-text-center uk-margin-top">Paramètre des indications des pays</h2>';

        echo $form->repeater('indications')->setFields([
            $form->text('indication')->setLabel('Numero de l\'indication'),
            $form->text('pays')->setLabel('Pays de l\'indication'),
            $form->toggle('active')->setText('Utiliser ?')->setLabel('')
        ])->setLabel('Liste des indications')->setSettings([
            'add_button' => 'Ajouter une ligne',
            'controls' => [
                'contract' => 'Contracter',
                'flip' => 'Renverser',
                'clear' => 'Tout effacer'
            ]
        ]);

    };

    $param_conseiller = function () use ($form){
        echo '<h2 class="uk-padding-remove uk-text-center uk-margin-top">Paramètre des numéros des teleconseillers</h2>';

        echo $form->items('conseiller')->setLabel('Liste des numéros des téléconseillers')->setSettings([
            'button' => 'Ajouter un numéro',
            'controls' => [
                'clear' => 'Tout effacer'
            ]
        ]);
    };
    // Save
    $save = $form->submit('Enregistrement');

    // Layout
    tr_tabs()->setSidebar($save)
        ->addTab('Entreprise', $company_infos)
        ->addTab('Pages', $config_page)
        ->addTab('Villes', $param_villes)
        ->addTab('Teints', $param_teint)
        ->addTab('Services', $param_service)
        ->addTab('Types de corps', $param_corps)
        ->addTab('Horaires', $param_horaire)
        ->addTab('Indications', $param_indication)
        ->addTab('Teleconseiller', $param_conseiller)
        ->render();
    echo $form->close();
    ?>

</div>