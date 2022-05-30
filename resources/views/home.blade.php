@extends('layout.lay')
@section('content')
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


            <div class="col-lg-2 col-3 card">
                <a href="" style="text-decoration: none; ">
                    <div class="card-image" style="background-image: url({{ url('/') . '/file' }});">
                    </div>
                    <p class="card-title"></p>
                </a>
            </div>


        </div>


@endsection
