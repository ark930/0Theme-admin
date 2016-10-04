@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('lib/tagator.jquery.css') }}"/>
@endsection

@include('header')

@section('content')
<div class="content page-user">
    <div class="left">
        <div class="top">
            Username<span class="member {{ $user['membership'] }}">{{ ucfirst($user['membership']) }}</span>
        </div>
        <div class="inner">
            <div class="form-group">
                <label>Email</label>
                <h3>C{{ $user['email'] }}</h3>
            </div>
            <div class="form-group">
                <label>Registion Time</label>
                <h3>{{ $user['register_at'] }}</h3>
            </div>
            <div class="form-group">
                <label>Lastest Login</label>
                <h3>{{ $user['last_login_at'] }}</h3>
            </div>
            <div class="form-group">
                <label>IP</label>
                <h3 class="ip">{{ $user['last_login_ip'] }}</h3>
            </div>
            <div class="form-group">
                <label>IP Location</label>
                <h3 class="ip-location"></h3>
            </div>
            <hr/>
            <div class="form-group">
                <label>Member</label>
                <h3>{{ ucfirst($user['membership']) }}</h3>
            </div>
            <div class="form-group">
                <label>Start with</label>
                <h3>{{ $user['pro_from'] }}</h3>
            </div>
            <div class="form-group">
                <label>Expired by</label>
                <h3>{{ $user['pro_to'] }}</h3>
            </div>
            <hr/>
            <div class="form-group">
                <label>Actived Sites</label>
                <h3>12</h3>
            </div>
            {{--<div class="form-group">--}}
                {{--<label>AppKey</label>--}}
                {{--<h3></h3>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="right">
        <ul class="tab">
            <li class="cur">Themes</li>
            <li>Forum</li>
            <li>Payment</li>
            <li>Log</li>
        </ul>
        <div class="user-themes tab-content on">
        @foreach($user->themes as $theme)
            <?php $activeWebsites = $user->activeWebsites($theme['id']) ?>
            <div class="theTheme">
                <div class="name">{{ $theme['name'] }} <span class="sites">{{ count($activeWebsites) }}</span> <span class="key">Key:<i>{{ $theme->pivot->theme_key }}</i></span></div>
                <ul class="sites">
                    @foreach($activeWebsites as $activeWebsite)
                        <li>
                            <a href="{{ $activeWebsite  }}" target="_blank">{{ $activeWebsite }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        </div>
        <div class="user-forum tab-content">
            <ul>
                <li>
                    <a href="">How to config the zen panel? <span class="status">Open</span><br/><time>9 Jan 2016</time> </a>
                </li>
                <li>
                    <a href="">How to config the zen panel? <span class="status closed">Closed</span><br/><time>9 Jan 2016</time> </a>
                </li>
            </ul>
        </div>
        <div class="user-payment tab-content">
            <table>
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Account</th>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Operate</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->orders as $order)
                    <tr>
                        <td>{{ $order->user['membership'] }}<span>Themename</span></td>
                        <td>{{ $order->user['email'] }}<span>{{ $order['payment_type'] }}</span></td>
                        <td>{{ $order['order_no'] }}</td>
                        <td>{{ $order['created_at'] }}</td>
                        <td>{{ $order['paid_amount'] }}</td>
                        <td>{{ $order['status'] }}</td>
                        <td><a href="">Refund</a> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="user-log tab-content">
            <table>
                <thead>
                <tr>
                    <th>Activity</th>
                    <th>Type</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Buy <b>Basic</b> for <b>Themename</b></td>
                    <td>Membership</td>
                    <td>08 Oct 206 - 10:23</td>
                </tr>
                <tr>
                    <td>Active <b>Themename</b> on <b>http://alalala.com</b></td>
                    <td>Active Theme</td>
                    <td>08 Oct 206 - 10:23</td>
                </tr>
                <tr>
                    <td>Login OTheme</td>
                    <td>Login</td>
                    <td>08 Oct 206 - 10:23</td>
                </tr>
                <tr>
                    <td>Logout OTheme</td>
                    <td>Logout</td>
                    <td>08 Oct 206 - 10:23</td>
                </tr>
                <tr>
                    <td>Buy <b>Pro</b></td>
                    <td>Membership</td>
                    <td>08 Oct 206 - 10:23</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
//        var i = $(".ip").html();
//        $.get("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js", { ip:i }, function(data){
//            alert(data);
//        });
            $(".tab li").click(function(){
                $(".tab li").eq($(this).index()).addClass("cur").siblings().removeClass('cur');
                $(".tab-content").hide().eq($(this).index()).show();
                //另一种方法: $("div").eq($(".tab li").index(this)).addClass("on").siblings().removeClass('on');

            });
        });
    </script>
@endsection
