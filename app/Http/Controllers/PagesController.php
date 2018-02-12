<?php

namespace App\Http\Controllers;

use App\College;
use App\Department;
use App\Program;
use App\Staff;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\User;

class PagesController extends Controller
{
    public function index()
    {
        $colleges = College::all();
        $counts = [
                'department' => Department::all()->count(),
                'staff' => Staff::all()->count(),
                'program' => Program::all()->count(),
                'student' => Student::all()->count()
                ];

        return view('pages.index', compact('colleges', 'counts'));
    }

	public function about()
	{
		return view('pages.about');
	}

	public function search()
	{
		$students = $this->autocomplete(request());
		return view('pages.searchresults', compact('students'));
	}
	
	public function autocomplete(Request $request)
	{

		$students = Student::search($request->get('q'))
							->with(['user', 'program'])
							->get();

		foreach($students as $student){
			if(!$student->user->avatar){
				$student->user->avatar = $student->picture();
			}
		}

		return $students;

	}
	
	
    public function program($short_name)
    {
        $program = Program::where('short_name', $short_name)->first();

        return view('program.show', compact('program'));
    }

    public function department($short_name)
    {
        $department = Department::where('short_name', $short_name)->first();

        return view('department.show', compact('department'));
    }

    public function profile()
    {
        $user = Auth::user();
        if (!$user) {
            abort(404);
        }

        if ($user->hasRole('student')) {
            $student = Student::whereUserId($user->id)->firstOrFail();
            return redirect()->action('StudentController@show', ['slug' => $student->slug]);
        }

        if ($user->hasRole('staff')) {
            $staff = Staff::whereUserId($user->id)->firstOrFail();
            return redirect()->action('StaffController@show', ['slug' => $staff->slug]);
		}

		if ($user->hasRole('admin')) {
            $admin = User::whereId($user->id)->firstOrFail();
            return redirect('admin');
		}
		
		Auth::logout();
		
    }

    public function user()
    {
        return view('pages.user');
    }

    public function logs()
    {
        $logs = Activity::all()->sortByDesc('created_at');
        return view('pages.logs', compact('logs'));
    }

	public function log()
	{
		return redirect()->action('PagesController@logs');
	}

	public function google()
	{
		return view('pages.google');
	}

	public function googleLogin(Request $request)
	{
		$google_redirect_url = route('glogin');	
		$gClient = new \Google_Client();
		$gClient->setApplicationName(config('services.oauth_app_name'));
		$gClient->setClientId(config('services.oauth_client_id'));
		$gClient->setClientSecret(config('services.oauth_client_secret'));
		$gClient->setRedirectUri($google_redirect_url);
		$gClient->setDeveloperKey(config('services.oauth_api_key'));

		$gClient->setScopes(array(
					'https://www.googleapis.com/auth/plus.me',
					'https://www.googleapis.com/auth/userinfo.email',
					'https://www.googleapis.com/auth/userinfo.profile',
				));

		$google_oauthV2 = new \Google_Service_Oauth2($gClient);

		if($request->get('code')){
			$gClient->authenticate($request->get('code'));
			$request->session()->put('token', $gClient->getAccessToken());
		}

		if($request->session()->get('token')){
			$gClient->setAccessToken($request->session()->get('token'));
		}

		if($gClient->getAccessToken()){

			//For logged in users, get details from google using
			//access token
			$guser = $google_oauthV2->userinfo->get();

			$request->session()->put('name', $guser['name']);

			if($user = User::where('email', $guser['email'])->first()){
				Auth::login($user);
				$user->avatar = $guser['picture'];
				$user->save();
				return redirect()->action('PagesController@profile');
			}else{
	
			}

			return redirect()->action('PagesController@google');

		}else{
			$authUrl = $gClient->createAuthUrl();

			return redirect()->to($authUrl);
		}


	}
	
	
	
}
