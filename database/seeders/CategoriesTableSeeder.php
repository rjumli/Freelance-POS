<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Appliances',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Automotive Accessories',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Electronics ',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Fashions',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Furniture',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Grocery',
            ),
        ));
        
        
    }
}