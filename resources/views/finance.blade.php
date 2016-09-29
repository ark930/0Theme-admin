@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
@endsection

@include('header')

@section('content')
<div class="content page-users page-finance">
    <table id="myTable">
        <thead>
        <tr>
            <th>User</th>
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
            <td>Username</td>
            <td>Basic<span>Themename</span></td>
            <td>contact@baohan.me<span>Paypal</span></td>
            <td>98734972389473</td>
            <td>08 Feb 2015</td>
            <td>+$45.00</td>
            <td>Success</td>
            <td><a href="">Refund</a> </td>
        </tr>
        <tr>
            <td>Username</td>
            <td>Basic<span>Themename</span></td>
            <td>contact@baohan.me<span>Paypal</span></td>
            <td>98734972389473</td>
            <td>08 Feb 2015</td>
            <td>+$45.00</td>
            <td>Error</td>
            <td></td>
        </tbody>
    </table>
</div>
@endsection

@section('js')
    <script src="http://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
@endsection
