@extends('layouts.user')
@section('title','勤怠登録')
@section('content')
<div id="dateNow"></div>
<div id="timeNow"></div>

@if(!$attendance)
<form action="{{ route('attendance.clockIn') }}" method="post">
    @csrf
    <button type="submit">出勤</button>
</form>
@elseif($attendance->clock_in_at && !$attendance->clock_out_at)
<form action="{{ route('attendance.clockOut') }}" method="post">
    @csrf
    <button type="submit">退勤</button>
</form>
@else
<p>お疲れ様でした。</p>
@endif

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