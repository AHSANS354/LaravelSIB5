<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use DB;

class staffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0;$i<=10;$i++){
            DB::table('staff')->insert([
                'nip'=>rand(),
                'name'=>uniqid('name_'),
                'gender'=>Arr::random(['Laki-laki', 'Perempuan']),
                'alamat'=>uniqid('alamat_'),
                'email'=>uniqid().'@gmail.com',
                'foto'=>uniqid('foto_'),
                'created_at'=>new \DateTime,
                'updated_at'=>null,
            ]);
        }
    }
}
