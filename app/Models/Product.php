<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'name',
        'code',
        'price',
        'vendor_id',
        'stock'
    ];
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function favorites(){
        return $this->belongsToMany(Favorite::class,'favorite_product',
            'product_id',
            'favorite_id')
            ->withPivot('send_notif_on_available');
    }
}
