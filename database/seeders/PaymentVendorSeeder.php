<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\PaymentVendor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentVendor::create([
            'name' => __('Direct Purchase'),
            'account_number' => 0,
            'description' => __('Direct Purchase'),
            'image' => asset('branding-assets/images/payment-vendor-default.png'),
            // 'created_at' => Carbon::now()->addSeconds(1),
            // 'updated_at' => Carbon::now()->addSeconds(1),
            'type' => 'hide'
        ]);

        // PaymentVendor::create([
        //     'name' => 'Dana',
        //     'account_number' => '1234',
        //     'description' => 'Virtual Account',
        //     'created_at' => Carbon::now()->addSeconds(2),
        //     'updated_at' => Carbon::now()->addSeconds(2),
        //     'type' => 'show'
        // ]);

        // PaymentVendor::create([
        //     'name' => 'OVO',
        //     'account_number' => '1234',
        //     'description' => 'Virtual Account',
        //     'created_at' => Carbon::now()->addSeconds(3),
        //     'updated_at' => Carbon::now()->addSeconds(3),
        //     'type' => 'show'
        // ]);
    }
}
