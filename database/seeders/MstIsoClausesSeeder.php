<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstIsoClausesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu = 'master';
        $dmenu = 'isocls';

     DB::table('sys_dmenu')->updateOrInsert(
    ['dmenu' => $dmenu],
        [
            'gmenu' => $gmenu,
            'urut' => 2,
            'name' => 'ISO Clauses',
            'icon' => 'ni-bullet-list-67',
            'url' => 'isocls',
            'tabel' => 'mst_iso_clauses',
            'layout' => 'manual', 
            'sub' => 'isomgt',
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]
    );
        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        // ID Clauses
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '1',
            'field' => 'idclauses',
            'alias' => 'ID Clause',
            'type' => 'hidden',
            'length' => '6',
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

        // Standar ISO
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '2',
            'field' => 'idstandards',
            'alias' => 'Standar ISO',
            'type' => 'enum',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|integer', 
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select idstandards as value, concat(code,' - ',name) as name from mst_iso_standards where isactive = '1'",
            'class' => 'custom-select',

        ]);

        // No Klausul
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '3',
            'field' => 'clause_number',
            'alias' => 'No. Klausul',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:20',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Nama Klausul
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '4',
            'field' => 'clause_name',
            'alias' => 'Nama Klausul',
            'type' => 'string',
            'length' => '200',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:200',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Deskripsi
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

        // Parent ID
       DB::table('sys_table')->updateOrInsert(
    [
        'gmenu' => $gmenu,
        'dmenu' => $dmenu,
        'urut'  => 6,
    ],
    [
        'field' => 'parent_id',
        'alias' => 'Parent Klausa',
        'type' => 'enum',
        'length' => '11',
        'decimals' => '0',
        'default' => '',
        'validate' => 'nullable|integer',
        'primary' => '0',
        'filter' => '1',
        'list' => '0',
        'show' => '1',
        'query' => "select idclauses as value, concat(clause_number,' - ',clause_name) as name from mst_iso_clauses where isactive = '1'",
        'class' => 'custom-select',
    ]
);

        // Level
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '7',
            'field' => 'level',
            'alias' => 'Level',
            'type' => 'number',
            'length' => '1',
            'decimals' => '0',
            'default' => '1',
            'validate' => 'nullable|integer',
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
