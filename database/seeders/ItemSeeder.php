<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Master\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Units List
        // "Pc/s",
        // "Box/es",
        // "Meter/s",
        // "Lot/s",
        // "Unit/s",
        // "Kg/s",
        // "Bag/s,",
        // "Pack/s"

        Item::create([
            'item_code' => 'Cement',
            'item_name' => 'Cement',
            'description' => null,
            'unit' => 'PC/S',
            'minimum_stock_qty' => 200,
            'group' => null,
            'notes' => null
        ]);

        Item::create([
            'item_code' => 'DRB 12mm',
            'item_name' => 'Deformed Steel Bar 12mm',
            'description' => null,
            'unit' => 'PC/S',
            'minimum_stock_qty' => 100,
            'group' => null,
            'notes' => null
        ]);

        Item::create([
            'item_code' => 'DRB 10mm',
            'item_name' => 'Deformed Steel Bar 10mm',
            'description' => null,
            'unit' => 'PC/S',
            'minimum_stock_qty' => 100,
            'group' => null,
            'notes' => null
        ]);

        Item::create([
            'item_code' => 'DRB 9mm',
            'item_name' => 'Deformed Steel Bar 9mm',
            'description' => null,
            'unit' => 'PC/S',
            'minimum_stock_qty' => 100,
            'group' => null,
            'notes' => null
        ]);

        Item::create([
            'item_code' => 'CHB #5',
            'item_name' => 'Concrete Hollow Blocks #5',
            'description' => null,
            'unit' => 'PC/S',
            'minimum_stock_qty' => 300,
            'group' => null,
            'notes' => null
        ]);

        Item::create([
            'item_code' => 'CHB #4',
            'item_name' => 'Concrete Hollow Blocks #4',
            'description' => null,
            'unit' => 'PC/S',
            'minimum_stock_qty' => 300,
            'group' => null,
            'notes' => null
        ]);

        Item::create([
            'item_code' => 'GI Wire #16',
            'item_name' => 'Galvanized Iron Wire #16',
            'description' => null,
            'unit' => 'KG/S',
            'minimum_stock_qty' => 100,
            'group' => null,
            'notes' => null
        ]);

        

        
    }
}
