<?php

namespace App\Jobs;

use App\Models\product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 3;

       /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = 'public/storage/products.csv';
            $file = fopen($fileName, 'r');

            $carbon = new Carbon();
            $now = $carbon->now()->toDateTimeString();

            $i = 0;
            $insert = [];
            while ($data = fgetcsv($file, 1000, ';')) {
                if ($i++ == 0) continue;
                $insert[] = [
                    'name' => $data[0],
                    'description' => $data[1],
                    'price'=>$data[2],
                    'picture' => $data[3],
                    'category_id'=>$data[4],
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }
            product::insert($insert);
    }
}
