<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstScheduleHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gmenu = 'transc';
        $dmenu = 'schdhr';

        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => $dmenu,
            'gmenu' => $gmenu,
            'urut' => 1,
            'name' => 'Penjadwalan',
            'icon' => 'ni-calendar-grid-58',
            'url' => 'schdhr',
            'tabel' => 'mst_schedule_header',
            'layout' => 'manual',
            'sub' => null,
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        // ID Jadwal
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '1',
            'field' => 'idschedule',
            'alias' => 'ID Jadwal',
            'type' => 'hidden',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:mst_schedule_header,idschedule',
            'primary' => '1',
            'filter' => '0',
            'list' => '1',
            'show' => '0',
            'query' => '',
            'class' => '',
        ]);

        // Judul
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '2',
            'field' => 'title',
            'alias' => 'Judul',
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

        // Tahun
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '3',
            'field' => 'year',
            'alias' => 'Tahun',
            'type' => 'string',
            'length' => '4',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:4',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // Tipe Audit
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '4',
            'field' => 'type',
            'alias' => 'Tipe Audit',
            'type' => 'enum',
            'length' => '10',
            'decimals' => '0',
            'default' => 'internal',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select 'internal' as value, 'Internal' as name union select 'external', 'External'",
            'class' => 'custom-select',
        ]);

        // Tanggal Mulai
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '5',
            'field' => 'start_date',
            'alias' => 'Tanggal Mulai',
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

        // Tanggal Selesai
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '6',
            'field' => 'end_date',
            'alias' => 'Tanggal Selesai',
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

        // Deadline NCR
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '7',
            'field' => 'ncr_deadline',
            'alias' => 'Deadline NCR (Opsional)',
            'type' => 'date',
            'length' => '10',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|date',
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
            'field' => 'status',
            'alias' => 'Status Jadwal',
            'type' => 'enum',
            'length' => '10',
            'decimals' => '0',
            'default' => 'draft',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select 'draft' as value, 'Draft' as name union select 'active', 'Active' union select 'completed', 'Completed' union select 'cancelled', 'Cancelled'",
            'class' => 'custom-select',
        ]);

        // Notes
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '9',
            'field' => 'notes',
            'alias' => 'Catatan',
            'type' => 'text',
            'length' => '500',
            'decimals' => '0',
            'default' => '',
            'validate' => 'nullable|max:500',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => '',
        ]);

        // isactive
        DB::table('sys_table')->insert([
            'gmenu' => $gmenu,
            'dmenu' => $dmenu,
            'urut' => '10',
            'field' => 'isactive',
            'alias' => 'Status',
            'type' => 'enum',
            'length' => '1',
            'decimals' => '0',
            'default' => '1',
            'validate' => 'required',
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
            'internal' => 'SCH',
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
            'created_at' => now(),
        ]);
    }
}
