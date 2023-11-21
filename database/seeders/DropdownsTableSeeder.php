<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dropdowns')->delete();
        
        \DB::table('dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'classification' => 'n/a',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Fixed Price',
                'classification' => 'Pricing',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'By unit',
                'classification' => 'Pricing',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Pending',
                'classification' => 'Order',
                'type' => 'n/a',
                'color' => 'bg-warning',
                'others' => 'n/a',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Completed',
                'classification' => 'Order',
                'type' => 'n/a',
                'color' => 'bg-success',
                'others' => 'n/a',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cancelled',
                'classification' => 'Order',
                'type' => 'n/a',
                'color' => 'bg-danger',
                'others' => 'n/a',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Pending',
                'classification' => 'Orderlist',
                'type' => 'n/a',
                'color' => 'bg-warning',
                'others' => 'n/a',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Received',
                'classification' => 'Orderlist',
                'type' => 'n/a',
                'color' => 'bg-success',
                'others' => 'n/a',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Not Available',
                'classification' => 'Orderlist',
                'type' => 'n/a',
                'color' => 'bg-dark',
                'others' => 'n/a',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'Cancelled',
                'classification' => 'Orderlist',
                'type' => 'n/a',
                'color' => 'bg-danger',
                'others' => 'n/a',
            ),
        ));
        
        
    }
}