@extends('layout')

@include('header')

@section('content')
<div class="content page-themes">
    <table>
        <thead>
        <tr>
            <th>Theme</th>
            <th>Category</th>
            <th>Types</th>
            <th>Version</th>
            <th>Release</th>
            <th>Downloads</th>
        </tr>
        </thead>
        <tbody>
        @foreach($themeInfo as $item)
            <tr>
                <td>
                    <a href="{{ '/theme/new/' . $item['id'] }}">
                        <img src="http://placehold.it/100x100"/> {{ $item['name'] }}
                    </a>
                </td>
                <td>{{ $item['category'] }}</td>
                <td>{{ $item['type'] }}</td>
                <td>{{ $item['version'] }}</td>
                <td>{{ $item['release_at'] }}</td>
                <td>{{ $item['download_count'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
