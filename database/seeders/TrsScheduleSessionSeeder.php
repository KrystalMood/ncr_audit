<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrsScheduleSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu = 'transc';
        $dmenu = 'schses';

        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => $dmenu,
            'gmenu' => $gmenu,
            'urut' => 2,
            'name' => 'Sesi Audit',
            'icon' => 'ni-time-alarm',
            'url' => 'schses',
            'tabel' => 'trs_schedule_session',
            'layout' => 'master',
            'sub' => null,
            'show' => '0',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        // ID Session
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 1,
            'field' => 'idsession',
            'alias' => 'ID Sesi',
            'type' => 'hidden',
            'length' => '10',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:10|unique:trs_schedule_session,idsession',
            'primary' => '1',
            'filter' => '0',
            'list' => '1',
            'show' => '0',
            'query' => '',
            'class' => '',
        ]);

        // Jadwal
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 2,
            'field' => 'idschedule',
            'alias' => 'Jadwal',
            'type' => 'enum',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select idschedule as value, concat(title,' (',year,')') as name from mst_schedule_header where isactive = '1'",
            'class' => 'custom-select',
        ]);

        // No Sesi
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 3,
            'field' => 'session_no',
            'alias' => 'No. Sesi',
            'type' => 'number',
            'length' => '3',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|integer|max:3',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Tanggal Sesi
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 4,
            'field' => 'session_date',
            'alias' => 'Tanggal Sesi',
            'type' => 'date',
            'length' => '10',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|date',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Waktu Mulai
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 5,
            'field' => 'start_time',
            'alias' => 'Waktu Mulai',
            'type' => 'string',
            'length' => '5',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:5',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Waktu Selesai
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 6,
            'field' => 'end_time',
            'alias' => 'Waktu Selesai',
            'type' => 'string',
            'length' => '5',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:5',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Department
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 7,
            'field' => 'iddepartments',
            'alias' => 'Departemen',
            'type' => 'enum',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select iddepartments as value, concat(prefix, ' - ', name) as name from mst_departments where isactive = '1'",
            'class' => 'custom-select',
        ]);

        // Area Name
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 8,
            'field' => 'area_name',
            'alias' => 'Area / Sub-area',
            'type' => 'string',
            'length' => '100',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:100',
            'primary' => '0',
            'filter' => '1',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // PIC Name
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 9,
            'field' => 'pic_name',
            'alias' => 'PIC (Opsional)',
            'type' => 'string',
            'length' => '100',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:100',
            'primary' => '0',
            'filter' => '0',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Session Type
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 10,
            'field' => 'session_type',
            'alias' => 'Tipe Sesi',
            'type' => 'enum',
            'length' => '20',
            'decimals' => '0',
            'default' => 'audit',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select 'audit' as value, 'Audit' as name union select 'opening_meeting', 'Opening Meeting' union select 'closing_meeting', 'Closing Meeting'",
            'class' => 'custom-select',
        ]);

        // Notes
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 11,
            'field' => 'notes',
            'alias' => 'Catatan',
            'type' => 'text',
            'length' => '500',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable',
            'primary' => '0',
            'filter' => '0',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Status
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => 12,
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
            'internal' => 'SES',
            'external' => '0',
            'urut' => 1,
            'length' => 7,
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
