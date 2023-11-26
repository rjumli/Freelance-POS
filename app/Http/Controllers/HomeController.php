<?php

namespace App\Http\Controllers;

use App\Models\Sale;
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
            return inertia('Modules/Home/Index');
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
}
