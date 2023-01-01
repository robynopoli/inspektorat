<?php

namespace Database\Seeders;

use App\Models\AreaIntervensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class McpKpkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areaInventervensi = [
            'Perencanaan dan Penganggaran APBD',
            'Pengadaan Barang dan Jasa',
            'Perizinan',
            'Pengawasan APIP',
            'Manajemen ASN',
            'Optimalisasi Pajak Daerah',
            'Pengelolaan Barang Milik Daerah',
        ];
        foreach($areaInventervensi as $i){
            AreaIntervensi::create(['keterangan' => $i]);
        }
    }
}
