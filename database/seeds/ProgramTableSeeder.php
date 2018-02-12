<?php

use App\Department;
use App\Program;
use Illuminate\Database\Seeder;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        function makeProgram($name, $short_name, $department){
            $program = new Program();
            $program->name = $name;
            $program->short_name = $short_name;
            $program->department_id = Department::whereShortName($department)->first()->id;
            $program->save();
        }

        makeProgram('BS Computer Science', 'bscs', 'dpsm');
        makeProgram('BS Biology', 'bsb', 'db');
        makeProgram('MS Health Informatics', 'mshi', 'casgrad');
        makeProgram('BS Biochemistry', 'bsbc', 'dpsm');
        makeProgram('BS Pharmacy', 'bsp', 'dp');
        makeProgram('BS Industrial Pharmacy', 'bsip','dip');
        makeProgram('INTARMED','imed', 'dim');
        makeProgram('BS Nursing', 'bsn', 'dn');
        makeProgram('BA Political Science', 'baps', 'dss');
        makeProgram('BS Public Health', 'bsph', 'dph');
        makeProgram('BA Organizational Communications', 'baoc', 'dac');
        makeProgram('D Dentistry', 'dd', 'dd');
    }
}
