<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        function makeRole($name, $description){
            $role = new Role;
            $role->name = $name;
            $role->description = $description;
            $role->save();
        }

        /**
         * A student profile contains:
         * name
         * student number
         * program
         * department
         * table of deficiencies
         */
        makeRole('student', 'Can only view own profile.');

        /**
         * A staff can:
         * view any student's profile
         * Belongs to a department
         * view their own department's profile
         * add items from a student's table of deficiencies
         * edit/remove items from a student provided that an item 
         *     is filed unter said staff's department
         */
        makeRole('staff', 'Department staff.');

        /**
         * Has all the permissions of a staff
         * but has access to all departments
         * can add/move staff members to any department
         * 
         */
        makeRole('admin', 'Administrator');
    }
}
