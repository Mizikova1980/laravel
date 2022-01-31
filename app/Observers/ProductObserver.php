<?php

namespace App\Observers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $user = Auth::user();
        $now = Carbon::now()->toDateTimeString();
        Log::info("{$now}: {$user->name}, CATEGORY_CREATED {$product->name}");
    }

    /**
     * Handle the Category "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        dump($product->getOriginal('description'));
        dd($product->getDirty());
    }

    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $user = Auth::user();
        $now = Carbon::now()->toDateTimeString();
        Log::info("{$now}: {$user->name}, CATEGORY_DELETED {$product->name}");
    }
    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
