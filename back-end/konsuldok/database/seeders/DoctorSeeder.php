<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use League\Csv\Reader;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFiles = [
            database_path('csv/dokterSpAnak.csv'),
            database_path('csv/dokterSpBedahUmum.csv'),
            database_path('csv/dokterGigi.csv'),
            database_path('csv/dokterGiziKlinik.csv'),
            database_path('csv/dokterKulitKelamin.csv'),
            database_path('csv/dokterSpAnestesiologi.csv'),
            database_path('csv/dokterSpJantungPembuluhDarah.csv'),
            database_path('csv/dokterSpJiwa.csv'),
            database_path('csv/dokterSpKandunganKebidanan.csv'),
            database_path('csv/dokterSpMata.csv'),
            database_path('csv/dokterSpOrtopediTraumatologi.csv'),
            database_path('csv/dokterSpParu.csv'),
            database_path('csv/dokterSpPatologiKlinik.csv'),
            database_path('csv/dokterSpPDKardiovaskular.csv'),
            database_path('csv/dokterSpPenyakitDalam.csv'),
            database_path('csv/dokterSpSaraf.csv'),
            database_path('csv/dokterSpTHT.csv'),
            database_path('csv/dokterSpUrologi.csv'),
            database_path('csv/dokterUmum.csv'),
            database_path('csv/ibuBidan.csv'),
        ];

        foreach ($csvFiles as $csvFile) {
            $csv = \League\Csv\Reader::createFromPath($csvFile, 'r');
            $csv->setHeaderOffset(0);

            foreach ($csv as $row) {
                DB::table('doctors')->insert([
                    'name'          => $row['name'],
                    'speciality'    => $row['speciality'],
                    'hospital'      => $row['hospital'],
                    'city'          => $row['city'],
                    'image'         => $row['img'] ?? 'profile-default-svgrepo-com.svg',
                    'category'      => $row['slug'] ?? null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }
}
