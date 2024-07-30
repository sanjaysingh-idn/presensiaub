<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Makul;
use App\Models\Jurusan;
use App\Models\Fakultas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'          => 'Catur Adi Pamungkas',
            'nip'           => '202407061',
            'jabatan'       => 'Admin',
            'email'         => 'admin@gmail.com',
            'role'          => 'admin',
            'kontak'        => '08123456789',
            'alamat'        => 'Jl. Mangesti Raya No. 87, Gentan, Baki, Sukoharjo',
            'password'      => bcrypt('password'),
        ]);

        User::create([
            'name'          => 'Catur Adi Pamungkas',
            'nim'           => '2207101075',
            'email'         => 'caturadi@gmail.com',
            'role'          => 'mahasiswa',
            'kontak'        => '08123456789',
            'alamat'        => 'Jl. Apel III No. 12, Jajar, Laweyan, Surakarta',
            'password'      => bcrypt('password'),
        ]);

        // DOSEN
        User::create([
            'name'          => 'Agus Kristianto, S.Kom, M.Kom',
            'nip'           => '11223344',
            'email'         => 'agusk@gmail.com',
            'role'          => 'dosen',
            'jabatan'       => 'Dosen',
            'kontak'        => '08123456789',
            'jenis_kelamin' => 'Laki-Laki',
            'alamat'        => '-',
            'password'      => bcrypt('password'),
        ]);

        User::create([
            'name'          => 'Hartati Dyah W, S.E, M.M',
            'nip'           => '11223345',
            'email'         => 'hartatiw@gmail.com',
            'role'          => 'dosen',
            'jabatan'       => 'Dosen',
            'kontak'        => '08123456789',
            'jenis_kelamin' => 'Wanita',
            'alamat'        => '-',
            'password'      => bcrypt('password'),
        ]);

        // SEED FAKULTAS
        $fakultas = [
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Teknik',
            'Fakultas Ilmu Komputer',
        ];

        foreach ($fakultas as $fak) {
            Fakultas::create([
                'nama_fakultas' => $fak,
            ]);
        }

        // Data jurusan dengan nama fakultas terkait
        $jurusan = [
            ['nama_jurusan' => 'Sistem Informasi', 'nama_fakultas' => 'Fakultas Ilmu Komputer'],
            ['nama_jurusan' => 'Teknik Sipil', 'nama_fakultas' => 'Fakultas Teknik'],
            ['nama_jurusan' => 'Teknik Mesin', 'nama_fakultas' => 'Fakultas Teknik'],
        ];

        foreach ($jurusan as $jur) {
            // Cari atau buat fakultas berdasarkan nama_fakultas
            $fakultas = Fakultas::firstOrCreate(['nama_fakultas' => $jur['nama_fakultas']]);

            // Buat jurusan dengan fakultas yang ditemukan atau baru dibuat
            Jurusan::create([
                'nama_jurusan' => $jur['nama_jurusan'],
                'nama_fakultas' => $jur['nama_fakultas'],
            ]);
        }

        $makul = [
            [
                'kode_makul'    => '51609',
                'nama_makul'    => 'Pemrograman Basis Data III',
                'prodi'         => 'Sistem Informasi',
                'kelas'         => 'A1',
                'nama_dosen'    => 'Agus Kristianto, S.Kom, M.Kom',
                'ruangan'       => 'Lab 1',
            ],
            [
                'kode_makul'    => '51410',
                'nama_makul'    => 'Analisa Proses Bisnis',
                'prodi'         => 'Sistem Informasi',
                'kelas'         => 'A1',
                'nama_dosen'    => 'Hartati Dyah W, S.E, M.M',
                'ruangan'       => 'Kelas C',
            ],
        ];

        foreach ($makul as $mak) {
            // Buat jurusan dengan fakultas yang ditemukan atau baru dibuat
            Makul::create(
                [
                    'kode_makul'    => $mak['kode_makul'],
                    'nama_makul'    => $mak['nama_makul'],
                    'prodi'         => $mak['prodi'],
                    'kelas'         => $mak['kelas'],
                    'nama_dosen'    => $mak['nama_dosen'],
                    'ruangan'       => $mak['ruangan'],
                ]
            );
        }
    }
}
