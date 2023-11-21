<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'PRDCT20231121-0001',
                'name' => 'Watch',
                'brand' => 'Casio',
                'stock' => 0,
                'reorder' => 0,
                'information' => 'Bluetooth Connectivity, DTS Audio, HDR, Web Browser, Wireless Connectivity',
                'price' => '1000.00',
                'pricing_id' => 2,
                'size' => NULL,
                'unit_id' => 13,
                'category_id' => 3,
                'created_at' => '2023-11-21 15:58:35',
                'updated_at' => '2023-11-21 15:58:35',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'PRDCT20231121-0002',
                'name' => 'LG UHD UR75 43-70 Inch 4K Smart TV',
                'brand' => 'Lg',
                'stock' => 0,
                'reorder' => 0,
                'information' => '● HGIG/ ALLM
● AI Sound 
● 4K Upscaling
● AI Acoustic Tuning',
                'price' => '10000.00',
                'pricing_id' => 2,
                'size' => NULL,
                'unit_id' => 13,
                'category_id' => 1,
                'created_at' => '2023-11-21 15:59:12',
                'updated_at' => '2023-11-21 15:59:12',
            ),
        ));
        
        
    }
}