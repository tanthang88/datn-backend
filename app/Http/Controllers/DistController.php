<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class DistController extends Controller
{
    public function dist(City $city)
    {
        return $city->dists;
    }
}
