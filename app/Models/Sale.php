<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','subtotal','tax','discount','total','status_id','payment_id','customer_id','discount_id'
    ];

    public function lists()
    {
        return $this->hasMany('App\Models\SaleList', 'sale_id')->orderBy('created_at','DESC');
    } 

}
