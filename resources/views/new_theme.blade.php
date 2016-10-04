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

    @if(session('theme') && session('theme_version') && session('new'))
        <?php $theme = session('theme') ?>
        <?php $themeVersion = session('theme_version') ?>
        <?php $new = session('new') ?>
    @endif

    @if(!empty($theme) && !empty($themeVersion))
    <div>
        <div class="form-title">Basic Information{{ !empty($new) ? ' (New)' : '' }}</div>
        <div class="form-group">
            <label>Theme Name</label>
            <input type="text" name="themeName" readonly value="{{ $theme['name']}}">
        </div>
        <div class="form-group">
            <label>Version</label>
            <input type="text" name="version" placeholder="1.0" readonly value="{{ $themeVersion['version'] }}">
        </div>
        <div class="form-group">
            <label>Requirements</label>
            <textarea name="requirements" readonly>{{ $themeVersion['requirements'] }}</textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <ul class="tags">
                @foreach($themeVersion->categoryTags() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            <label>Type</label>
            <ul class="tags">
                @foreach($themeVersion->typeTags() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        <div class="form-title">Uploads</div>
        <div class="form-group">
            <label>Changelog(.txt)</label>
            <textarea name="changelog" readonly>{{ $themeVersion['changelog'] }}</textarea>
        </div>
        <div class="form-group">
            <label>Document(url)</label>
            <input type="url" name="document" value="{{ $themeVersion['document_url'] }}" readonly/>
        </div>
        <div class="form-group">
            <label>Free Download(url)</label>
            <input type="url" name="freeUrl" value="{{ $themeVersion['free_url'] }}" readonly/>
        </div>
        <div class="form-title">Details</div>
        <div class="form-group">
            <label>Showcase(800*1200 .jpg)</label>
            <ul>
                @foreach($themeVersion->getShowcaseUrls() as $item)
                <li>
                    <label>{{ $item['title'] }}</label>
                    <img src="{{ $item['url'] }}" />
                </li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            <label>Thumbnail(400x800)</label>
            <img src="{{ $themeVersion->getThumbnailUrl() }}" />
        </div>
        <div class="form-group">
            <label>Thumbnail Tiny(100x100)</label>
            <img src="{{ $themeVersion->getThumbnailTinyUrl() }}" />
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" readonly>{{ $themeVersion['description'] }}</textarea>
        </div>
    </div>
    @endif

    @if(!empty($new))
        <form method="post" action="{{ route('publish_theme', ['theme_id' => $theme['id'],
        'theme_version_id' => $themeVersion['id']]) }}">
            {{ csrf_field() }}
            <button type="submit" class="submit">PUBLISH</button>
        </form>
    @endif
</div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
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
