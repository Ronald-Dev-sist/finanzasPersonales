<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'RONALD MAMANI LLUSCO',
            'email' => 'ronald@gmail.com',
            'password' => Hash::make('9962028')
        ]);

        User::create([
            'name' => 'JANNETH MAMANI SINKA',
            'email' => 'janneth@gmail.com',
            'password' => Hash::make('9962028')
        ]);

        User::create([
            'name' => 'SNDRA FULGUERA ACAPA',
            'email' => 'sandra@gmail.com',
            'password' => Hash::make('9962028')
        ]);


        Categoria::create(['nombre'=>'Alimentación', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Trasporte', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Salud', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Entretenimiento', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Sueldos', 'tipo'=>'ingreso']);
        Categoria::create(['nombre'=>'Inversiones', 'tipo'=>'ingreso']);
        Categoria::create(['nombre'=>'Otros', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Ahorros', 'tipo'=>'gasto']);
        Categoria::create(['nombre'=>'Otros Ingresos', 'tipo'=>'ingreso']);
        Categoria::create(['nombre'=>'Otros Gastos', 'tipo'=>'gasto']);
    }
}
