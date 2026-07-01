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

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::insert("
            INSERT INTO users(name, email, password, role, remember_token)
            VALUES(? , ? , ? , ? , ?)",
            ['Admin','admin@quick.online',Hash::make('123'),'admin', 'null']
        );
    }
}
