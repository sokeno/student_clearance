<?php

use App\Deficiency;
use App\Staff;
use App\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class DeficiencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        function makeDeficiency($student_id, $title, $note, $staff_id){
            $startDate = Carbon::now();
            $endDate = Carbon::now()->subYears(10);

        	$def = new Deficiency;
        	$def->student_id = $student_id;
        	$def->title = $title;
        	$def->note = $note;
        	$def->staff_id = $staff_id;
        	$def->department_id = Staff::find($staff_id)->department_id;
            $def->created_at = Carbon::createFromTimeStamp(rand($endDate->timestamp, $startDate->timestamp));
            $def->completed = false;
        	$def->save();
        }

        $faker = Faker::create('App\Deficiency');

        for($i=0;$i<300;$i++)
            makeDeficiency(rand(1,100), $faker->sentence(), $faker->sentence(), rand(1,50));

        for($i=0;$i<15;$i++)
            makeDeficiency(1, $faker->sentence(), $faker->sentence(), rand(1,50));
    }
}
