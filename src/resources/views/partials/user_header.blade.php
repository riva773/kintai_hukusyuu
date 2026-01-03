<img src="{{ asset('storage/dummy_logo.png') }}" alt="ロゴ">

<a href="{{ route('attendances.create') }}">勤怠</a>
<a href="{{ route('attendances.index') }}">勤怠一覧</a>
<a href="#">申請</a>
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">ログアウト</button>
</form>