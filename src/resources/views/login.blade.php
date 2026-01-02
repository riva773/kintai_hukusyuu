@extends('layouts.guest')
@section('title','ログイン')
@section('content')
<h1>ログイン</h1>
@if($errors)
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
@endif
<form action="{{ route('login') }}" method="post">
    @csrf
    <h2>メールアドレス</h2>
    <input type="email" name="email" id="email">
    <h2>パスワード</h2>
    <input type="password" name="password" id="password">
    <button type="submit">ログインする</button>
</form>
<a href="{{ route('register') }}">会員登録はこちら</a>
@endsection