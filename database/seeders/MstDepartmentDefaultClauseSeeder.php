<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstDepartmentDefaultClauseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu = 'master';
        $dmenu = 'dptcls';

        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => $dmenu,
            'gmenu' => $gmenu,
            'urut' => 3,
            'name' => 'Dept. Default Clause',
            'icon' => 'ni-map-big',
            'url' => 'dptcls',
            'tabel' => 'mst_department_default_clause',
            'layout' => 'master',
            'sub' => 'isomgt',
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        // ID
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '1',
            'field' => 'id',
            'alias' => 'ID',
            'type' => 'hidden',
            'length' => '10',
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

        // Departemen
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '2',
            'field' => 'iddepartments',
            'alias' => 'Department',
            'type' => 'enum',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select iddepartments as value, concat(prefix,' - ',name) as name from mst_departments where isactive = '1'",
            'class' => 'custom-select',
        ]);

        // Klausul ISO
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '3',
            'field' => 'idclauses',
            'alias' => 'Klausul ISO',
            'type' => 'enum',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select idclauses as value, concat(clause_number,' - ',clause_name) as name from mst_iso_clauses where isactive = '1'",
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
