<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dist extends Model
{
    /**
     * table
     *
     * @var string
     */
    protected $table = 'dists';

    /**
     * City
     *
     * @return Collection
     */
    public function City(){
        return $this->belongsTo(City::class, 'code', 'code');
    }
}
