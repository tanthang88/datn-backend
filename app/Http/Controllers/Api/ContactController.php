<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct(protected ContactService $contactService)
    {
    }
    /**
     * store
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        try {
            $res = $this->contactService->createContact($request);
            return $this->responseSuccess(['data' => $res],Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error("create contact  failed " . $th);
            return $this->responseError(
                array(trans('alert.contact.create.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
