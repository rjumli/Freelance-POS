<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','code','brand','name','price','stock','reorder','information','is_visible','price_id','unit_id','category_id'
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
        return $this->belongsTo('App\Models\Dropdown', 'price_id', 'id');
    } 

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

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
