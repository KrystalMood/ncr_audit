<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstIsoStandardsSeeder extends Seeder
{
    public function run(): void
    {
        $gmenu = 'master';
        $dmenu = 'isostd';

        // CLEAN OLD CONFIG
        DB::table('sys_auth')->where('dmenu', $dmenu)->delete();
        DB::table('sys_table')->where('dmenu', $dmenu)->delete();
        DB::table('sys_dmenu')->where('dmenu', $dmenu)->delete();
        DB::table('sys_id')->where('dmenu', $dmenu)->delete();

        // REGISTER MENU
        DB::table('sys_dmenu')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '1',
            'name' => 'ISO Standards',
            'icon' => 'ni-book-bookmark',
            'url' => 'isostd',
            'tabel' => 'mst_iso_standards',
            'layout' => 'master',
            'sub' => 'isomgt',
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        // PRIMARY KEY
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '0',
            'field' => 'idstandards',
            'alias' => 'ID',
            'type' => 'hidden',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => '',
            'primary' => '1',
            'filter' => '0',
            'list' => '0',
            'show' => '0',
            'query' => '',
            'class' => '',
        ]);

        // CODE
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '1',
            'field' => 'code',
            'alias' => 'Kode ISO',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:20|unique:mst_iso_standards,code',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper',
        ]);

        // NAME
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '2',
            'field' => 'name',
            'alias' => 'Nama ISO (Standar)',
            'type' => 'string',
            'length' => '100',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:100',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // VERSION YEAR
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '3',
            'field' => 'version_year',
            'alias' => 'Tahun',
            'type' => 'string',
            'length' => '4',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:4',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // DESCRIPTION
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '4',
            'field' => 'description',
            'alias' => 'Deskripsi',
            'type' => 'text',
            'length' => '500',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:500',
            'primary' => '0',
            'filter' => '0',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // STATUS
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '5',
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

        // AUTHORIZATION
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