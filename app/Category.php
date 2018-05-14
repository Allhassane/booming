<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    public function scopeCategoryWithoutAutre($query)
    {
        return $query->where('libelle', '<>', 'Autres')->where('statut', 1);
    }
}
