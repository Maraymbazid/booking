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
    <div class="moving-image"   style="background-image: url({{$car->image}});"></div>
</div>
@endsection

@section('content')
@include('layout.nav2')
<div class="title">
    {{$car->name}}
</div>
<<<<<<< HEAD
    
    <div class="container">
        <div class="row mt-5" v-for='room in v2'>
            <!-- <div class="col-lg-3 border ">
                <div class="row" style='height:200px;
                                        background-size: cover ;
                                        background-image: url({{$car->image}});
                                        background-size: cover;
                                        background-position: center center;' >
                </div>
                
            </div> -->
            <div class="col-lg-12 ">
                <div class="row">
                    <div class="col-lg-4 hight borderr border">
                        <p class="title-desS mt-2 ">  </p>
                        <p class="title-des">السيارة : {{$car->name}} </p>
                        <hr>
                        <p class="title-des">الموديل :  {{$car->model}}</p>
                        <hr>
                        <p class="title-des">سعر اليوم :  {{$car->price}}$</p>
=======
      {{-- <div class="container">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12" >
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">السيارة</th>
                                    <th scope="col">الموديل  </th>
                                    <th scope="col">سعر اليوم </th>
                                    @if($car->company)
                                    <th scope="col"> شركة </th>
                                    @endif
                                    @if($car->discount)
                                    <th scope="col"> الخصم </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td data-label="اسم السيارة">{{$car->name}}</td>
                                        <td data-label="موديل السيارة">
                                            {{$car->model}}
                                        </td>
                                        <td data-label="السعر"> {{$car->price}} </td>
                                        @if($car->company)
                                        <td>{{$car->company->name}}  </td>
                                        @endif
                                        @if($car->discount)

                                        <td> <ul>
                                            @foreach($car->discount as $discount)
                                                    <li>  %{{$discount->rate}}</li>
                                            @endforeach
                                            </ul>
                                        </td>


                                        @endif
                                    </tr>
                            </tbody>
                        </table>
>>>>>>> 7bcabcb142c75e0562e9283727ef6146fc3ac33e
                    </div>
                    <div class="col-lg-8 hight border borderr">
                        <p class="title-des">الخصم:</p>
                        <div class="boxes">
                            <div class="row">
                                @if($car->discount)
                                    @foreach($car->discount as $discount)
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
        </div> --}}




        <div class="container">
            <div class="row mt-5" >
                <div class="col-lg-12 ">
                    <div class="row">
                        <div class="col-lg-4 hight borderr border">
                            <p class="title-desS mt-2 ">  </p>
                            <p class="title-des">السيارة : {{$car->name}} </p>
                            <hr>
                            <p class="title-des">الموديل :  {{$car->model}}</p>
                            <hr>
                            <p class="title-des">سعر اليوم :  {{$car->price}}$</p>
                        </div>
                        <div class="col-lg-8 hight border borderr">
                            <p class="title-des">الخصم:</p>
                            <div class="boxes">
                                <div class="row">
                                    @if($car->discount)
                                        @foreach($car->discount as $discount)
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
            <form method="post" action="{{route('checkordercar')}}">
                @csrf
                <div class="row mb-5 form">
                    <input type="hidden" name="id" value="{{$car->id}}">
                    <div class="col-md-6 col-12 yas">
                        <input type="text" class="form-control" id="receivingplace"  name="receivingplace"  placeholder="موقع استلام السياره ">
                    </div>
                    <div class="col-md-6 col-12 yas">
                        <input type="text" class="form-control" id="deliveryplace"  name="deliveryplace"  placeholder="موقع تسليم السياره ">
                    </div>
                    <div class="col-md-6 col-12 yas">
                        <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
                    </div>
                    <div class="col-md-6 col-12 yas">
                        <input type="number" class="form-control" id="number" name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                    </div>
                    <div class="col-md-12 col-12 yas">
                        <input type="number" class="form-control" id="numberdays"  name="numberdays" placeholder="عدد الأيام ">
                    </div>
                    <div class="col-md-12 col-12 yas">
                        <label  class="form-group text-capitalize m-1 "> تاريخ الاستلام :</label>
                        <input type="date" class="form-control" id="date"  name="date" >
                    </div>
                    <div class="col-md-12 col-12 yas">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">احجز الان</button>

                    </div>
                </div>
            </form>
            <hr>
        </div>
<<<<<<< HEAD
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
        <form method="post" action="{{route('checkordercar')}}">
            @csrf
            <div class="row mb-5 form">
                <input type="hidden" name="id" value="{{$car->id}}">
                <div class="col-md-6 col-12 yas">
                    <input type="text" class="form-control" id="receivingplace"  name="receivingplace"  placeholder="موقع استلام السياره ">
                </div>
                <div class="col-md-6 col-12 yas">
                    <input type="text" class="form-control" id="deliveryplace"  name="deliveryplace"  placeholder="موقع تسليم السياره ">
                </div>
                <div class="col-md-6 col-12 yas">
                    <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
                </div>
                <div class="col-md-6 col-12 yas">
                    <input type="number" class="form-control" id="number" name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                </div>
                <div class="col-md-12 col-12 yas">
                    <input type="number" class="form-control" id="numberdays"  name="numberdays" placeholder="عدد الأيام ">
                </div>
                <div class="col-md-12 col-12 yas">
                    <label  class="form-group text-capitalize m-1 "> تاريخ الاستلام :</label>
                    <input type="date" class="form-control" id="date"  name="date" >
                </div>
                <div class="col-md-12 col-12 yas">
                <button type="submit" class="btn btn-primary btn-lg btn-block">احجز الان</button>

                </div>
            </div>
        </form>
        <hr>
    </div>
=======














>>>>>>> 7bcabcb142c75e0562e9283727ef6146fc3ac33e

@endsection
@section('js')
<script>
    function myFunction() {
            $(':button').prop('disabled', true);
        }
</script>

@endsection
