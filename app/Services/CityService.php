<?php
namespace App\Services;

use App\Models\City;

class CityService {

    /**
     * getCity
     *
     * @return City $city
     */
    public function getCity()
    {
        return City::get(['id','name','transport_fee']);
    }
}
