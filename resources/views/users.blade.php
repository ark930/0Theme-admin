@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
@endsection

@include('header')

@section('content')
<div class="content page-users">
    <table id="myTable">
        <thead>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Membership</th>
            <th>Expired Time</th>
            <th>Sites</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <a href="single-user.html">
                    UserName
                </a>
            </td>
            <td>contact@baohan.me</td>
            <td>Basic</td>
            <td>09 Nov 2017</td>
            <td>3</td>
        </tr>
        <tr>
            <td>
                <a href="single-user.html">
                    UserName
                </a>
            </td>
            <td>contact@baohan.me</td>
            <td>Basic</td>
            <td>09 Nov 2017</td>
            <td>3</td>
        </tr>
        <tr>
            <td>
                <a href="single-user.html">
                    UserName
                </a>
            </td>
            <td>contact@baohan.me</td>
            <td>Basic</td>
            <td>09 Nov 2017</td>
            <td>3</td>
        </tr><tr>
            <td>
                <a href="single-user.html">
                    UserName
                </a>
            </td>
            <td>contact@baohan.me</td>
            <td>Basic</td>
            <td>09 Nov 2017</td>
            <td>3</td>
        </tr>
        <tr>
            <td>
                <a href="single-user.html">
                    UserName
                </a>
            </td>
            <td>contact@baohan.me</td>
            <td>Basic</td>
            <td>09 Nov 2017</td>
            <td>3</td>
        </tr>
        <tr>
            <td>
                <a href="single-user.html">
                    UserName
                </a>
            </td>
            <td>contact@baohan.me</td>
            <td>Basic</td>
            <td>09 Nov 2017</td>
            <td>3</td>
        </tr>
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="http://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
<script src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
            "ajax": "/user_info",
            "deferRender": true,
            "columnDefs": [
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        return '<td><a href="single-user.html">' + data + '</a></td>';
                    },
                    "targets": 0
                }
            ]
        });
    });
</script>
@endsection