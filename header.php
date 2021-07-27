<!DOCTYPE html>
<!--[if lt IE 7]><html
        class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html
        class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html
        class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
<!--<![endif]-->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>
        <?php if (is_category()) {
            single_cat_title();
            echo ' | ';
            bloginfo('name');
            //	    } elseif ( is_tag() ) {
            //		    echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
            //	    } elseif ( is_archive() ) {
            //		    wp_title(''); echo ' Archive | '; bloginfo( 'name' );
        } elseif (is_search()) {
            echo 'Recherche pour &quot;' . wp_specialchars($s) . '&quot; | ';
            bloginfo('name');
        } elseif (is_home() || is_front_page()) {
            bloginfo('name');
            echo ' | ';
            bloginfo('description');
        } elseif (is_404()) {
            echo 'Error 404 Not Found | ';
            bloginfo('name');
        } elseif (is_single()) {
            wp_title('');
            echo ' | ';
            bloginfo('name');
        } else {
            wp_title('');
            echo ' | ';
            bloginfo('name');
        } ?>
    </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?= wp_get_attachment_image_src(tr_options_field('options.icon'), 'full')[0]; ?>" />

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,600,600i,700,700i&display=swap" rel="stylesheet">

    <?php
    wp_head();
    ?>
</head>

<body>

<?php
    if(is_front_page())
    {
?>

        <div class="uk-position-relative uk-background-secondary">

            <?php get_template_part('partials/menuHome'); ?>

            <div class="uk-flex uk-flex-middle uk-flex-center uk-height-viewport-c">
                <div class="uk-width-4-5 uk-text-white uk-text-center uk-flex-center uk-flex uk-flex-middle">
                    <div class="uk-margin-large-top">
                        <h1 class="uk-text-white uk-margin-large-top">L'avenir de la réservation d'escort</h1>
                        <h5 class="uk-margin-remove uk-text-muted uk-text-center">
                            Des milliers de drôles de dames disponibles pour effectuer <br> les missions les plus folles pour
                            satisfaire vos plaisir.
                        </h5>

                        <div class="uk-navbar-item uk-margin-medium-top uk-margin-medium-bottom uk-visible@l">
                            <a class="uk-button uk-button-primary uk-button-large uk-border-rounded" href="#modal-full" uk-toggle>Reserver une escorte</a>
                        </div>
                        <p class="uk-text-small uk-visible@l">
                            Êtes-vous une escort ? <a href="<?= get_the_permalink(tr_options_field('options.page_inscription'))?>" class="uk-text-danger-c">cliquez-ici</a> pour accepter des
                            missions
                            <span class=""><br>chez charlie et ses drôles de dames</span>
                        </p>
                    </div>
                </div>
            </div>

        </div>

<?php

    }else{
        get_template_part('partials/menu');
    }