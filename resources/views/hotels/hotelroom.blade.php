@extends('layout.flay')

@section('moving-image')
<section aria-label="Newest Photos">
        <div class="carousel" data-carousel>
            <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
            <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
          <ul data-slides>
            @foreach ($hotel->images as $i)
            <li class="slide" @if( $loop->first == 1 )data-active @endif  >
                <img src="{{ url("/") . "/assets/admin/img/Hotels/covers/" . $i->image}} " alt="nature image #1"  />
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
    {{$hotel->name_ar}}
</div>
                <div class="container" >
                    <div class="row">
                        @foreach ($main_services as $main)
                        <div class="col-md-3 col-4 mt-3">
                            <ul class='ul'  style="text-align:center"> <i class="fa-solid {{$main->font_aws}}"></i> {{$main->name}}
                                @foreach ($hotel->SubServices as $hsub)
                                    @if($hsub->MainSer->id == $main->id )
                                    <li >
                                        {{  $hsub->name}}
                                    </li>
                                    @endif
                                    @endforeach
                            </ul>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div id='content' >
                    <div class="mayati">
                        <div class="container">
                            <h3 class="mayati-title">
                                إملأ البيانات ثم اختر الغرفه (الخصم يطبق فى الصفحة التالية)
                            </h3>
                            <div class="row mb-5 form">
                                    <div class="col-md-6 col-12 ">
                                        <label  class="form-group text-capitalize m-1 "> الاسم</label>
                                        <input v-model='name' type="text" class="form-control" placeholder=" تأكيد الحجز باسم" >
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label  class="form-group text-capitalize m-1 "> الواتساب </label>
                                        <input v-model="whtsapp" type="text" class="form-control" placeholder=" الواتساب" >
                                    </div>
                                    <div class="col-md-12 col-12 yas">
                                        <label  class="form-group text-capitalize m-1 "> عدد الايام </label>
                                        <input @change='setDate' v-model='daycount' type="number" class="form-control" placeholder="عدد الايام " >
                                    </div>
                                    <div class="col-md-6 col-12 yas">
                                        <label  class="form-group text-capitalize m-1 "> تاريخ الوصول :</label>
                                        <input type='date' @change='setDate' v-model='arrival' type="date" class="form-control" placeholder="Last name" >
                                    </div>
                                    <div class="col-md-6 col-12 yas">
                                        <label  class="form-group text-capitalize m-1 "> تاريخ المغادرة :</label><br>
                                        <input disabled  type='date' v-model='checkout' type="number" class="form-control" placeholder="Last name" >
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                    <div class="row mt-5" v-for='room in v2'>
                        <div class="col-lg-3 border ">
                            <div class="row" style='height:200px; background-size: cover' v-bind:style="{ backgroundImage: 'url(' + room.images[0].name + ')' }" >
                            </div>
                            <p style="text-align:center;cursor: pointer; color:red; font-size:18px ">
                                            <a style="margin-top:10px" type="button" @click='getSer(room.id)' :value='room.id'  data-toggle="modal" :data-target="'#'+ 'image'+room.id">
                                            <i class="far fa-images"></i> المزيد من الصور
                                            </a>
                                                <div class="modal fade" :id="'image'+room.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content " style="text-align:center">
                                                            <p style="margin-top:10px">
                                                                <i class="far fa-images"></i>  صور الغرفه
                                                            </p>
                                                            <div :id="'slide'+room.id" class="carousel " data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    <div class="carousel-item roomim" v-bind:class='{active:index == 0 }' v-for='(i , index) in room.images' style='height:400px;background-size: cover;background-position: center center;'  v-bind:style="{ backgroundImage: 'url(' + i.name + ')' }" >

                                                                    </div>
                                                                </div>
                                                                <a class="carousel-control-prev" :href="'#slide'+ room.id" role="button" data-slide="prev">
                                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" :href="'#slide'+ room.id" role="button" data-slide="next">
                                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                            </p>
                        </div>
                        <!-- <div v-show='adawe' class="pop">
                        hiiiiiiiiiiii
                        </div> -->
                        <div class="col-lg-9 ">

                            <div class="row">

                                <div class="col-lg-5 hight border">
                                    <p class="title-desS mt-2 "> @{{room.name_ar}} </p>
                                    <p class="title-des">خصم :</p>
                                    <div class="boxes">
                                        <div class="row">
                                            <div class="para col-lg-3 col-3 m-1" v-for='r in room.discount'>
                                                <p class="title-des-left p-1">
                                                    @{{r.discount}}% لـ  @{{r.day_count}}أيام
                                                </p>
                                            </div>
                                        </div>

                                        <ul class="ul">
                                            <button type="button" @click='getSer(room.id)' :value='room.id' class="btn btn-success btn-lg btn-block mt-3" data-toggle="modal" :data-target="'#'+ 'togle'+room.id">
                                                مميزات الغرفة
                                            </button>


                                                    <div class="modal fade" :id="'togle'+room.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"> @{{room.name_ar}} </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @foreach(\App\Models\Admin\NameServices::all() as $main2)
                                                                <ul>
                                                                <h5> {{$main2->name}} </h5>
                                                                    <li v-for='ser in room.services'  v-if='ser.name_id === {{$main2->id}}'>
                                                                        @{{ser.name}}
                                                                    </li>
                                                                </ul>
                                                                @endforeach
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                {{-- @endforeach --}}
                                                {{-- <li><i class="fa-solid fa-wifi"></i> واي فاي </li>
                                                <li><i class="fa-solid fa-fan"></i> تكييف </li>
                                                <li><i class="fa-solid fa-tv"></i> تلفزيون </li> --}}
                                        </ul>
                                    </div>
                                </div>


                                <div class="col-lg-2 hight border">
                                    <p class="title-des">النزلاء:</p>
                                    <div class="boxes">
                                        <p class="money"><i class="fa-solid fa-user"></i> تتسع لـ @{{room.adults}}</p>
                                        <p class="money"><i class="fas fa-child"></i></i> تتسع لـ @{{room.children}}</p>
                                        <p class="money"><i class="fa-solid fa-bed"></i>    @{{room.beds}}</p>
                                        <p class="money"><i class="fa-solid fa-minimize"></i> @{{room.area}}  م  </p>
                                        <p class="money" v-if="room.internet == 1" >  <i class="fa-solid fa-wifi"></i>   متوفر</p>
                                    </div>
                                </div>


                                <div class="col-lg-3 hight border">
                                    <p class="title-des">تكلفة اليوم :</p>
                                    <div class="boxes">
                                        <p class="how"  >  @{{room.price}} $</p>
                                        <span class="info">
                                            <i class="fa-solid fa-circle-info"></i>
                                            المبلغ الإجمالي ل 1 ليلة (شاملاً ضريبة القيمة المضافة)
                                        </span>
                                        <hr>
                                        <span class="title-des">المجموع للإقامة:</span>  <span>@{{daycount *  room.price}}</span>

                                    </div>
                                </div>
                                <div class="col-lg-2 hight border">
                                <p class="title-des">حجز:</p>
                                    <form class="boxes" action="{{route('hotelorder',$hotel->id )}}" method="POST" >
                                    <div style="display: none">
                                        @csrf
                                        <input type="text"  name='name' v-model="name" value="">
                                        <input type="text"  name='daycount' v-model="daycount" value="">
                                        <input type="text"  name='arrival' v-model="arrival" value="">
                                        <input type="text"  name='checkout' v-model="checkout" value="">
                                        <input type="text"  name='whtsapp' v-model="whtsapp" value="">
                                        <input type="text"  name='roomId'  :value="room.id">
                                    </div>
                                        <button type="submit" @click='sendOrder' class="btn btn-danger mt-2 ">احجز الان </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                        <div class="title mt-3">
                            مكان الفندق
                        </div>
                        <div class="container">

                        <iframe class='mt-5' src='{{$hotel->location}}' width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>


                </div>
            </div>
        </div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>
            $(document).ready(function(){
                $('.carousel').carousel()
            })
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

        slides.children[
        newIndex
        ].dataset.active = true;
        delete activeSlide.dataset.active;
    });
    });
        hotels = new Vue({
            'el' : '#content',
            'data' : {
                'v1' : '{!! $hotel !!}',
                'v2' : JSON.parse('{!! $rooms !!}'),
                'daycount' : '',
                'arrival' : '',
                'checkout':'',
                'name' : '',
                'whtsapp' : '',
                'adawe' : false,
                'erorrs' : []
            },
            methods:{
                setDate:function(){
                    if(this.arrival == '')
                        return;
                    this.checkout = ''
                    let firstdate = new Date(this.arrival);
                    out = new Date(firstdate.setDate(firstdate.getDate() + parseInt(this.daycount) )).toISOString().slice('.')
                    let out2 = out.split('T');
                    this.checkout = out2[0]
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
                    this.validation(this.checkout , 'من فضلك تأكد من عدد الايام وتاريخ الوصول ')
                    this.validation(this.arrival , ' تاريخ الوصول مطلوب ')
                    this.validation(this.daycount , ' عدد الايام مطلوب ')
                    this.validation(this.whtsapp , 'رقم الواتساب  او التليجرام مطلوب ')
                    this.validation(this.name , 'الاسم مطلوب ')
                    if (this.erorrs.length != 0) {
                        e.preventDefault();
                    }
                }
            }
        });
    function myFunction() {
            $(':button').prop('disabled', true);
        }
</script>

@endsection
