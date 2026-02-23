<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu = 'master';
        $dmenu = 'categr';

        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => $dmenu,
            'gmenu' => $gmenu,
            'urut' => 1,
            'name' => 'Kategori NCR',
            'icon' => 'ni-tag',
            'url' => 'categr',
            'tabel' => 'mst_categories',
            'layout' => 'master',
            'sub' => 'ncrmgt',
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        // ID Categories
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '1',
            'field' => 'idcategories',
            'alias' => 'ID Kategori',
            'type' => 'hidden',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:mst_categories,idcategories',
            'primary' => '1',
            'filter' => '0',
            'list' => '1',
            'show' => '0',
            'query' => '',
            'class' => '',
        ]);

        // Kode
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '2',
            'field' => 'code',
            'alias' => 'Kode',
            'type' => 'string',
            'length' => '10',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:10|unique:mst_categories,code',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Name
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '3',
            'field' => 'name',
            'alias' => 'Nama Kategori',
            'type' => 'string',
            'length' => '50',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:50',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Severity Level
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '4',
            'field' => 'severity_level',
            'alias' => 'Level Resiko',
            'type' => 'number',
            'length' => '1',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|integer|between:1,3',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Description
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '5',
            'field' => 'description',
            'alias' => 'Deskripsi',
            'type' => 'text',
            'length' => '500',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:500',
            'primary' => '0',
            'filter' => '1',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Warna
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '6',
            'field' => 'color_hex',
            'alias' => 'Warna (Hex)',
            'type' => 'string',
            'length' => '7',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:7',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Status
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '7',
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
            'internal' => 'CAT',
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
