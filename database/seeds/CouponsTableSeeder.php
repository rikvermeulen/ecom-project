<?php
use App\Coupon;
use Illuminate\Database\Seeder;
class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'money', /*code coupon*/
            'type' => 'fixed', /*type korting*/
            'value' => 3000, /*aantal bedrag in centen*/
        ]);
        Coupon::create([
            'code' => 'percent', /*code coupon*/
            'type' => 'percent', /*type korting*/
            'percent_off' => 50, /*aantal percentage*/
        ]);
    }
}