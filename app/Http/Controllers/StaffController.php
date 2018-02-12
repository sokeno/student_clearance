<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function show($slug)
    {

        $staff = Staff::whereSlug($slug)->firstOrFail();
        return view('staff.show', compact('staff'));
    }
}
