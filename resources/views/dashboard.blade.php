@extends('layout')

@include('header')

@section('content')
<div class="content page-dashboard">
    <div class="widget stru" style="width: 50%">
        <h3>User Structure</h3>
        <div class="box">
            <div class="score">105<span>Basic</span></div>
            <div class="score">45<span>Pro</span></div>
            <div class="score">15<span>Lifetime</span></div>
        </div>
    </div>
    <div class="widget growth" style="width: 50%">
        <h3>User Growth</h3>
        <div class="box">
            <div class="score">105<span>Today</span></div>
            <div class="score">45<span>Monthly</span></div>
            <div class="score">15<span>Yearly</span></div>
            <div class="score">15<span>Total</span></div>
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
                <li>
                    <a href="">Themename</a>
                    <p>Design<time>Downloads:30</time></p>
                </li>
                <li>
                    <a href="">Themename</a>
                    <p>Design<time>Downloads:30</time></p>
                </li>
                <li>
                    <a href="">Themename</a>
                    <p>Design<time>Downloads:30</time></p>
                </li>
                <li>
                    <a href="">Themename</a>
                    <p>Design<time>Downloads:30</time></p>
                </li>
                <li>
                    <a href="">Themename</a>
                    <p>Design<time>Downloads:30</time></p>
                </li>
                <li>
                    <a href="">Themename</a>
                    <p>Design<time>Downloads:30</time></p>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
