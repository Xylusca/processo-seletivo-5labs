<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nivel;
use Carbon\Carbon;


class NiveisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $niveis = [
            ['id' => '1', 'name' => 'Comprador', 'created_at' => $now, 'updated_at' => $now],
            ['id' => '2', 'name' => 'Vendedor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => '3', 'name' => 'Administrador', 'created_at' => $now, 'updated_at' => $now],
        ];

        Nivel::insert($niveis);
    }
}
