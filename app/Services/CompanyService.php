<?php
namespace App\Services;

use App\Models\Company;

class CompanyService {
    public function getCompany()
    {
        return Company::first();
    }
}
