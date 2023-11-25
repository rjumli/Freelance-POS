<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Resources\DefaultResource;

class DiscountController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            default : 
            return inertia('Modules/Discounts/Index');
        }
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|unique:discounts,name,'.$request->id,
            'value' => 'required|integer',
            'based_id' => 'required',
            'type_id' => 'required',
            'subtype_id' => 'required',
        ]);

        $data = \DB::transaction(function () use ($request){
            if($request->editable){
                $data = Discount::where('id',$request->id)->first();
                $data->update($request->except('editable'));
                return $data;
            }else{
                return $data = Discount::create($request->all());
            }
            
        });
        $message = ($request->editable) ? 'updated' : 'created';
        return back()->with([
            'message' => 'Discount '.$message.' successfully. Thanks',
            'data' => new DefaultResource($data),
            'type' => 'bxs-check-circle',
            'color' => 'success'
        ]); 
    }

    public function lists($request){
        $data = DefaultResource::collection(
            Discount::when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->with('type','subtype','based')
            ->orderBy('id','asc')
            ->paginate(10)
            ->withQueryString()
        );
        return $data;
    }
}
