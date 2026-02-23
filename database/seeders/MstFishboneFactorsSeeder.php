<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstFishboneFactorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu = 'master';
        $dmenu = 'fishbn';

        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => $dmenu,
            'gmenu' => $gmenu,
            'urut' => 2,
            'name' => 'Fishbone',
            'icon' => 'ni-compass-04',
            'url' => 'fishbn',
            'tabel' => 'mst_fishbone_factors',
            'layout' => 'master',
            'sub' => 'ncrmgt',
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),

        ]);

        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        // ID Fishbone
        DB::table('sys_table')->insert([
            'dmenu' => $dmenu,
            'gmenu' => $gmenu,
            'urut' => '1',
            'field' => 'idfishbone',
            'alias' => 'ID Fishbone',
            'type' => 'hidden',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:mst_fishbone_factors,idfishbone',
            'primary' => '1',
            'filter' => '0',
            'list' => '1',
            'show' => '0',
            'query' => '',
            'class' => '',
        ]);

        // Code
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '2',
            'field' => 'code',
            'alias' => 'Kode',
            'type' => 'string',
            'length' => '5',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:5|unique:mst_fishbone_factors,code',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper',
        ]);

        // Nama (English)
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '3',
            'field' => 'name',
            'alias' => 'Nama (EN)',
            'type' => 'string',
            'length' => '50',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:50',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Nama (Indonesia)
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '4',
            'field' => 'name_id',
            'alias' => 'Nama (ID)',
            'type' => 'string',
            'length' => '50',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:50',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Contoh Temuan
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '5',
            'field' => 'examples',
            'alias' => 'Contoh',
            'type' => 'text',
            'length' => '500',
            'decimals' => '0',
            'default' => '',
            'validate' => 'max:500',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Ikon
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '6',
            'field' => 'icon',
            'alias' => 'Ikon',
            'type' => 'string',
            'length' => '50',
            'decimals' => '0',
            'default' => '',
            'validate' => 'max:50',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Urutan Tampil
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '7',
            'field' => 'display_order',
            'alias' => 'Urutan Tampil',
            'type' => 'number',
            'length' => '2',
            'decimals' => '0',
            'default' => '0',
            'validate' => 'nullable|integer',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'text-right',
        ]);

        // Status
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '8',
            'field' => 'isactive',
            'alias' => 'Status',
            'type' => 'enum',
            'length' => '1',
            'decimals' => '0',
            'default' => '1',
            'validate' => '',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '0',
            'query' => "select value, name from sys_enum where idenum = 'isactive' and isactive = '1'",
            'class' => 'custom-select',
        ]);

        DB::table('sys_id')->insertOrIgnore([
            'dmenu' => $dmenu,
            'source' => 'ext',
            'internal' => 'FSH',
            'external' => '0',
            'urut' => 1,
            'length' => 3,
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        DB::table('sys_auth')->insertOrIgnore([
            'idroles' => 'admins',
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'add' => '1',
            'edit' => '1',
            'delete' => '1',
            'approval' => '0',
            'value' => '0',
            'print' => '1',
            'excel' => '1',
            'pdf' => '1',
            'rules' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);
    }
}
