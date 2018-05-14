<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AnnonceImage extends Model
{
    protected $fillable = ['picture', 'annonce_id'];
}
