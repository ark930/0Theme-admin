@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('lib/tagator.jquery.css') }}"/>
@endsection

@include('header')

@section('content')
<div class="content page-edit-theme page-settings">
    <form>
        <div class="form-title">Price</div>
        <div class="form-group" width="50%">
            <label>Basic</label>
            <input type="number" name="basic">
        </div>
        <div class="form-group" width="50%">
            <label>Basic Discount</label>
            <input type="number" name="basicDiscount">
        </div>
        <div class="form-group" width="50%">
            <label>Pro</label>
            <input type="number" name="pro">
        </div>
        <div class="form-group" width="50%">
            <label>Pro Discount</label>
            <input type="number" name="proDiscount">
        </div>
        <div class="form-group" width="50%">
            <label>Lifetime</label>
            <input type="number" name="lifetime">
        </div>
        <div class="form-group" width="50%">
            <label>Lifetime Discount</label>
            <input type="number" name="lifetimeDiscount">
        </div>
        <button type="submit" class="submit">SAVE</button>
    </form>
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
