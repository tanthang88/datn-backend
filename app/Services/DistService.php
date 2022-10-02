<?php

namespace App\Services;

use App\Models\City;

class DistService
{
    /**
     * getDistByCity
     *
     * @param  City $city
     * @return Dist $dist
     */
    public function getDistByCity(City $city)
    {
        return $city->load('dists')->dists;
    }
}
