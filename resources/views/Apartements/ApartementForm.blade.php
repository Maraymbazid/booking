@extends('layout.flay')
@section('css')
<style>
    input {

        outline: none !important;
        text-align: center;
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: 1px solid #222;

    }




</style>
@endsection

@section('moving-image')

<div class="section">
    <div class="row">
        <div id="carousel" class="carousel slide" data-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
            <div class="d-none d-lg-block">
                <div class="slide-box">
                <img src="https://images6.alphacoders.com/349/thumb-1920-349835.jpg" alt="First slide">
                <img src="https://images4.alphacoders.com/267/267498.jpg" alt="First slide">
                <img src="https://c4.wallpaperflare.com/wallpaper/624/380/1000/life-resort-hotel-resort-hotel-wallpaper-preview.jpg" alt="First slide">
                <img src="https://wallpapershome.com/images/pages/ico_h/19257.jpg" alt="First slide">
                </div>
            </div>
            <div class="d-none d-md-block d-lg-none">
                <div class="slide-box">
                <img src="https://wallpapershome.com/images/pages/pic_h/378.jpg" alt="First slide">
                <img src="https://wallpapershome.com/images/pages/pic_h/4610.jpg" alt="First slide">
                <img src="https://wallpapershome.com/images/pages/pic_h/424.jpg" alt="First slide">
                </div>
            </div>
            <div class="d-none d-sm-block d-md-none">
                <div class="slide-box">
                <img src="https://wallpapershome.com/images/pages/pic_h/424.jpg" alt="First slide">
                <img src="https://images6.alphacoders.com/349/thumb-1920-349835.jpg" alt="First slide">
                </div>
            </div>
            <div class="d-block d-sm-none">
                <img class="d-block w-100" src="https://picsum.photos/600/400/?image=0&random" alt="First slide">
            </div>
            </div>
            <div class="carousel-item">
            <div class="d-none d-lg-block">
                <div class="slide-box">
                <img src="https://wallpapershome.com/images/pages/pic_h/378.jpg" alt="Second slide">
                <img src="https://wallpapershome.com/images/pages/pic_h/378.jpg" alt="Second slide">
                <img src="https://wallpapershome.com/images/pages/pic_h/378.jpg" alt="Second slide">
                <img src="https://wallpapershome.com/images/pages/pic_h/378.jpg" alt="Second slide">
                </div>
            </div>
            <div class="d-none d-md-block d-lg-none">
                <div class="slide-box">
                <img src="https://picsum.photos/240/200/?image=3&random" alt="Second slide">
                <img src="https://picsum.photos/240/200/?image=4&random" alt="Second slide">
                <img src="https://picsum.photos/240/200/?image=5&random" alt="Second slide">
                </div>
            </div>
            <div class="d-none d-sm-block d-md-none">
                <div class="slide-box">
                <img src="https://picsum.photos/270/200/?image=2&random" alt="Second slide">
                <img src="https://picsum.photos/270/200/?image=3&random" alt="Second slide">
                </div>
            </div>
            <div class="d-block d-sm-none">
                <img class="d-block w-100" src="https://picsum.photos/600/400/?image=1&random" alt="Second slide">
            </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    </div>


</div>
@endsection


@section('content')
@include('layout.nav2')
<div class="title">
    {{$apartement->name_ar}}
</div>
<div class="container">
    <div class="row mt-5" v-for='room in v2'>

        <div class="col-lg-12 ">
            <div class="row">
                <div class="col-lg-4 hight borderr border">
                    <p class="title-desS mt-2 ">  </p>
                    <p class="title-des"><i class="fa-solid fa-person"></i> الاسم  :{{$apartement->name_ar}} </p>
                    <hr>
                    <p class="title-des"><i class="fa-solid fa-layer-group"></i> المساحة : {{$apartement->area}} </p>
                    <hr>
                    <p class="title-des"><i class="fa-solid fa-sack-dollar"></i> سعر اليوم :  {{$apartement->price}} $</p>
                    <hr>

                    <p class="title-des"><i class="fa-solid fa-file-waveform"></i> الوصف  :  {{$apartement->description_ar}} </p>
                    <hr>

                    <p class="title-des"> <i class="fa-solid fa-location-dot"></i> العنوان  :  {{$apartement->address_ar}} </p>
                    {{--
                        اسم الشقه
                        المساحه
                        السعر
                        الوصف
                        العنوان
                        المميزات
                        واخير ا الخصومات
                         --}}
                </div>
                <div class="col-lg-8 hight border borderr">
                    <p class="title-des">الخصم:</p>
                    <div class="boxes">
                        <div class="row">
                            @if($apartement->discounts)
                            @foreach($apartement->discounts as $discount)
                                <div class="para col-lg-3 col-4 m-1" >
                                <p class="title-des-left p-1">
                                    %{{$discount->rate}} => لـ 5أيام
                                    </p>
                                </div>
                            @endforeach
                            @endif
                        </div>
                        <hr>
                        <p class="title-des">المميزات:</p>

                        <div class="row">
                            @if($apartement->services)
                          @foreach($apartement->services as $service)
                                <div class="sos col-lg-2 col-3 m-1" >
                                <p class=" p-1">
                                   {{$service->name}}
                                    </p>
                                </div>
                            @endforeach
                            @endif
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
                        <!-- {{-- @if (session()->has('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session()->get('success') }}
                        </div>
                        @elseif (session()->has('error'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{ session()->get('error') }}
                        </div>
                        @endif --}} -->
                        <hr>
    <h3 class="mayati-title">
        الحجز
    </h3>
    <form method="post" action="{{route('checkorderapartement')}}">
        @csrf
        <div class="row mb-5 form">
            <input type="hidden" name="id" value="{{$apartement->id}}">
            <div class="col-md-6 col-12 yas">
                <label  class="form-group text-capitalize m-1 "> تاريخ القدوم :</label>
                <input type="date" class="form-control" id="begindate"  name="begindate"  placeholder="تاريخ القدوم ">
            </div>
            <div class="col-md-6 col-12 yas">
                <label  class="form-group text-capitalize m-1 "> تاريخ المغادرة :</label>
                <input type="date" class="form-control" id="enddate"  name="enddate"  placeholder="تاريخ الخروج ">
            </div>
            <div class="col-md-6 col-12 yas">
                <input type="text" class="form-control" id="numberdays"  name="numberdays" placeholder="  من فضلك ادخل عدد الايام ">
            </div>
            <div class="col-md-6 col-12 yas">
                <input type="number" class="form-control" id="number" name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
            </div>
            <div class="col-md-12 col-12 yas">
                <input type="number" class="form-control" id="persones" name="persones" placeholder=" من فضلك ادخل   عدد الأشخاص  ">
            </div>
            <div class="col-md-12 col-12 yas">
                {{-- <label  class="form-group text-capitalize m-1 "> تاريخ الاستلام :</label> --}}
                <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه" >
            </div>
            <div class="col-md-12 col-12 yas">
            <button type="submit" class="btn btn-primary btn-lg btn-block">احجز الان</button>
            </div>
        </div>
    </form>
    <hr>
</div>

@endsection
@section('js')
<script>
    function myFunction() {
            $(':button').prop('disabled', true);
        }
</script>

@endsection
