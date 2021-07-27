<?php
namespace App\Models;

use TypeRocket\Models\WPPost;

class Inscrit extends WPPost
{
    protected $postType = 'inscrit';

    protected $fillable = [
        'post_content',
        'datenais',
        'nationalite',
        'sexe',
        'taille',
        'poids',
        'type_user',
        'teint',
        'type_corps',
        'phone',
        'phonewhatsapp',
        'ville',
        'disponibilite',
        'service_offert',
        'service_propose',
        'service_price',
        'quartier_recevoir',
        'user_id',
        'photos',
        'photos_valide',
        'photos_a_valider',
        'active_content',
        'active',
        'post_author'
    ];

}
