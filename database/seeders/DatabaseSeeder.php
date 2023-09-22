<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('type_cicos')->insert([
            [
                'id'=>1,
                'name'=>'Dentro do Recinto',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Fora do Recinto',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
           
        ]);

        DB::table('roles')->insert([
            [
                'id'=>1,
                'name'=>'Admin',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Company',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>3,
                'name'=>'Supervisor',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>4,
                'name'=>'GateOperator',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
           
        ]);

        DB::table('type_operations')->insert([
            [
                'id'=>1,
                'name'=>'Carga',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>2,
                'name'=>'Descarga',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'id'=>3,
                'name'=>'Ensacamento',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
           
        ]);

        DB::table('users')->insert([
            [
                'id'=>1,
                'name'=>'Administrator',
                'username'=>'Administrator',
                'role_id'=>1,
                'email'=>'admin@codelab.com',
                'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
         
        ]);
    }
}
