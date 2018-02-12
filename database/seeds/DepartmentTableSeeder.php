<?php

use App\College;
use App\Department;
use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        function makeDepartment($name, $short_name, $college){
            $dept = new Department();
            $dept->name = $name;
            $dept->short_name = $short_name;
            $dept->college_id = College::whereShortName($college)->first()->id;
            $dept->save();
        }

     	makeDepartment(
            'Department of Physical Sciences and Mathematics',
            'dpsm',
            'cas'
        );

        makeDepartment(
            'Department of Social Sciences',
            'dss',
            'cas'
        );

     	makeDepartment(
            'Department of Biology',
            'db',
            'cas'
        );

        makeDepartment(
            'Department of Arts and Communications',
            'dac',
            'cas'
        );

        makeDepartment(
            'CAS Graduate Studies',
            'casgrad',
            'cas'
        );

     	makeDepartment(
            'Department of Nursing',
            'dn',
            'cn'
        );

     	makeDepartment(
            'CN Graduate Studies',
            'cngrad',
            'cn'
        );

        makeDepartment(
            'Department of Internal Medicine',
            'dim',
            'cm'
        );

        makeDepartment(
            'Department of Microbiology',
            'dmb',
            'cph'
        );

        makeDepartment(
            'Department of Pharmacy',
            'dp',
            'cp'
        );
        
        makeDepartment(
            'Department of Industrial Pharmacy',
            'dip',
            'cp'
        );

        makeDepartment(
            'Department of Public Health',
            'dph',
            'cph'
        );

        makeDepartment(
            'Department of Denstistry',
            'dd',
            'cd'
        );

        

    }
}
