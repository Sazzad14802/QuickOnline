<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::statement("DELETE FROM packages");
        DB::statement("DELETE FROM users");
        DB::statement("DELETE FROM subscriptions");
        DB::insert("INSERT INTO users(name, email, password, role, remember_token) VALUES('Admin','admin@quick.online',?,'admin', null)", [Hash::make('123')]);
        DB::insert("INSERT INTO users(name, email, password, role, remember_token) VALUES('Alif','alif@gmail.com',?,'customer', null)", [Hash::make('123')]);
        $packages = [
            ['Starter 20', 20, 10, 'fiber', 'shared', 800],
            ['Home 50', 50, 25, 'fiber', 'shared', 1200],
            ['Home 100', 100, 50, 'fiber', 'shared', 1800],
            ['Gamer 150', 150, 100, 'fiber', 'shared', 2500],
            ['Power 300', 300, 200, 'fiber', 'shared', 3500],
            ['Business 100', 100, 100, 'fiber', 'dedicated', 4000],
            ['Business 300', 300, 300, 'fiber', 'dedicated', 6500],
            ['Enterprise 500', 500, 500, 'fiber', 'dedicated', 10000],
        ];

        foreach ($packages as $package) {
            DB::insert("INSERT INTO packages (package_name, download_speed, upload_speed, connection_type, ip_type, price) VALUES (?, ?, ?, ?, ?, ?)", $package);
        }
        
        DB::insert("INSERT INTO subscriptions (user_id, package_id, status) VALUES (2, 1, 'active')");
    }
}
