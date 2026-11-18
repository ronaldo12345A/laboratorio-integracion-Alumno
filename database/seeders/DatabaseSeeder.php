<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pedido;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

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

        $ana  = User::factory()->create(['email' => 'ana@test.pe',  'password' => Hash::make('secreto123')]);
        $beto = User::factory()->create(['email' => 'beto@test.pe', 'password' => Hash::make('secreto123')]);
        Pedido::create(['user_id' => $ana->id,  'descripcion' => 'Pedido de Ana',  'total' => 50]);
        Pedido::create(['user_id' => $beto->id, 'descripcion' => 'Pedido de Beto', 'total' => 80]);
    }
}