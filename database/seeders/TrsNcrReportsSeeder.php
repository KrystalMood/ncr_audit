<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrsNcrReportsSeeder extends Seeder
{
    public function run(): void
    {
        $gmenu = 'transc';
        $dmenu = 'trsncr';

        /*
        |--------------------------------------------------------------------------
        | REGISTER MENU
        |--------------------------------------------------------------------------
        */

        DB::table('sys_dmenu')->updateOrInsert(
    ['dmenu' => $dmenu],
    [
        'gmenu'       => $gmenu,
        'urut'        => 3,
        'name'        => 'NCR Report',
        'icon'        => 'ni ni-archive-2',
        'url'         => 'trsncr',
        'tabel'       => 'trs_ncr_reports',
        'layout'      => 'manual',   
        'sub'         => null,
        'show'        => '1',
        'js'          => '0',
        'isactive'    => '1',
        'user_create' => 'SYSTEM',
        'created_at'  => now(),
    ]
);

    

        /*
        |--------------------------------------------------------------------------
        | RESET FIELD CONFIG
        |--------------------------------------------------------------------------
        */

        DB::table('sys_table')->where('dmenu', $dmenu)->delete();

        /*
        |--------------------------------------------------------------------------
        | PRIMARY KEY
        |--------------------------------------------------------------------------
        */

        DB::table('sys_table')->insert([
            'gmenu'    => $gmenu,
            'dmenu'    => $dmenu,
            'urut'     => 1,
            'field'    => 'idncr',
            'alias'    => 'ID NCR',
            'type'     => 'hidden',
            'length'   => '10',
            'decimals' => '0',
            'default'  => '',
            'validate' => '',
            'primary'  => '1',
            'filter'   => '0',
            'list'     => '0',
            'show'     => '0',
            'query'    => '',
            'class'    => '',
        ]);

        /*
        |--------------------------------------------------------------------------
        | FIELD LIST
        |--------------------------------------------------------------------------
        */

        $fields = [

            [
                'urut'=>2,
                'field'=>'report_number',
                'alias'=>'No NCR',
                'type'=>'string',
                'length'=>'25',
                'validate'=>'required|max:25',
                'query'=>''
            ],

            [
                'urut'=>3,
                'field'=>'iddepartments',
                'alias'=>'Departemen',
                'type'=>'enum',
                'length'=>'6',
                'validate'=>'required|max:6',
                'query'=>"select iddepartments as value, concat(prefix,' - ',name) as name from mst_departments where isactive='1'"
            ],

            [
                'urut'=>4,
                'field'=>'lead_auditor_id',
                'alias'=>'Lead Auditor',
                'type'=>'enum',
                'length'=>'6',
                'validate'=>'required|max:6',
                'query'=>"select idauditor as value, name from mst_auditor where isactive='1'"
            ],

            [
                'urut'=>5,
                'field'=>'audit_date',
                'alias'=>'Tanggal Audit',
                'type'=>'date',
                'length'=>'10',
                'validate'=>'required|date',
                'query'=>''
            ],

            [
                'urut'=>6,
                'field'=>'status',
                'alias'=>'Status',
                'type'=>'enum',
                'length'=>'20',
                'default'=>'ENTRY',
                'validate'=>'',
                'query'=>"select 'ENTRY' as value,'ENTRY' as name 
                         union select 'ON_PROGRESS','ON_PROGRESS' 
                         union select 'IN_REVIEW','IN_REVIEW' 
                         union select 'CLOSED','CLOSED'"
            ],
        ];

        foreach ($fields as $f) {

            DB::table('sys_table')->insert([
                'gmenu'    => $gmenu,
                'dmenu'    => $dmenu,
                'urut'     => $f['urut'],
                'field'    => $f['field'],
                'alias'    => $f['alias'],
                'type'     => $f['type'],
                'length'   => $f['length'],
                'decimals' => '0',
                'default'  => $f['default'] ?? '',
                'validate' => $f['validate'],
                'primary'  => '0',
                'filter'   => '1',
                'list'     => '1',
                'show'     => '1',
                'query'    => $f['query'],
                'class'    => 'custom-select'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | AUTO NUMBER
        |--------------------------------------------------------------------------
        */

        DB::table('sys_id')->updateOrInsert(
            ['dmenu'=>$dmenu],
            [
                'source'=>'ext',
                'internal'=>'NCR',
                'external'=>'0',
                'urut'=>1,
                'length'=>7,
                'isactive'=>'1',
                'user_create'=>'SYSTEM',
                'created_at'=>now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | AUTH ROLE
        |--------------------------------------------------------------------------
        */

        DB::table('sys_auth')->updateOrInsert(
            [
                'idroles'=>'admins',
                'gmenu'=>$gmenu,
                'dmenu'=>$dmenu
            ],
            [
                'add'=>'1',
                'edit'=>'1',
                'delete'=>'1',
                'approval'=>'1',
                'value'=>'0',
                'print'=>'1',
                'excel'=>'1',
                'pdf'=>'1',
                'rules'=>'0',
                'isactive'=>'1',
                'user_create'=>'SYSTEM',
                'created_at'=>now(),
            ]
        );
    }
}