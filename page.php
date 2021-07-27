<?php get_header() ?>

<?php while (have_posts()) : the_post(); ?>

    <div class="uk-section uk-section-small uk-background-muted">
        <div class="uk-container uk-container-small">
            <h1 class="uk-text-center"><?= get_the_title() ?></h1>
        </div>
    </div>

    <div class="uk-section typerocket-container">
        <div class="uk-container uk-container-small uk-position-relative">
            <div class="uk-child-width-1-1 uk-margin uk-flex uk-flex-center" uk-grid>

                <div class="uk-margin-medium-bottom">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<?php get_footer(); ?>