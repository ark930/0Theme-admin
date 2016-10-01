@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('lib/tagator.jquery.css') }}"/>
@endsection

@include('header')

@section('content')
<div class="content page-edit-theme">
    <form class="uploader" method="post" action="{{ Request::url() }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="hint">Upload Theme Package</label>
            <div class="upload-area">
                <h3 class="statue">Click Here</h3>
                <input type="file" name="package" onchange="eventStart();"/>
            </div>
        </div>
        <button type="submit" class="submit">UPLOAD</button>
    </form>

    @if(Session::has('config'))
        <div>
            <div class="form-title">Basic Information</div>
            <div class="form-group">
                <label>Theme Name</label>
                <input type="text" name="themeName" readonly value="{{ Session::get('config')['name']}}">
            </div>
            <div class="form-group">
                <label>Version</label>
                <input type="text" name="version" placeholder="1.0" readonly value="{{ Session::get('config')['version'] }}">
            </div>
            <div class="form-group">
                <label>Requirements</label>
                <textarea name="requirements" readonly>{{ Session::get('config')['requirements'] }}</textarea>
            </div>
            <div class="form-group">
                <label>Category</label>
                <ul class="tags">
                    @foreach(Session::get('config')['categories'] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group">
                <label>Type</label>
                <ul class="tags">
                    @foreach(Session::get('config')['types'] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="form-title">Uploads</div>
            <div class="form-group">
                <label>Changelog(.txt)</label>
                <textarea name="changelog" readonly>{{ Session::has('changelog') ? Session::get('changelog') : ''}}</textarea>
            </div>
            <div class="form-group">
                <label>Document(url)</label>
                <input type="url" name="document" value="{{ Session::get('config')['document_url'] }}" readonly/>
            </div>
            <div class="form-group">
                <label>Free Download(url)</label>
                <input type="url" name="freeUrl" value="{{ Session::get('config')['free_url'] }}" readonly/>
            </div>
            <div class="form-group">
                <label>Premium Download(.zip)</label>
                <input type="url" name="proUrl" value="http://" readonly/>
            </div>
            <div class="form-title">Details</div>
            <div class="form-group">
                <label>Showcase(800*1200 .jpg)</label>
                <ul>
                    <li>
                        <img src="http://placehold.it/800x1200" />
                    </li>
                    <li>
                        <img src="http://placehold.it/800x1200" />
                    </li>
                    <li>
                        <img src="http://placehold.it/800x1200" />
                    </li>
                    <li>
                        <img src="http://placehold.it/800x1200" />
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <label>Thumbnail(400x800)</label>
                <img src="http://placehold.it/400x800" />
            </div>
            <div class="form-group">
                <label>Thumbnail Tiny(100x100)</label>
                <img src="http://placehold.it/100x100" />
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" readonly>{{ Session::has('description') ? Session::get('description') : ''}}</textarea>
            </div>
        </div>
    @endif
</div>
@endsection

@section('js')
    <script src="http://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
    <script>
        function eventStart(){
            var  jdjd = $("input[name='package']").val();
            if( jdjd != "" ) {
                $(".statue").html(jdjd);
                $(".hint").html("The Package Dir is");
            }else{

            }
        }
    </script>
@endsection
