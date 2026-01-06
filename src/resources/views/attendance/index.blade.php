@extends('layouts.user')
@section('title','勤怠一覧')
@section('content')
<h1>勤怠一覧</h1>

<a href="{{ route('attendances.index',['month' => $prevMonth]) }}">←前月</a>
<h2>{{ $month }}</h2>
<a href="{{ route('attendances.index',['month' => $nextMonth]) }}">翌月→</a>

@foreach($dates as $date)

@php
$attendance = $attendanceByDate[$date] ?? null;
@endphp

<p>{{ $date }}</p>
<p>{{ $attendance?->clock_in_time ?? ''  }}</p>
<p>{{ $attendance?->clock_out_time ?? '' }}</p>
<p>{{ $attendance?->break_time ?? '' }}</p>
<p>{{ $attendance?->net_work_time ?? '' }}</p>
@if($attendance){
<a href="{{ route('attendance.show',['attendance_id' => $attendance->id]) }}">詳細</a>
}
@else
<p>詳細</p>
@endif
~~~~~~~~~~~
@endforeach

@endsection