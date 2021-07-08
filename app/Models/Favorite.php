<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class,'favorite_product','favorite_id',
        'product_id')
            ->withPivot('send_notif_on_available');
    }
    public function productsNotifible(){
        return $this->belongsToMany(Product::class,'favorite_product','favorite_id',
            'product_id')
            ->wherePivotIn('send_notif_on_available', [true]);
    }
}
