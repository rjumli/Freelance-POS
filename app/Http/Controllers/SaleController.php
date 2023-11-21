<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class SaleController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request->all());
            break;
            case 'cart':
                return $this->cart($request->all());
             break;
            default : 
            return inertia('Modules/Sales/Index');
        }
    }

    public function cart($request){
        $keyword = $request['keyword'];
        $data = Product::with('category','unit','pricing')->where('code',$keyword)->first();
        return new DefaultResource($data);
    }

    public function lists($request){

    }
}
