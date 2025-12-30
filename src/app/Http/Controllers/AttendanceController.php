<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        return view('attendance.create');
    }
}
