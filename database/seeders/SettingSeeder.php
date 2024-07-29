<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'nombre' => 'Empresa SA',
            'direccion' => 'Matagalpa',
            'ruc' => '444-222222-0005Q',
            'telefono' => '86316947',
            'email' => 'correo@correo.test',
            'propietario' => 'propietario(a)',
            'consecutivo' => '0'
        ]);
    }
}
