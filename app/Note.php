<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Note extends Model
{
    protected $fillable = ['note', 'annonce_id'];
}
