<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','code','brand','name','stock','price','size','information','category_id','unit_id','pricing_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    } 

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'id');
    } 

    public function pricing()
    {
        return $this->belongsTo('App\Models\Dropdown', 'pricing_id', 'id');
    } 

    public function orders()
    {
        return $this->hasMany('App\Models\OrderList', 'product_id')->orderBy('created_at','DESC');
    } 


    // public function lists()
    // {
    //     return $this->hasMany('App\Models\ProductList', 'product_id')->orderBy('created_at','DESC');
    // } 

    public function setBrandAttribute($value)
    {
        $this->attributes['brand'] = ucwords(strtolower($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }
}
