<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i=0;
        while ($i<365){
            DB::table('apartament_prices')->insert([
                'apartament_id' => 7,
                'currency_id' => 1,
                'price_value' => 149.00,
                'date_of_price' => date("Y-m-d", time() + 86400*$i),
                'price_discount' => 0,
            ]);

            $i++;
        }
    }
}
