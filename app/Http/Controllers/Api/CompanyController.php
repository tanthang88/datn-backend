<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class CompanyController extends Controller
{
    public function __construct(protected CompanyService $companyService)
    {
    }
    public function company()
    {
        try {
            return $this->ResponseSuccess($this->companyService->getCompany());
        } catch (\Throwable $th) {
            Log::error("Get failed:" . $th);
            return $this->responseError(
                array(trans('alert.company.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
