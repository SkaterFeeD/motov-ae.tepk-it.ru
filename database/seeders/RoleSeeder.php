<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
               'name' => 'Пользователь'
            ],
            [
                'name' => 'Менеджер'
            ],
            [
                'name' => 'Администратор'
            ],
        ]);
    }
}
