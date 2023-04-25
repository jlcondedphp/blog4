<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
        public function run()
        {
            $role = new Role();
            $role->name = 'admin';
            $role->description = 'Administrator';
            $role->save();
            $role = new Role();
            $role->name = 'user';
            $role->description = 'User';
            $role->save();
        }
}
