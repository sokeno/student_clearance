<?php

use App\Department;
use App\Role;
use App\Staff;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    	function makeStaff($name, $email, $role='staff')
	    {
	    	$user = User::create([
	    		'name' => $name,
	    		'email' => $email,
	    		'password' => bcrypt('secret'),
	    	]);
            $user->roles()->attach(Role::whereName($role)->first()->id);
	    	$staff = new Staff();
	    	$staff->user_id = $user->id;
	    	$staff->department_id = rand(1, 13); 
	    	$staff->save();
	    }
   

        $eden = User::create([
            'name' => 'Eden Huelgas',
            'email' => 'eden@gmail.com',
            'password' => bcrypt('secret')
        ]);
        $eden->roles()->attach(Role::whereName('staff')->first()->id);

        Staff::create([
            'user_id' => $eden->id,
            'department_id' => 1
        ])->save();

        $faker = Faker::create('App\Staff');

        for($i=0;$i<50;$i++){
            makeStaff($faker->name(), $faker->email());
        }

    }
 
}
