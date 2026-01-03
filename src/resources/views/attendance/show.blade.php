@extends('layouts.user')
@section('title','勤怠詳細')
@section('content')
<h1>勤怠詳細</h1>
<form action="#" method="post">
    @csrf

    <label for="">名前</label>
    <p>{{ $attendance->user->name }}</p>

    <label for="">日付</label>
    <p>{{ $attendance->year_format }}</p>
    <p>{{ $attendance->date_md }}</p>

    <label for="attendance">出勤・退勤</label>
    <input type="time" name="attendance" id="attendance" value="{{ $attendance->clock_in_time }}">
    <p>~</p>
    <input type="time" name="attendance" id="attendance" value="{{ $attendance->clock_out_time }}">
    <br><br>
    @foreach($attendance->breaks as $index => $break )
    <label for="break{{$index+1}}">休憩{{$index+1}}</label>
    <input type="time" name="break{{$index+1}}" id="break{{$index+1}}" value="{{ $break->break_in_format }}">
    <p>~</p>
    <input type="time" name="break{{$index+1}}" id="break{{$index+1}}" value="{{ $break->break_out_format }}">
    <br><br>
    @endforeach
    <p>備考</p>
    <input type="text" name="remarks" id="remarks">
    <button type="submit">修正</button>
</form>
@endsection