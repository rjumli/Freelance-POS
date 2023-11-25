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
                'type' => 'Product',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Automotive Accessories',
                'type' => 'Product',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Electronics ',
                'type' => 'Product',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Fashions',
                'type' => 'Product',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Furniture',
                'type' => 'Product',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Grocery',
                'type' => 'Product',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Utensils
',
                'type' => 'Package
',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Construction
',
                'type' => 'Package
',
            ),
        ));
        
        
    }
}