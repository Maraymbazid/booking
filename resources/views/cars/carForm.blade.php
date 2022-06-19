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
<section aria-label="Newest Photos">
        <div class="carousel" data-carousel>
            <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
            <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
          <ul data-slides>
            @foreach ($car->images as $i)
            <li class="slide" @if( $loop->first == 1 )data-active @endif  >
                <img src="{{ url("/") . "/assets/admin/img/cars/covers/" . $i->image}} " alt="nature image #1" />
            </li>
            @endforeach>
          </ul>
          </div>
          </div>
        </div>
    </section>
@endsection

@section('content')
@include('layout.nav2')
<div class="title">
    {{$car->name}}
</div>
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
                    </div>
                    </div>

                    <div class="row mt-5">
                    <div class="col">
                        <form method="post" action="{{route('checkordercar')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$car->id}}">
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">موقع إستلام السياره </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="receivingplace"  name="receivingplace"  placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">موقع تسليم السياره </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="deliveryplace"  name="deliveryplace"  placeholder="موقع تسليم السياره ">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  المده </label>
                                <div class="col-md-10 col-12">
                                  <input type="number" class="form-control" id="numberdays"  name="numberdays" placeholder="  من فضلك ادخل عدد الايام ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  تاريخ الاستلام </label>
                                <div class="col-lg-10 col-12">
                                  <input type="date" class="form-control" id="date"  name="date" placeholder="  من فضلك حدد ميعاد استلام السيارة">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  رقم التليفون </label>
                                <div class="col-lg-10 col-12">
                                     <input type="number" class="form-control" id="number" name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  اسم الشخص المعني بالحجز </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">       </label>
                                <div class="col-lg-10 col-12 p-2">
                                       <button type="sumbit" class="btn btn-primary p-1 form-control" > أطلب الان  </button>
                                </div>
                            </div>
                          </form>
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
                            <p class="title-des">السعر  {{$car->meth}} :  {{$car->price}}$</p>
                        </div>
                        <div class="col-lg-8 hight border borderr">
                            <p class="title-des">الخصم:</p>
                            <div class="boxes">
                                <div class="row">
                                    @if($car->discount)
                                        @foreach($car->discount as $discount)
                                        <div class="para col-lg-3 col-3 m-1" >
                                        <p class="title-des-left p-1">
                                        %{{$discount->rate}} => لـ   {{$discount->number_days}} {{$car->dis}}
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
            <form method="post" id='carform' action="{{route('checkordercar')}}">
                @csrf
                <div class="row mb-5 form">
                    <input type="hidden" name="id" value="{{$car->id}}">
                    <div class="col-md-6 col-12 yas">
                        <input type="text" class="form-control" id="receivingplace"  v-model='receivingplace' name="receivingplace"  placeholder="موقع استلام السياره ">
                    </div>
                    <div class="col-md-6 col-12 yas">
                        <input type="text" class="form-control" id="deliveryplace" v-model='deliveryplace'  name="deliveryplace"  placeholder="موقع تسليم السياره ">
                    </div>
                    <div class="col-md-6 col-12 yas">
                        <input type="text" class="form-control" id="customrname"  v-model='customrname' name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
                    </div>
                    <div class="col-md-6 col-12 yas">
                        <input type="number" class="form-control" id="number" v-model='number' name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                    </div>
                    <div class="col-md-12 col-12 yas">
                        <input type="number" class="form-control" id="numberdays" v-model='numberdays'  name="numberdays" placeholder=" {{$car->inp}} ">
                    </div>
                    <div class="col-md-12 col-12 yas">
                        <label  class="form-group text-capitalize m-1 "> تاريخ الاستلام :</label>
                        <input type="date" class="form-control" id="date"  v-model='date' name="date" >
                    </div>
                    <div class="col-md-12 col-12 yas">
                    <button type="submit" @click='sendOrder' class="btn btn-primary btn-lg btn-block">احجز الان</button>

                    </div>
                </div>
            </form>
            <hr>
        </div>















@endsection

@section('js')
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>
    function myFunction() {
            $(':button').prop('disabled', true);
        }
    const buttons = document.querySelectorAll(
    '[data-carousel-button]'
    );
    buttons.forEach((button) => {
    button.addEventListener('click', () => {
        const offset =
        button.dataset.carouselButton === 'next'
            ? 1
            : -1;
        const slides = button
        .closest('[data-carousel]')
        .querySelector('[data-slides]');

        const activeSlide = slides.querySelector(
        '[data-active]'
        );
        let newIndex =
        [...slides.children].indexOf(activeSlide) +
        offset;
        if (newIndex < 0)
        newIndex = slides.children.length - 1;
        if (newIndex >= slides.children.length)
        newIndex = 0;
        slides.children[ newIndex].dataset.active = true;
        delete activeSlide.dataset.active;
    });
    });

    carform = new Vue({
            'el' : '#carform',
            'data' : {
                'numberdays' : '',
                'date' : '',
                'customrname' : '',
                'number' : '',
                'deliveryplace' : '',
                'receivingplace' : '',
                'erorrs' : []
            },
            methods :{

                validation:function(el , msg){
                    if(el == ''){
                        this.erorrs.push({
                            'err' : 'err'
                        });
                        swal({
                                title:  msg,
                                type: 'warning',
                                confirmButtonText: 'error',
                            });
                        return 0;
                    }
                },
                sendOrder: function(e){
                    this.erorrs  = []
                    this.validation(this.date , '  التاريخ  مطلوب ')
                    this.validation(this.numberdays , ' عدد الايام مطلوب ')
                    this.validation(this.number , 'رقم الواتساب  او التليجرام مطلوب ')
                    this.validation(this.customrname , 'الاسم مطلوب ')
                    this.validation(this.deliveryplace , '  موقع تسليم السياره مطلوب ')
                    this.validation(this.receivingplace , '  موقع استلام السياره مطلوب ')
                    if (this.erorrs.length != 0) {
                        e.preventDefault();
                    }
                }
            }
        });


</script>


@endsection

