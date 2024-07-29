<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'nombreApellido' => 'Cliente Default',
            'ciudad' => 'Matagalpa',
            'direccion' => 'Matagalpa',
            'telefono' => '00000000'
        ]);
    }
}
