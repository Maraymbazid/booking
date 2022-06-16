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
    <div class="moving-image"   style="background-image: url({{$villa->image}});"></div>
</div>
@endsection
@section('content')
@include('layout.nav2')
<div class="title">
    {{$villa->name_ar}}
</div>


<div class="container">
    <div class="row mt-5" v-for='room in v2'>
        <div class="col-lg-12 ">
            <div class="row">
                <div class="col-lg-4 hight borderr border">
                    <p class="title-desS mt-2 ">  </p>
                    <p class="title-des">السيارة :{{$villa->name_ar}} </p>
                    <hr>
                    <p class="title-des">الموديل : t</p>
                    <hr>
                    <p class="title-des">سعر اليوم : {{$villa->price}} $</p>
                </div>
                <div class="col-lg-8 hight border borderr">
                    <p class="title-des">الخصم:</p>
                    <div class="boxes">
                        <div class="row">
                            @if($villa->discount)
                            @foreach($villa->discount as $discount)
                                <div class="para col-lg-3 col-3 m-1" >
                                <p class="title-des-left p-1">
                                    %{{$discount->rate}} => لـ 5أيام
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
    <hr>
    <h3 class="mayati-title">
        الحجز
    </h3>
    <form method="post" action="{{route('checkordervilla')}}">
        @csrf
                    <div class="row mb-5 form">
                        <input type="hidden" name="id" value="{{$villa->id}}">
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> تاريخ القدوم  </label>
                            <input type="date" class="form-control" id="begindate"  name="begindate"  placeholder="تاريخ القدوم ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> تاريخ الخروج  </label>
                            <input type="date" class="form-control" id="enddate"  name="enddate"  placeholder="تاريخ الخروج ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> المده </label>
                            <input type="number" class="form-control" id="numberdays"  name="numberdays" placeholder="  من فضلك ادخل عدد الايام ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> رقم التليفون </label>
                            <input type="number" class="form-control" id="number" name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> عدد الأشخاص   </label>
                            <input type="number" class="form-control" id="persones" name="persones" placeholder=" من فضلك ادخل   عدد الأشخاص  ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 ">  اسم الشخص المعني بالحجز </label>
                            <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
                        </div>
                        <div class="col-md-12 col-12 yas">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">احجز الان</button>
                        </div>
                    </div>
    </form>
</div>





                {{-- <div class="container">
                    <div class="row mt-5">
                    <div class="col">

                    </div>
                </div> --}}




@endsection
@section('js')
<script>
    function myFunction() {
            $(':button').prop('disabled', true);
        }
</script>

@endsection
