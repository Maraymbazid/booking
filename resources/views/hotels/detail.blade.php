@extends('layout.lay')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .row{
        margin-right: 20px !important;
        margin-left: auto !important;
    }
    .company{
        text-align: center;
        /* background-color:rgb(30, 228, 218); */
        /*color:rgb(5, 69, 88); */
        font-size: 20px;
    }
    .bg {
  height: 400px; 
  width:100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<div class="">
    <img src="{{$hotel->cover}}" class="bg">
</div>
<span>  </span>
@endsection