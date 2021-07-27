<?php

//$home = (int) get_option('page_on_front');

$bloc_howork = tr_meta_box('how-work');
$bloc_howork->setLabel('Comment ça marche ?');
$bloc_howork->addScreen('page');
$bloc_howork->setCallback(function (){

    $form = tr_form();

    echo $form->toggle('show_listing')->setText('Afficher la liste des escorts ?')->setLabel('');

    $concept1 = function() use ($form) {
        echo $form->repeater('list_how_gauche')->setFields([
            $form->text('number')->setLabel('Numéro'),
            $form->text('title')->setLabel('Titre'),
            $form->text('desc')->setLabel('Description')
        ])->setLabel('');
    };

    $concept2 = function() use ($form){

        echo $form->repeater('list_how_droite')->setFields([
            $form->text('number')->setLabel('Numéro'),
            $form->text('title')->setLabel('Titre'),
            $form->text('desc')->setLabel('Description')
        ])->setLabel('');

    };

    tr_tabs()
        ->addTab( 'Block Gauche', $concept1 )
        ->addTab( 'Block Droite', $concept2 )
        ->render();

});

add_action('admin_head', function () use ($bloc_howork) {
    if (get_page_template_slug(get_the_ID()) !== 'home.php') :
        remove_meta_box($bloc_howork->getId(), 'page', 'normal');
    endif;
});
