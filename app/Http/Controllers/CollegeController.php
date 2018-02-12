<?php

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function show($short_name)
    {
        $college = College::whereShortName($short_name)->firstOrFail();

        return view('college.show', compact('college'));
    }

    public function create()
    {
        return view('college.create');
    }

    public function store()
    {
        $validatedData = request()->validate([
                        'name' => 'required',
                        'short_name' => 'required'
                        ]);

        $college = College::create($validatedData);

        return redirect('/college/' . $college->short_name);
    }

    public function index()
    {
    }
}
