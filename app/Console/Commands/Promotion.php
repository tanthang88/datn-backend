<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Promotion as PromotionModel;

class Promotion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promotion:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = strtotime(date("Y-m-d H:i:s"));
        $promotions =  PromotionModel::select('promotion_status', 'id', 'promotion_datestart', 'promotion_numer_of_used', 'promotion_numer_of_use', 'promotion_dateend')->get();
        foreach ($promotions as $promotion) {
            //by date
            if ($now >= strtotime($promotion->promotion_datestart)) {
                if ($now <= strtotime($promotion->promotion_dateend)) {
                    PromotionModel::where('id', $promotion->id)->update(array('promotion_status' => 1));
                } else {
                    PromotionModel::where('id', $promotion->id)->update(array('promotion_status' => 2));
                }
            } else {
                PromotionModel::where('id', $promotion->id)->update(array('promotion_status' => 0));
            }
            // by amount used ->if confirm order-> add number-of-used
            if ($promotion->promotion_numer_of_use <= $promotion->promotion_numer_of_used) {
                PromotionModel::where('id', $promotion->id)->update(array('promotion_status' => 2, 'promotion_dateend' => date("Y-m-d H:i:s")));
            }
        }
    }
}
