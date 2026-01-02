@extends('layouts.user')
@section('title','勤怠登録')
@section('content')

@if(!$attendance)
<p>勤務外</p>
<form action="{{ route('attendances.clockIn') }}" method="post">
    @csrf
    <button type="submit">出勤</button>
</form>

@elseif($attendance && $attendance->clock_out_at)
<p>退勤済み</p>
<p>お疲れ様でした。</p>

@elseif($attendance->clock_in_at && $break === null)
<p>出勤中</p>
<form action="{{ route('attendances.clockOut') }}" method="post">
    @csrf
    <button type="submit">退勤</button>
</form>
<form action="{{ route('attendances.break-in') }}" method="post">
    @csrf
    <button type="submit">休憩入</button>
</form>

@elseif($attendance->clock_in_at && !$break->break_out_at)
<p>休憩中</p>
<form action="{{ route('attendances.break-out') }}" method="post">
    @csrf
    <button type="submit">休憩戻</button>
</form>
@endif

<div id="dateNow"></div>
<div id="timeNow"></div>

@endsection

@push('scripts')
<script>
    function renderNow() {
        let d = new Date();
        const days = [
            "日",
            "月",
            "火",
            "水",
            "木",
            "金",
            "土",
        ];
        let year = d.getFullYear();
        let month = d.getMonth() + 1;
        let date = d.getDate();
        let day = days[d.getDay()];
        let hours = String(d.getHours()).padStart(2, "0");
        let minutes = String(d.getMinutes()).padStart(2, "0");
        let d_now = `${year}年${month}月${date}日(${day})`;
        let time_now = `${hours}:${minutes}`;

        document.getElementById("dateNow").textContent = d_now;
        document.getElementById("timeNow").textContent = time_now;
    }
    renderNow();
    setInterval(renderNow, 1000);
</script>
@endpush