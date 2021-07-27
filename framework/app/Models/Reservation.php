<?php
namespace App\Models;

use TypeRocket\Models\WPPost;

class Reservation extends WPPost
{
    protected $postType = 'reservation';

    protected $fillable = [
        'codeins'
    ];

}
