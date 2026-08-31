<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashierUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'cashier@baharitz.com'],
            [
                'name' => 'Bahari Cashier',
                'username' => 'cashier',
                'email' => 'cashier@baharitz.com',
                'password' => bcrypt('password'),
                'role' => 'cashier'
            ]
        );
    }
}
