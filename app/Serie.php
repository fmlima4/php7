<?php

namespace App;

use illuminate\Database\Eloquent\Model;

class Serie extends Model 
{
    public $timestamps = false;
    protected $fillable = ['nome'];

    public function temporadas ()
    {
        return $this->hasMany(Temporada::class);
    }
}