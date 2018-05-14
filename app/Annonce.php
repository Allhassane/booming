<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Annonce extends Model
{

    //
    protected $fillable = [
        'categorie_id', 'name', 'city', 'situation', 'mobile', 'email', 'description', 'user_id', 'fixe', 'strong_point', 'promoted', 'verified', 'statut', 'vignette', 'slug'
    ];

    public function scopeFirstPromoted($query)
    {
        return $query->where('promoted', 1)->where('verified', 1);
    }

    public function scopeSecondPromoted($query)
    {
        return $query->where('promoted', 2)->where('verified', 1);
    }

    public function scopeRecentAnnonce($query)
    {
        return $query->where('statut', 1)->where('verified', 1)->OrderBy('id', 'desc');
    }


    public static function createSlug($string) {

        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '-', ' ' => '-', '&' => 'et', '\'' => '-', '~' => '', '²' => '',
            '"'=>'-', '#'=> '', '{'=>'', '}'=>'', '['=>'', ']'=>'', '('=>'', ')'=>'', '|'=>'', '`'=>'', '\ '=>'',
            '^'=>'', '°'=>'', '$'=>'', '£'=>'', '*'=>'', 'µ'=>'', ','=>''
        );

        // -- Remove duplicated spaces
        $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);

        // -- Returns the slug
        return strtolower(strtr($string, $table));

    }

    // relation ship
    public function services(){
        return $this->hasMany('App\Service');
    }

    public function images(){

        return $this->hasMany('App\Image');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

    public function categorie(){
        return $this->belongsTo('App\Category');
    }

    public function themes(){
        return $this->belongsToMany('App\Theme');
    }

    public function comments(){
        return $this->hasMany('App\Commentaire');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }

    public function reservations(){
        return $this->hasMany('App\Reservation');
    }
}
