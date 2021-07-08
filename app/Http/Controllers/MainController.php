<?php

namespace App\Http\Controllers;

use App\Mail\ProductAvailable;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function getNotifibleProduct(Product $product){

        return Product::where('stock',0)->get();
        $favorites=Favorite::whereHas('productsNotifible',function ($query) use($product){
            return  $query->where('product_id',$product->id);
        })->get(['id','user_id']);
        foreach ($favorites as $favorite){
            $user=$favorite->user;
            Mail::to($user->email)->queue(new ProductAvailable($product));
        }

        return response()->json(['favorites'=>$favorites]);

    }

}
