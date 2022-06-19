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
            @foreach ($villa->images as $i)
            <li class="slide" @if( $loop->first == 1 )data-active @endif  >
                <img src="{{ url("/") . "/assets/admin/img/villas/covers/" . $i->image}} " alt="nature image #1" />
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
    {{$villa->name_ar}}
</div>


<div class="container">
    <div class="row mt-5" >
        <div class="col-lg-12 ">
            <div class="row">
                <div class="col-lg-4 hight borderr border">
                    <p class="title-desS mt-2 ">  </p>
                    <p class="title-des"><i class="fa-solid fa-person"></i> الاسم  :{{$villa->name_ar}} </p>
                    <hr>
                    <p class="title-des"><i class="fa-solid fa-layer-group"></i> المساحة : {{$villa->area}} </p>
                    <hr>
                    <p class="title-des"><i class="fa-solid fa-sack-dollar"></i> سعر اليوم :  {{$villa->price}} $</p>
                    <hr>

                    <p class="title-des"><i class="fa-solid fa-file-waveform"></i> الوصف  :  {{$villa->description_ar}} </p>
                    <hr>

                    <p class="title-des"> <i class="fa-solid fa-location-dot"></i> العنوان  :  {{$villa->address_ar}} </p>
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
                            @if($villa->discounts)
                            @foreach($villa->discounts as $discount)
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
                            @if($villa->services)
                          @foreach($villa->services as $service)
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
    <hr>
    <h3 class="mayati-title">
        الحجز
    </h3>
    <form method="post" id='villatform' action="{{route('checkordervilla')}}">
        @csrf
                    <div class="row mb-5 form">
                        <input type="hidden" name="id" value="{{$villa->id}}">
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> تاريخ القدوم  </label>
                            <input @change='setDate' type="date" class="form-control" id="begindate" v-model='arrival'   name="begindate"  placeholder="تاريخ القدوم ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> المده </label>
                            <input @change='setDate' type="number" class="form-control" id="numberdays" v-model='daycount'  name="numberdays" placeholder="  من فضلك ادخل عدد الايام ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> تاريخ الخروج  </label>
                            <input type="date" class="form-control" id="enddate"  disabled v-model='enddate' name="enddate"  placeholder="تاريخ الخروج ">
                            <input style="display: none" type='text' v-model='enddate' name="enddate" value='' >
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> رقم التليفون </label>
                            <input type="number" class="form-control" id="number" v-model='whtsapp'  name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 "> عدد  الأشخاص   </label>
                            <input type="number" class="form-control" id="persones" v-model='persones' name="persones" placeholder=" من فضلك ادخل   عدد الأشخاص  ">
                        </div>
                        <div class="col-md-6 col-12 yas">
                            <label  class="form-group text-capitalize m-1 ">  اسم الشخص المعني بالحجز </label>
                            <input type="text" class="form-control" id="customrname"  v-model='customrname' name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
                        </div>
                        <div class="col-md-12 col-12 yas">
                            <button type="submit" @click='sendOrder' class="btn btn-primary btn-lg btn-block">احجز الان</button>
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

    villatform = new Vue({
            'el' : '#villatform',
            'data' : {
                'daycount' : '',
                'arrival' : '',
                'enddate':'',
                'customrname' : '',
                'whtsapp' : '',
                'persones' : '',
                'erorrs' : []
            },
            methods :{
                setDate:function(){
                    if(this.arrival == '')
                        return;
                    this.enddate = ''
                    let firstdate = new Date(this.arrival);
                    out = new Date(firstdate.setDate(firstdate.getDate() + parseInt(this.daycount) )).toISOString().slice('.')
                    let out2 = out.split('T');
                    this.enddate = out2[0]
                },
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
                    this.validation(this.customrname , 'الاسم مطلوب ')
                    this.validation(this.persones , 'من فضلك تأكد من عدد  الاشخاص  ')
                    this.validation(this.whtsapp , 'رقم الواتساب  او التليجرام مطلوب ')
                    this.validation(this.checkout , 'من فضلك تأكد من عدد الايام وتاريخ الوصول ')
                    this.validation(this.daycount , ' عدد الايام مطلوب ')
                    this.validation(this.arrival , ' تاريخ الوصول مطلوب ')

                    if (this.erorrs.length != 0) {
                        e.preventDefault();
                    }
                }
            }
        });


</script>


@endsection
