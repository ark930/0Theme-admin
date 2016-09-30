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
            <div class="form-group">
                <label>AppKey</label>
                <h3></h3>
            </div>
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
                <div class="theTheme">
                    <div class="name">{{ $theme['name'] }} <span class="sites">5</span> <span class="key">Key:<i>{{ $theme->pivot->theme_key }}</i></span></div>
                    <ul class="sites">
                        <li>
                            <a href="http://sjsd.com/" target="_blank">http://sjsd.com/</a>
                        </li>
                        <li>
                            <a href="http://sjsd.com/" target="_blank">http://sjsd.com/</a>
                        </li>
                        <li>
                            <a href="http://sjsd.com/" target="_blank">http://sjsd.com/</a>
                        </li>
                        <li>
                            <a href="http://sjsd.com/" target="_blank">http://sjsd.com/</a>
                        </li>
                        <li>
                            <a href="http://sjsd.com/" target="_blank">http://sjsd.com/</a>
                        </li>
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
                <li>
                    <a href="">How to config the zen panel? <span class="status closed">Closed</span><br/><time>9 Jan 2016</time> </a>
                </li>
                <li>
                    <a href="">How to config the zen panel? <span class="status closed">Closed</span><br/><time>9 Jan 2016</time> </a>
                </li><li>
                    <a href="">How to config the zen panel? <span class="status closed">Closed</span><br/><time>9 Jan 2016</time> </a>
                </li><li>
                    <a href="">How to config the zen panel? <span class="status closed">Closed</span><br/><time>9 Jan 2016</time> </a>
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
                <tr>
                    <td>Basic<span>Themename</span></td>
                    <td>contact@baohan.me<span>Paypal</span></td>
                    <td>98734972389473</td>
                    <td>08 Feb 2015</td>
                    <td>+$45.00</td>
                    <td>Success</td>
                    <td><a href="">Refund</a> </td>
                </tr>
                <tr>
                    <td>Basic<span>Themename</span></td>
                    <td>contact@baohan.me<span>Paypal</span></td>
                    <td>98734972389473</td>
                    <td>08 Feb 2015</td>
                    <td>+$45.00</td>
                    <td>Error</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Pro<span>Membership</span></td>
                    <td>contact@baohan.me<span>Paypal</span></td>
                    <td>98734972389473</td>
                    <td>08 Feb 2016</td>
                    <td>+$75.00</td>
                    <td>Success</td>
                    <td><a href="">Refund</a> </td>
                </tr>
                <tr>
                    <td>Pro<span>Upgrade</span></td>
                    <td>contact@baohan.me<span>Paypal</span></td>
                    <td>98734972389473</td>
                    <td>08 Feb 2016</td>
                    <td>+$75.00</td>
                    <td>Success</td>
                    <td><a href="">Refund</a> </td>
                </tr>
                <tr>
                    <td>Pro<span>Renew</span></td>
                    <td>contact@baohan.me<span>Paypal</span></td>
                    <td>98734972389473</td>
                    <td>08 Feb 2016</td>
                    <td>+$75.00</td>
                    <td>Success</td>
                    <td><a href="">Refund</a> </td>
                </tr>
                <tr>
                    <td>Pro<span>Membership</span></td>
                    <td>contact@baohan.me<span>Paypal</span></td>
                    <td>98734972389473</td>
                    <td>08 Feb 2016</td>
                    <td>-$75.00</td>
                    <td>Refunded</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Lifetime<span>Membership</span></td>
                    <td>contact@baohan.me<span>Paypal</span></td>
                    <td>98734972389473</td>
                    <td>08 Feb 2016</td>
                    <td>+$259.00</td>
                    <td>Success</td>
                    <td><a href="">Refund</a> </td>
                </tr>
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
    <script src="http://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
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
