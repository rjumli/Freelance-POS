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
        ));
        
        
    }
}