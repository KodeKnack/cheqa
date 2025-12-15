<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethods = [
            'Cash',
            'Credit Card',
            'Debit Card',
            'Bank Transfer',
            'PayPal',
            'Mobile Payment',
            'Check'
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create(['name' => $method]);
        }
    }
}