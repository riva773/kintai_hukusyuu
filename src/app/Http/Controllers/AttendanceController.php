<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\WorkBreak;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();
        $carbon = new Carbon();
        $todayString = $carbon->copy()->toDateString();
        $attendance = Attendance::where('user_id', $user->id)->where('work_date', $todayString)->first();
        $break = null;

        if ($attendance) {
            $break = WorkBreak::where('attendance_id', $attendance->id)->whereNull('break_out_at')->latest('break_in_at')->first();
        }

        return view('attendance.create', compact('attendance', 'user', 'break'));
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

        return redirect()->route('attendances.create');
    }

    public function breakIn()
    {
        $user = Auth::user();
        $carbon = new Carbon();
        $now = $carbon->copy()->toDateString();
        $break_in_at = $carbon->copy();
        $attendance = Attendance::where('user_id', $user->id)->where('work_date', $now)->first();

        if (!$attendance) {
            return redirect()->route('attendances.create');
        }

        WorkBreak::create([
            'attendance_id' => $attendance->id,
            'break_in_at' => $break_in_at,
        ]);

        return redirect()->route('attendances.create');
    }

    public function breakOut()
    {
        $user = Auth::user();
        $carbon = new Carbon();
        $now = $carbon->copy()->toDateString();
        $break_out_at = $carbon->copy();
        $attendance = Attendance::where('user_id', $user->id)->where('work_date', $now)->first();

        if (!$attendance) {
            return redirect()->route('attendances.create');
        }

        $break = WorkBreak::where('attendance_id', $attendance->id)->whereNull('break_out_at')->latest('break_in_at')->first();

        if (!$break) {
            return redirect()->route('attendances.create');
        }

        $break->update([
            'break_out_at' => $break_out_at,
        ]);

        return redirect()->route('attendances.create');
    }

    public function clockOut()
    {
        $user = Auth::user();
        $carbon = Carbon::now();
        $now_date = $carbon->copy()->toDateString();
        $clock_out_at = $carbon->copy();

        $attendance = Attendance::where('user_id', $user->id)->where('work_date', $now_date)->first();
        $attendance->update([
            'clock_out_at' => $clock_out_at,
        ]);
        return redirect()->route('attendances.create', compact('user'));
    }
}
