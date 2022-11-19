<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckDiscountCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = explode(',', $this->promotion_id_customer);
        $user=Auth::id();
        if (in_array($user, $arr)) {
            return [
                'success' => false,
                'message' => 'Bạn đã sử dụng mã này! '
            ];
        } else {
            if ($this->promotion_type == 0) { //%
                $data['total'] = $request->total * ((100 - $this->promotionProduct->promotion_rate) / 100);
                $data['save_money'] = $request->total * (($this->promotionProduct->promotion_rate) / 100);
            } else {
                $data['total'] = $request->total - $this->promotionProduct->promotion_rate;
                $data['save_money'] = $this->promotionProduct->promotion_rate;
            }
            $id_users=$this->promotion_id_customer.$user.',';
            DB::table('promotions')->where('id',$request->id)->update(['promotion_id_customer'=>$id_users]);
            return [
                'success' => true,
                'message' => 'Áp dụng mã giảm giá thành công!',
                'data'=>$data
            ];
        }
    }
}
