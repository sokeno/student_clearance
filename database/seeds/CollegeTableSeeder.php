<?php

use Illuminate\Database\Seeder;
use App\College;

class CollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function makeCollege($name, $short_name){
            $college = new College();
            $college->name = $name;
            $college->short_name = $short_name;
            $college->save();
        }

        makeCollege('College of Arts and Sciences', 'cas');
        makeCollege('College of Nursing', 'cn');
        makeCollege('College of Medicine', 'cm');
        makeCollege('College of Pharmacy', 'cp');
        makeCollege('College of Denstistry', 'cd');
        makeCollege('College of Public Health', 'cph');
    }
}
