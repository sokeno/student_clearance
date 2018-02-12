<?php

use App\Program;
use App\Role;
use App\Student;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	function makeStudent($name, $email, $student_number, $program)
        {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('secret'),
            ]);
            $user->roles()->attach(Role::whereName('student')->first()->id);
            $student = new Student();
            $student->student_number = $student_number;
            $student->user_id = $user->id;
            $student->program_id = $program;
            $student->save();
        }

        $faker = Faker::create('App\Student');

        makeStudent('Melvin San Jose', 'mcsanjose@up.edu.ph', 200824143, 1);

        for($i=0;$i<100;$i++)
            makeStudent($faker->name(), $faker->email(), rand(200000000,201800000), rand(1,11));
    }
}
