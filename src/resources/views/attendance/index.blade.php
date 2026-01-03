@extends('layouts.user')
@section('title','勤怠一覧')
@section('content')
<h1>勤怠一覧</h1>

<form action="#" method="post">

</form>
<h2>{{ $month }}</h2>
<form action="#" method="post">

</form>
@foreach($attendances->all() as $attendance)
<p>{{ $attendance->work_date_format }}</p>
<p>{{ $attendance->clock_in_time }}</p>
<p>{{ $attendance->clock_out_time }}</p>
<p>{{ $attendance->break_time }}</p>
<p>{{ $attendance->net_work_time }}</p>
<a href="{{ route('attendance.show',['attendance_id' => $attendance->id]) }}">詳細</a>
~~~~~~~~~~~
@endforeach

@endsection