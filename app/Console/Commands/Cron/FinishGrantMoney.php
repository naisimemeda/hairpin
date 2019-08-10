<?php
namespace App\Console\Commands\Cron;

use App\Models\Shop;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FinishGrantMoney extends Command
{
    protected $signature = 'cron:finish-grant-money';

    protected $description = '发放前一天收入';

    public function handle()
    {

        DB::transaction(function (){
            Shop::query()->each(function (Shop $shop) {
                $shop->increment('money', $shop->frozen_money);
                $shop->frozen_money = 0;
                $shop->save();
            });
        });
    }
}