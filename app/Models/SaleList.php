<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleList extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity','price','type','total','product_id','package_id','sale_id','status_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Sale', 'sale_id', 'id');
    } 
}
