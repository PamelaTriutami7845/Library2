<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Faker\Factory as faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class peminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = faker::create();

        for ($i = 0; $i < 20; $i++) {
            $peminjaman = new Peminjaman();

            $peminjaman->member_id = $faker->member_id;
            $peminjaman->tgl_pinjam = $faker->tgl_pinjam;
            $peminjaman->akhir_tgl_pinjam = $faker->akhir_tgl_pinjam;

            $peminjaman->save();
        }
    }
}
