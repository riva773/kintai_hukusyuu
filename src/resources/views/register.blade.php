@extends('layouts.guest')
@section('title','会員登録')
@section('content')
<form action="{{ route('register') }}" method="post">
    @csrf
    <h1>会員登録</h1>
    <label for="name">名前</label>
    <input type="text" name="name" id="name">
    <label for="email">メールアドレス</label>
    <input type="email" name="email" id="email">
    <label for="password">パスワード</label>
    <input type="password" name="password" id="password">
    <label for="password_confirmation">パスワード確認</label>
    <input type="password" name="password_confirmation" id="password_confirmation">
    <button type="submit">登録する</button>
    <a href="{{ route('login') }}">ログインはこちら</a>
</form>
@endsection