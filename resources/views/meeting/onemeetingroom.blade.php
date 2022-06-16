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
    <div class="moving-image"   style="background-image: url({{$salle->image}});"></div>
</div>
@endsection


@section('content')
@include('layout.nav2')
<div class="title">
    {{$salle->name_ar}}
</div>
<div class="container">
    <div class="row mt-5" v-for='room in v2'>

        <div class="col-lg-12 ">
            <div class="row">
                <div class="col-lg-4 hight borderr border">
                    <p class="title-desS mt-2 ">  </p>
                    <p class="title-des">السيارة :{{$salle->name_ar}} </p>
                    <hr>
                    <p class="title-des">الحجم : {{$salle->area}}</p>
                    <hr>
                    <p class="title-des">سعر اليوم :  {{$salle->price}} $</p>
                </div>
                <div class="col-lg-4 hight borderr border">
                    <p class="title-desS mt-2 ">  </p>
                    <p class="title-des">السيارة :{{$salle->description_ar}} </p>
                    <hr>
                    <p class="title-des">الموديل :{{$salle->guest}}</p>
                    <hr>
                    <p class="title-des">العنوان  :  {{$salle->address_ar}} $</p>
                </div>
                <div class="col-lg-4 hight border borderr">
                    <p class="title-des">النوع :{{$salle->type}}</p>
                    <hr>
                    <p class="title-des"> المميزات :</p>
                    @if($salle->services)
                    @foreach($salle->services as $s)
                    <div class="para col-lg-6 col-6 " >
                        {{$s->name}}
                    </div>
                @endforeach
                    @endif

                    
                    {{-- <p class="title-des">الخصم:</p>
                    <div class="boxes">
                        <div class="row">
                          @if($salle->discount)
                            @foreach($salle->discount as $discount)
                                <div class="para col-lg-3 col-3 m-1" >
                                <p class="title-des-left p-1">
                                    %{{$discount->discount}} => لـ 5أيام
                                    </p>
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div> --}}
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
            <input type="hidden" name="id" value="{{$salle->id}}">
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
