@extends('layout.lay')
@section('content')
<style>
    .row{
        margin-right: 20px !important;
        margin-left: auto !important;
    }
    .company{
        text-align: center;
        /* background-color:rgb(30, 228, 218); */
        color:rgb(5, 69, 88);
        font-size: 20px;
    }
</style>
<form class="form-inline my-2 my-lg-0 mr-lg-2">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." >
        <span class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
</form>
<br>
<div class="row">



        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
            @foreach ($villas as $villa)
            <div class="col-lg-2  col-md-4 card my-2 my-lg-0 mr-lg-2">
                <a href="{{route('userOneTax', $villa->id )}}" style="text-decoration: none; ">
                    <div class="card-image" style="background-image: url({{$villa->image}});">
                    </div>
                    <p class="card-title">{{$villa->name_ar}}</p>
                    {{-- <p class="company">{{$taxi->company}}</p> --}}
                </a>
            </div>
            @endforeach
        </div>


@endsection
