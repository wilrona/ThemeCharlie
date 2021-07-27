<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 17:50
 */



$post_type = tr_post_type('Reservation', 'Reservations');

$post_type->setIcon('calendar');
$post_type->setArgument('supports', ['title'] );


$args = $post_type->getArguments();

$label = [
    'add_new'            => 'Ajouter',
    'add_new_item' => 'Ajouter une reservation'
];

$args = array_merge( $args, [
        'labels' => $label,
        'capabilities' => array(
            'create_posts' => true
        )
    ]
);

$post_type->setArguments( $args );
$post_type->removeArgument('revisions');
$post_type->setTitlePlaceholder('Code de la réservation');
$post_type->setAdminOnly();

$box1 = tr_meta_box('reserv_user_infos')->setLabel('Infos des utilisateurs');
$box1->setPriority('high');
$box1->setContext('side');
$box1->setCallback(function(){
    $form = tr_form();

    $member_id = tr_posts_field('member_id');

    $data_member_id = tr_query()->table('wp_whatsapp')->findById($member_id);

    echo $form->text('member_id')->setLabel('Whatsapp du membre')->setAttributes(['disabled' => true, 'value' => $data_member_id->numero]);


    $escort_id = tr_posts_field('escort_id');
    $data_escort_id = tr_query()->table('wp_whatsapp')->findById($escort_id);

    echo $form->text('escort_id')->setLabel('Whatsapp de l\'escort')->setAttributes(['disabled' => true, 'value' => $data_escort_id->numero]);
    echo $form->text('escort_contact')->setLabel('Numéro de contact de l\'escort')->setAttributes(['disabled' => true, 'value' => $data_escort_id->numeroContact]);




});

$box1->apply($post_type);

$box2 = tr_meta_box('caract_reservation')->setLabel('Caractéristique de la réservation');
$box2->setCallback(function (){
    $form = tr_form();

    echo $form->select('sexe')->setLabel('Je suis')->setOptions([
        'Sexe non défini' => '',
        'Une femme' => 'f',
        'Un homme' => 'm'
    ])->setAttribute('disabled', true);

    echo $form->select('genre')->setLabel('Je cherche')->setOptions([
        'Genre non défini' => '',
        'Une femme' => 'f',
        'Un homme' => 'm'
    ])->setAttribute('disabled', true);

    echo $form->select('deplacement')->setLabel('Qui va')->setOptions([
        'Déplacement non défini' => '',
        'Se déplacer' => 'out',
        'Me recevoir' => 'in'
    ])->setAttribute('disabled', true);

    echo $form->text('quartier')->setLabel('Dans le quartier')->setAttributes(['disabled' => true]);

    $post_date = tr_posts_field('post_date');
    $date = date("d-m-Y H:i", strtotime($post_date));

    echo $form->date('date_create')->setLabel('Le')->setAttributes(['disabled' => true, 'value' => $date]);

    $minutes = tr_posts_field('howmanytime');

    $howmanytime = '';

    if($minutes):
        $time = intval($minutes)*60;
        $howmanytime = date('H:i', $time);
    endif;

    echo $form->text('howmanytime')->setLabel('Pour')->setAttributes(['disabled' => true, 'value' => (string)$howmanytime]);

    echo $form->hidden('post_title_old')->setAttribute('value', tr_posts_field('post_title'));

});

$box2->apply($post_type);

$box3 = tr_meta_box('etat_reservation')->setLabel('Etat de la réservation');
$box3->setCallback(function (){
    $form = tr_form();

    echo $form->select('disponible')->setLabel('Disponibilité de l\'escorte')->setOptions([
        'Non disponible' => '0',
        'Disponible' => '1'
    ])->setAttribute('disabled', true);

    echo $form->select('facturation')->setLabel('Paiement')->setOptions([
        'Non' => '0',
        'Oui' => '1'
    ])->setAttribute('disabled', true);

});

$box3->apply($post_type);