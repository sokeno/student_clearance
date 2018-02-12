<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function show($short_name)
    {
        $program = Program::whereShortName($short_name)->firstOrFail();

        return view('program.show', compact('program'));
    }
}
