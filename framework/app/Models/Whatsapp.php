<?php
namespace App\Models;

use TypeRocket\Models\Model;

class Whatsapp extends Model
{
    protected $resource = 'whatsapp';

    protected $fillable = [
        'iduser',
        'idpostuser',
        'typeUser',
        'codeParrain',
        'numero',
        'numeroContact',
        'numeroWhatsapp',
        'statut',
        'codeactivation',
        'sessions',
        'idparent'
    ];

}
