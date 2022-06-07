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
<div class="row " style='justify-content: center'>



        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
            @foreach ($hotels as $hotel)
            <div class="card    col-md-5   " style="text-decoration: none; ">
                <a href="{{route('getRoomsByHotelId' , $hotel->id)}}" style="text-decoration: none; ">
                            <img src="{{$hotel->image}}" class="card-image" alt="...">
                            <div class="card-body">
                            <h5 class="card-title">{{$hotel->name_ar}} </h5>
                            <p class="card-text"> العنوان  : {{$hotel->title}}</p>
                            <p class="card-text"> التقييم  : <small class="text-muted">
                                @for($i=0;  $i < $hotel->sort; $i++)  <i class="fas fa-star"></i>   @endfor
                                @for($i=$hotel->sort;  $i < 5; $i++)  <i class="far fa-star"></i>  @endfor    </small></p>
                            </div>
                </a>
            </div>
            @endforeach


    </div>


@endsection
