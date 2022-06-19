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
    .big{
    font-size: 16px;
    font-weight: bold;
    }
</style>
@endsection

@section('moving-image')
<section aria-label="Newest Photos">
        <div class="carousel" data-carousel>
            <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
            <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
          <ul data-slides>
            @foreach ($salle->images as $i)
            <li class="slide" @if( $loop->first == 1 )data-active @endif  >
                <img src="{{ url("/") . "/assets/admin/img/apartements/covers/" . $i->image}} " alt="nature image #1" />
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
    {{$salle->name_ar}}
</div>
<div class="container" id='meeting'>
<hr>
    <h3 class="mayati-title">
        معلومات القاعة
    </h3>
    <div class="row mt-5" >

        <div class="col-lg-12 ">
            <div class="row">
                <div class="col-lg-4 hight borderr border pb-1">
                    <p class="title-des"><span clss="big"><i class="fa-solid fa-file-signature"></i> اسم القاعة : </span> {{$salle->name_ar}} </p>
                    <hr>
                    <p class="title-des"><span clss="big"><i class="fa-solid fa-minimize"></i> حجم القاعة : </span>  {{$salle->area}}</p>
                    <hr>
                    <p class="title-des"><span clss="big"><i class="fa-solid fa-money-bill-wave"></i> سعر الساعة : </span>  {{$salle->price}} $</p>
                </div>
                <div class="col-lg-5 hight borderr border">
                    <p class="title-des"><span clss="big" style=""><i class="fa-solid fa-audio-description"></i> تفاصيل اضافية : </span>{{$salle->description_ar}} </p>
                    <hr>
                    <p class="title-des"><span clss="big"><i class="fa-solid fa-arrow-down-1-9"></i> تتسع لـ  : </span>{{$salle->guest}}</p>
                    <hr>
                    <p class="title-des"><span clss="big"><i class="fa-solid fa-location-dot"></i> العنوان : </span> {{$salle->address_ar}} </p>
                </div>
                <div class="col-lg-3 hight border borderr">
                    <p class="title-des">النوع :{{$salle->type}}</p>
                    <hr>
                    <p class="title-des"> المميزات :</p>
                    @if($salle->services)
                    @foreach($salle->services as $s)
                    <ul>
                        <li>{{$s->name}}</li>
                    </ul>

                @endforeach
                    @endif

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
    <form method="post" action="{{route('meetCheckOrder')}}">
        @csrf
        <div class="row mb-5 form">
            <input type="hidden" name="id" value="{{$salle->id}}">
            <div class="col-md-6 col-12 yas">
                <label  class="form-group text-capitalize m-1 "> تاريخ الحجز :</label>
                <input type="date" class="form-control"   name="date" v-model='date'  placeholder="تاريخ الحجز ">
            </div>
            <div class="col-md-6 col-12 yas">
                <label  class="form-group text-capitalize m-1 ">  بداية الحجز :</label>
                <input type="time" class="form-control"  name="start_time"   v-model="start_time" placeholder=" وقت الحجز  ">
            </div>
            <div class="col-md-6 col-12 yas">
                <label  class="form-group text-capitalize m-1 ">  عدد الساعات  :</label>
                <input type="number" class="form-control" name="hours"  v-model="hours" placeholder="عدد الساعات ">
            </div>
            <div class="col-md-6 col-12 yas">
                <label  class="form-group text-capitalize m-1 ">  نهاية الوقت  :</label>
                <input type="time" class="form-control"   name="end_time"   v-model="end_time" placeholder="نهاية الوقت  ">
            </div>
            <div class="col-md-6 col-12 yas">
                <input type="text" class="form-control"   name="numberdays"  v-model="numberdays" placeholder="   من فضلك ادخل عدد الايام اذا وجد">
            </div>
            <div class="col-md-6 col-12 yas">
                <input type="number" class="form-control"  name="number" v-model='number' placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
            </div>
            <div class="col-md-12 col-12 yas">
                <input type="number" class="form-control"  name="persones" v-model="persones" placeholder=" من فضلك ادخل   عدد الأشخاص  ">
            </div>
            <div class="col-md-12 col-12 yas">
                {{-- <label  class="form-group text-capitalize m-1 "> تاريخ الاستلام :</label> --}}
                <input type="text" class="form-control"   name="customername"  v-model="customername" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه" >
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
meting = new Vue({
    'el' : '#meeting',
    'data' : {
        'date' : '',
        'start_time' : '',
        'hours':'',
        'end_time' : '',
        'numberdays' : '',
        'number' : '',
        'persones' : '',
        'customername' : '',
        'erorrs' : []
    },
    methods:{
        setDate:function(){
            if(this.start_time == '')
                return;
            this.end_time = ''
            let firstdate = new Date().setHours( this.start_time );
            // test =  firstdate.getTime(this.start_time)
            console.log(firstdate)
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
            // e.preventDefault();
            this.erorrs  = []
            this.validation(this.customername , ' اسم العميل مطلوب   ')
            this.validation(this.persones , ' عدد الاشخاص مطلوب ')
            this.validation(this.number , 'رقم الواتساب  او التليجرام مطلوب ')
            this.validation(this.end_time , 'نهاية الوقت مطلوب')
            this.validation(this.hours , '  عدد الساعات مطلوب   ')
            this.validation(this.start_time , '  بداية الوقت مطلوب  ')
            this.validation(this.date , ' التاريخ مطلوب')
            if (this.erorrs.length != 0) {
                e.preventDefault();
            }
        }
    }
});

</script>
<script>
    function myFunction() {
            $(':button').prop('disabled', true);
        }
</script>

@endsection
