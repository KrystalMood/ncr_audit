<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstAuditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu = 'master';
        $dmenu = 'auditr';

        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => $dmenu,
            'gmenu' => $gmenu,
            'urut' => 2,
            'name' => 'Auditor',
            'icon' => 'ni-single-02',
            'url' => 'auditr',
            'tabel' => 'mst_auditor',
            'layout' => 'master',
            'sub' => 'refmgt',
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        // ID Auditor
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '1',
            'field' => 'idauditor',
            'alias' => 'ID Auditor',
            'type' => 'hidden',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:mst_auditor,idauditor',
            'primary' => '1',
            'filter' => '0',
            'list' => '1',
            'show' => '0',
            'query' => '',
            'class' => '',
        ]);

        // User Account
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '2',
            'field' => 'user_id',
            'alias' => 'User Account',
            'type' => 'enum',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "SELECT id, concat(username, ' - ', email) as name FROM users WHERE isactive='1' ORDER BY username ASC",
            'class' => 'custom-select',
        ]);

        // NIP / Employee ID
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '3',
            'field' => 'employee_id',
            'alias' => 'NIP / Employee ID',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:20|unique:mst_auditor,employee_id',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Departemen Asal
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '4',
            'field' => 'iddepartments',
            'alias' => 'Departemen Asal',
            'type' => 'enum',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "SELECT iddepartments, concat(prefix, ' - ', name) as name FROM mst_departments WHERE isactive='1' ORDER BY name ASC",
            'class' => 'custom-select',
        ]);

        // Nama Lengkap
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '5',
            'field' => 'name',
            'alias' => 'Nama Lengkap',
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

        // Email
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '6',
            'field' => 'email',
            'alias' => 'Email',
            'type' => 'email',
            'length' => '255',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|email|max:255',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // No. Telepon
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '7',
            'field' => 'phone',
            'alias' => 'No. Telepon',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:20',
            'primary' => '0',
            'filter' => '0',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Jabatan
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '8',
            'field' => 'jabatan',
            'alias' => 'Jabatan',
            'type' => 'string',
            'length' => '100',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:100',
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
            'urut' => '9',
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
        ]);

        DB::table('sys_id')->insertOrIgnore([
            'dmenu' => $dmenu,
            'source' => 'ext',
            'internal' => 'ADT',
            'external' => '0',
            'urut' => 1,
            'length' => 3,
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now()
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
            'created_at' => now()
        ]);
    }
}
