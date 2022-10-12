<?php

namespace Database\Seeders;

use App\Models\V1\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear DB
        DB:: table(app(User::class)->getTable())->truncate();
        // Insert default user to DB
        DB::table('users')->insert([
            [
                'name' => 'User A',
                'email' => 'usera@app.com',
                'password' => Hash::make('12345678'),
                'default_currency' => User::CURRENCY_USD,
            ],
            [
                'name' => 'User B',
                'email' => 'userb@app.com',
                'password' => Hash::make('12345678'),
                'default_currency' => User::CURRENCY_EUR,
            ]
        ]);
    }
}
