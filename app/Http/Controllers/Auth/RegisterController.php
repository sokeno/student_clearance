<?php

namespace App\Http\Controllers\Auth;
use App\Role;
use App\Staff;
use App\Department;
use App\Program;
use App\Student;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function postregister(Request $request)
    {

        
	    
        $inputs = $request->all();
        
	    
        
        if($inputs['role']=='student'){

            $user = new User;
            $user->name =$inputs['name'];
            $user->email =$inputs['email'];
            $user->password =bcrypt($inputs['password']); 
            $user->save();
            $user->roles()->attach(Role::whereName('student')->first()->id);
            $student = new Student();
            $student->student_number = $inputs['student_number'];
            $student->user_id = $user->id;
            $student->program_id = $inputs['program'];
            $student->save();
            
        }elseif($inputs['role']=='staff'){

            $user = new User;
            $user->name =$inputs['name'];
            $user->email =$inputs['email'];
            $user->password =bcrypt($inputs['password']); 
            $user->save();
            $user->roles()->attach(Role::whereName('staff')->first()->id);
            $staff = new Staff();
	    	$staff->user_id = $user->id;
	    	$staff->department_id = $inputs['department']; 
	    	$staff->save();

        }
        return redirect('login');
        
    }
        public function getregister(){
            $program_list = Program::orderBy('id')->get();
             return view('auth.register',compact('program_list'));
         } 

        public function staff_register(){
            $department_list = Department::orderBy('id')->get();
            return view('auth.staffregister',compact('department_list'));
        } 
   //function to log out a user
    //     public function logout(){

    //         auth()->logout();

    //         session()->flash('message', 'Some goodbye message');
        
    //         return redirect('/login');
    // }
    
}
