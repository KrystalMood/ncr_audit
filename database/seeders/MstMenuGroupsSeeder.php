<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MstMenuGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $master = 'master';
        $transc = 'transc';

        // 1. Referral Data
        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => 'refmgt',
            'gmenu' => $master,
            'urut' => 10,
            'name' => 'Referral Data',
            'icon' => 'ni-building',
            'url' => '#',
            'tabel' => '',
            'layout' => null,
            'sub' => null,
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        // 2. ISO Management
        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => 'isomgt',
            'gmenu' => $master,
            'urut' => 20,
            'name' => 'ISO Management',
            'icon' => 'ni-book-bookmark',
            'url' => '#',
            'tabel' => '',
            'layout' => null,
            'sub' => null,
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        // 3. NCR Master
        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => 'ncrmgt',
            'gmenu' => $master,
            'urut' => 30,
            'name' => 'NCR Master',
            'icon' => 'ni-settings',
            'url' => '#',
            'tabel' => '',
            'layout' => null,
            'sub' => null,
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);

        // 4. Audit Schedule
        DB::table('sys_dmenu')->insertOrIgnore([
            'dmenu' => 'schmgt',
            'gmenu' => $transc,
            'urut' => 40,
            'name' => 'Audit Schedule',
            'icon' => 'ni-calendar-grid-58',
            'url' => '#',
            'tabel' => '',
            'layout' => null,
            'sub' => null,
            'show' => '1',
            'js' => '0',
            'isactive' => '1',
            'user_create' => 'SYSTEM',
            'created_at' => now(),
        ]);


        // 5. Auth for Master Menus
        $list_menu_master = [
            'refmgt',
            'isomgt',
            'ncrmgt',
        ];

        foreach ($list_menu_master as $menu) {
            DB::table('sys_auth')->insert([
                'idroles' => 'admins',
                'gmenu' => $master,
                'dmenu' => $menu,
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

        // 6. Auth Transaction Menu
        DB::table('sys_auth')->insert([
            'idroles' => 'admins',
            'gmenu' => $transc,
            'dmenu' => 'schmgt',
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
