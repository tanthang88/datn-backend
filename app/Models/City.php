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

    /**
     * The attributes that are mass assignable.
     *
     * @return Collection
     */
    public function dists(){
        return $this->hasMany(Dist::class, 'code', 'code');
    }

}
