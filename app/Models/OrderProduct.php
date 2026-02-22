<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function seller(){
        return $this->belongsTo(Vendor::class,'seller_id');
    }

    public function orderProductVariants(){
        return $this->hasMany(OrderProductVariant::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

}
