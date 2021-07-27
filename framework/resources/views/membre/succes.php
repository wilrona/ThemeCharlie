<?php get_header() ?>

    <div class="uk-section uk-section-small uk-background-muted">
        <div class="uk-container uk-container-small">
            <h1 class="uk-text-center uk-margin-remove">Devenir membre chez charlie</h1>
            <h4 class="uk-text-center uk-margin-remove uk-text-bold">Fin</h4>
        </div>
    </div>

    <div class="uk-section typerocket-container">
        <div class="uk-container uk-container-small uk-flex uk-flex-center">
            <div class="uk-card uk-card-body uk-width-5-6@m uk-width-1-1 uk-border-rounded uk-background-muted">
                <?php flash('success-data-inscription-membre'); ?>
                <h1 class="uk-text-center uk-h2">Votre inscription en tant que membre chez charlie a été effectué avec succès.</h1>

                <div class="uk-navbar-item uk-margin-medium-top uk-margin-medium-bottom uk-visible@l">
                    <a class="uk-button uk-button-primary uk-button-large uk-border-rounded" href="#modal-full" uk-toggle>Reserver une escorte</a>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>