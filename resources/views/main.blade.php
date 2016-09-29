@extends('layout')

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
        <button type="submit">LOGIN</button>
    </form>
</div>
@endsection

@if($errors->count() > 0)
    <script src="//cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>

    <script>
        $(function() {
            alert('{{ $errors->first() }}');
        });
    </script>
@endif