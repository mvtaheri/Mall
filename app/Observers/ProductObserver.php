<?php

namespace App\Observers;

use App\Mail\ProductAvailable;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

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
        //
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        if ($product->getOriginal('stock') == 0 && $product->stock >= 0){
            $favorites=Favorite::whereHas('productsNotifible',function($query) use($product){
                $query->where('product_id',$product->id);
            })->get(['id','user_id']);
            foreach ($favorites as $favorite){
                $user=$favorite->user;
                Mail::to($user->email)->queue(new ProductAvailable($product));
                /**
                 * or can use notification
                 * $user->notify(new ProductAvailble($product))
                 **/
            }

        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
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
