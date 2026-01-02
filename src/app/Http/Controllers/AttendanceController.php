<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $todayString = Carbon::now()->toDateString();
        $attendance = Attendance::where('user_id', $user->id)->where('work_date', $todayString)->first();
        return view('attendance.create', compact('attendance', 'user'));
    }

    public function clockIn()
    {
        $user = Auth::user();
        $carbon = Carbon::now();
        $now = $carbon->copy()->toDateString();
        $clock_in_at = $carbon->copy();

        Attendance::create([
            'user_id' => $user->id,
            'work_date' => $now,
            'clock_in_at' => $clock_in_at,
        ]);

        return redirect()->route('attendances.create', compact('user'));
    }
    public function clockOut()
    {
        $user = Auth::user();
        $carbon = Carbon::now();
        $now_date = $carbon->copy()->toDateString();
        $clock_out_at = $carbon->copy();

        Attendance::where('user_id', $user->id)->where('work_date', $now_date)->update([
            'clock_out_at' => $clock_out_at,
        ]);
        return redirect()->route('attendances.create', compact('user'));
    }
}
