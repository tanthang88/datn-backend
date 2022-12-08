<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'cities';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @return Collection
     */
    public function dists(){
        return $this->hasMany(Dist::class, 'code', 'code');
    }
    public function about()
    {
        return $this->hasMany(About::class, 'id_city', 'code');
    }

    public function bills(){
        return $this->hasMany(Bill::class, 'city_id', 'id');
    }

}
