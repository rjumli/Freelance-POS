<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleList;
use App\Models\Dropdown;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $options = $request->options;
        switch($options){
            case 'lists':
               return $this->lists($request);
            break;
            default : 
            return inertia('Modules/Home/Index',[
                'breakdown' => $this->breakdown()
            ]);
        }
    }

    public function lists($request){
        $current_year = $request->year; $years = []; 
        $programs = ['total','tax','discount'];
        $p = ['Total Earnings','Total Tax','Total Discount'];
        foreach($programs as $index => $program){
            $data = []; $year = $current_year - 20;
            for($year; $year <= $current_year; $year++){
                $years[] = $year;
                $data[] = Sale::whereYear('created_at',$year)->sum($program);
            }
            $arr[] = [
                'name' => $p[$index],
                'data' => $data  
            ];
        }
        return $y =[
            'categories' => $years,
            'programs' => ['Total Earnings','Total Tax','Total Discount'],
            'lists' => $arr
        ];
    }   

    public function breakdown(){
        $statuses = Dropdown::where('classification','Status')->where('type','Sale')->get();
        foreach($statuses as $status){
            $arr[] = [
                'name' => $status->name,
                'color' => $status->others,
                'count' => Sale::where('status_id',$status->id)->count()
            ];
        }

        $statuses2 = Dropdown::where('classification','Status')->where('type','Salelist')->get();
        foreach($statuses2 as $status){
            $arr2[] = [
                'name' => $status->name,
                'color' => $status->others,
                'count' => Salelist::where('status_id',$status->id)->count()
            ];
        }
        return [
            'sales' => $arr,
            'salelists' => $arr2
        ];
    }
}
