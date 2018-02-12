<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CollegeTableSeeder::class);
         $this->call(RoleTableSeeder::class);
         $this->call(DepartmentTableSeeder::class);
         $this->call(ProgramTableSeeder::class);
         $this->call(StudentTableSeeder::class);
         $this->call(StaffTableSeeder::class);
         $this->call(DeficiencyTableSeeder::class);
    }
}
