@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
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

        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
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
                        return '<td><a href="/user/' + row[5] + '">' + data + '</a></td>';
                    },
                    "targets": 0
                },
                { "visible": false,  "targets": [ 5 ] }
            ]
        });
    });
</script>
@endsection