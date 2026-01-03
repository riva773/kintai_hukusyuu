<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class WorkBreak extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'break_in_at',
        'break_out_at',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    protected $casts = [
        'break_in_at' => 'datetime',
        'break_out_at' => 'datetime',
    ];

    protected function breakInFormat(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->break_in_at->Format('H:i');
            }
        );
    }

    protected function breakOutFormat(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->break_out_at->Format('H:i');
            }
        );
    }
    
    protected function durationMinutes(): Attribute
    {
        return new Attribute(
            get: function () {
                $start = $this->break_in_at->copy()->second(0);
                $end = $this->break_out_at->copy()->second(0);

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
}
