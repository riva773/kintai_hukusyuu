<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;


class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'clock_in_at',
        'clock_out_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function breaks()
    {
        return $this->hasMany(WorkBreak::class);
    }

    protected $casts = [
        'clock_in_at' => 'datetime',
        'clock_out_at' => 'datetime',
        'work_date' => 'datetime',
    ];

    protected function breakMinutes(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->breaks->sum('duration_minutes');
            }
        );
    }
    protected function workMinutes(): Attribute
    {
        return new Attribute(
            get: function () {
                $start = $this->clock_in_at->copy()->second(0);
                $end = $this->clock_out_at->copy()->second(0);

                if (!$start || !$end) {
                    return 0;
                }
                if ($end->lte($start)) {
                    return 0;
                }
                return $start->diffInMinutes($end);
            }
        );
    }

    protected function netWorkMinutes(): Attribute
    {
        return new Attribute(
            get: function () {
                $break = $this->break_minutes;
                $work = $this->work_minutes;
                return max(0, $work - $break);
            }
        );
    }

    protected function clockInTime(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->clock_in_at->format('H:i');
            }
        );
    }

    protected function clockOutTime(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->clock_out_at->format('H:i');
            }
        );
    }

    protected function breakTime(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->minutesToHHMM($this->break_minutes);
            }
        );
    }

    protected function netWorkTime(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->minutesToHHMM($this->net_work_minutes);
            }
        );
    }

    protected function workDateFormat(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->work_date->isoFormat('MM/DD(ddd)');
            }
        );
    }
    protected function monthFormat(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->work_date->isoFormat('YYYY/MM');
            }
        );
    }

    protected function dateFormat(): Attribute{
        return new Attribute(
            get: function(){
                return $this->work_date->isoFormat('YYYY/MM/d');
            }
        );
    }
    protected function yearFormat(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->work_date->isoFormat('YYYY年');
            }
        );
    }
    protected function dateMd(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->work_date->isoFormat('M月d日');
            }
        );
    }
    protected function minutesToHHMM(int $minutes): string
    {
        $minutes = max(0, $minutes);
        $h = intdiv($minutes, 60);
        $m = $minutes % 60;
        return sprintf("%02d:%02d", $h, $m);
    }
}
