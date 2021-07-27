<?php
/**
 * Created by IntelliJ IDEA.
 * User: user
 * Date: 01/05/2018
 * Time: 01:42
 */


$box1 = tr_meta_box('insc_infos')->setLabel('Information complémentaire');
$box1->addScreen('page'); // updated
$box1->setCallback(function () {
    $form = tr_form();

    echo $form->text('infos_insc')->setLabel('Titre information');

    echo $form->repeater('list_infos_insc')->setFields([
        $form->text('number')->setLabel('Numéro'),
        $form->text('desc')->setLabel('Description')
    ])->setLabel('');
});

add_action('admin_head', function () use ($box1) {
    if (get_page_template_slug(get_the_ID()) !== 'inscription.php') :
        remove_meta_box($box1->getId(), 'page', 'normal');
    endif;
});
