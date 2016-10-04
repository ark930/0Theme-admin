@extends('layout')

@section('head_script')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('header')
<header>
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}"/>THEME.<span>Admin</span>
    </div>
</header>
@endsection

@section('content')
<div class="content page-login">
    <form method="post" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <input type="password" placeholder="< Password />" name="pwd"/>
        <input type="password" placeholder="< Code />" name="code"/>
        <div class="g-recaptcha" data-sitekey="6LfwXAgUAAAAACvEpJwKonzlmpIG8GeCZVbWzn00"></div>
        <button type="submit">LOGIN</button>
    </form>
</div>
@endsection
