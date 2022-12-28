<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BillDetailResource;
use App\Models\Bill;
use App\Services\BillService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    /**
     * __construct
     *
     * @param  BillService $billService
     *
     */
    public function __construct(protected BillService $billService)
    {
    }

    /**
     * list bill of user
     *
     * @return void
     */
    public function index()
    {
        try {
            $data = $this->billService->getBills();
            return $this->responseSuccess(['data' => $data]);
        } catch (\Throwable $th) {
            Log::error("get list category " . $th);
            return $this->responseError(
                array(trans('alert.post.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * show bill detail of user by bill id
     *
     * @param  Bill $bill
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        try {
            $data = $this->billService->getBill($bill);
            return $this->responseSuccess(['data' => BillDetailResource::make($data)]);
        } catch (\Throwable $th) {
            Log::error("get list category " . $th);
            return $this->responseError(
                array(trans('alert.post.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * create new bill
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $data = $this->billService->create($request);
            return $this->responseSuccess([$data], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error("add to bill " . $th);
            return $this->responseError(
                array(trans('alert.bill.create.failed')),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * cancelBill
     *
     * @param  Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function cancelBill(Bill $bill)
    {
        try {
            if ($this->billService->cancel($bill)) {
                return $this->responseSuccess([], Response::HTTP_NO_CONTENT);
            }
            $statusCode = Response::HTTP_BAD_REQUEST;
        } catch (\Throwable $th) {
            Log::error("Cancel bill fail" . $th);
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $this->responseError(
            [trans('alert.bill.cancel.failed')],
            $statusCode
        );
    }
}
