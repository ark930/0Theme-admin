@extends('layout')

@include('header')

@section('content')
<div class="content page-dashboard">
    <div class="widget stru" style="width: 50%">
        <h3>User Structure</h3>
        <div class="box">
            <div class="score">{{ $userMembership['basic'] }}<span>Basic</span></div>
            <div class="score">{{ $userMembership['pro'] }}<span>Pro</span></div>
            <div class="score">{{ $userMembership['lifetime'] }}<span>Lifetime</span></div>
        </div>
    </div>
    <div class="widget growth" style="width: 50%">
        <h3>User Growth</h3>
        <div class="box">
            <div class="score">{{ $userGrowth['today'] }}<span>Today</span></div>
            <div class="score">{{ $userGrowth['month'] }}<span>Monthly</span></div>
            <div class="score">{{ $userGrowth['year'] }}<span>Yearly</span></div>
            <div class="score">{{ $userGrowth['total'] }}<span>Total</span></div>
        </div>
    </div>
    <div class="widget earn" style="width: 33.333%">
        <h3>Earning</h3>
        <div class="box">
            <div class="price">
                <span>Today</span>
                <h3>$70000</h3>
            </div>
            <div class="price">
                <span>Monthly</span>
                <h3>$70000</h3>
            </div>
            <div class="price">
                <span>Yearly</span>
                <h3>$70000</h3>
            </div>
            <div class="price">
                <span>Total</span>
                <h3>$70000</h3>
            </div>
        </div>
    </div>
    <div class="widget forum" style="width: 33.333%">
        <h3>Recent Topics</h3>
        <div class="box">
            <ul>
                <li>
                    <a>this is title</a>
                    <p>themename<time>Today 10:30</time></p>
                </li>
                <li>
                    <a>this is title</a>
                    <p>themename<time>07 Jan 2016</time></p>
                </li>
                <li>
                    <a>this is title</a>
                    <p>themename<time>07 Jan 2016</time></p>
                </li>
                <li>
                    <a>this is title</a>
                    <p>themename<time>07 Jan 2016</time></p>
                </li>
                <li>
                    <a>this is title</a>
                    <p>themename<time>07 Jan 2016</time></p>
                </li>
            </ul>
        </div>
    </div>
    <div class="widget themes" style="width: 33.333%">
        <h3>Theme Downloads</h3>
        <div class="box">
            <ul>
                @foreach($themeDownloadInfo as $item)
                    <li>
                        <a href="">{{ $item['name'] }}</a>
                        <p>Design<time>Downloads:{{ $item['total'] }}</time></p>
                    </li>
                @endforeach
                <li>
                    <a href="">Themename</a>
                    <p>Design<time>Downloads:30</time></p>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
