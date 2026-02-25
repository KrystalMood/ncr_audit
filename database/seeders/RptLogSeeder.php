<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RptLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu =  'report';
        $dmenu = 'rptlog';

        DB::table('sys_dmenu')->updateOrInsert(
            ['dmenu' => $dmenu],
            [
                'dmenu' => $dmenu,
                'gmenu' => $gmenu,
                'urut' => 5,
                'name' => 'Report Log',
                'icon' => 'ni-single-copy-04',
                'url' => 'rptlog',
                'tabel' => 'trs_ncr_reports',
                'layout' => 'manual',
                'sub' => null,
                'show' => '1',
                'js' => '0',
                'isactive' => '1',
                'user_create' => 'SYSTEM',
                'created_at'  => now(),
            ]
        );

        DB::table('sys_auth')->insertOrIgnore([
            'idroles' => 'admins',
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'add'        => '0',
            'edit'       => '1',
            'delete'     => '0',
            'approval'   => '1',
            'value'      => '0',
            'print'      => '1',
            'excel'      => '1',
            'pdf'        => '1',
            'rules'      => '0',
            'isactive'   => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);
    }
}
