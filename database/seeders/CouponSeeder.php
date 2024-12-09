<?php

// database/seeders/CouponSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run()
    {
        $coupons = [
            ['code' => 'ABBUD5', 'discount' => 5, 'valid_until' => now()->addMonths(3)],
            ['code' => 'BRUNA10', 'discount' => 10, 'valid_until' => now()->addMonths(3)],
            ['code' => 'BRUNO15', 'discount' => 15, 'valid_until' => now()->addMonths(3)],
            ['code' => 'PARRA20', 'discount' => 20, 'valid_until' => now()->addMonths(3)],
            ['code' => 'GGA25', 'discount' => 25, 'valid_until' => now()->addMonths(3)],
        ];

        foreach ($coupons as $data) {
            Coupon::firstOrCreate(['code' => $data['code']], $data);
        }
    }
}
