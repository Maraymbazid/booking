@extends('layout.lay')
@section('css')
<style>

.parent {
    display: flex;

    margin: 20px auto;
    /* border: 2px solid #112034; */
    background-color: rgba(0, 16, 48, 0.80);
    padding: 35px 30px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.parent * {
    /* flex-basis: calc(98% / 4); */
    /* margin-bottom: 13px; */
    border-radius: 5px;
    border: none;
    padding: 10px 15px;
    color: #999;
    margin: 10px auto;
}
.img-back img{
    width: 100%;
}
    .title-des-left{
    text-align: center;
    margin: 0;
}
.para{
    margin: 0;
    padding: 2px;
    max-width:80px;
    color:red;
    font-size:16px;
    background-color: yellow;
}
.info{
    font-size: 12px;
    color: #888;
}
.border{
    border: 1px solid #888;
}
.boxes , .photo{
    padding: 5px;
    overflow: hidden;
}

.ul li{
    list-style: none;
    margin-top: 10px;
    color: #888;
}
.description{
    display: inline;
}
.hight{
 max-height: 250px;
 overflow: hidden;
}
@media screen and (max-width: 1000px) {
    .ul li{
        display: inline;
    }
    .ul{
        margin: 10px 15%;
    }
  }

@media screen and (max-width:710px){
    .option-description{
        margin-top:65px;
    }
    .ul{
        display: inline-block;
    }
    .ul li{
        display: block;
        padding:0;
    }
    .ul li li{
        display: block;
    }
}
.blo{
    display: block;
}
.empty input{
    height: 40px;
    border-radius: 10px;
    padding-right: 5px;
}
.empty button{
    height: 40px;
    border-radius: 10px;
    display: inline-block;
}
.empty label{
    padding:5px;
    background-color:rgb(228, 222, 222);
}
</style>
@endsection
@section('content')


        <div class="option pb-5"  >
            <div class="image-option-games">
                <img src="{{$hotel->cover}}" width="100%" ;
                    style="border-radius: 25px 25px 0px 0px;">
            </div>
            <div class="option-description"  id='content'>
                <p class="option-text"> </p>
                @if (session()->has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session()->get('success') }}
                </div>
                @elseif (session()->has('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session()->get('error') }}
                </div>
                @endif
                <hr>


                <table>
                    <thead>
                        <tr>




                        </tr>
                    </thead>
                    <tbody>

                        <tr scope="row"><td colspan="4">
                            {{$hotel->name_ar}}


                            </td></tr>


                    </tbody>
                </table>
                <div class="container" >
                    <div class="row">
                        @foreach ($main_services as $main)
                        <div class="col-3">
                            <ul class='ul'  style="text-align: right"> <i class="fa-solid {{$main->font_aws}}"></i> {{$main->name}}
                                @foreach ($hotel->SubServices as $hsub)
                                    @if($hsub->MainSer->id == $main->id )
                                    <li style="text-align: right">
                                        {{  $hsub->name}}
                                    </li>
                                    @endif
                                    @endforeach
                            </ul>
                        </div>
                        @endforeach

                    </div>
                </div>


                <div class="container" >
                    <div class="row">
                        <form  class="parent">
                       <input  type="text" v-model='name' placeholder=" تأكيد الحجز بأسم">
                       <input  type="number" v-model="whtsapp" placeholder=" رقم واتساب للتواصل   ">
                        <input type='number' @change='setDate' v-model='daycount' placeholder="عدد الأيام">
                         <input  type='date' @change='setDate' v-model='arrival'  placeholder="تاريخ الوصول"><br>
                         <input disabled  type='date' v-model='checkout' placeholder="تاريخ المغادرة">
                        </form>


                    </div>

                    <div class="row  mt-5 mx-1" v-for='room in v2'>
                            <div :id="'slide'+room.id" class="carousel slide mb-2" data-ride="carousel" >
                                <div class="container" >
                                    <div class="carousel-inner col-lg-6">
                                        <div class="carousel-item " v-bind:class='{active:index == 0 }' v-for='(i , index) in room.images'>
                                          <img :src="i.name" class="d-block w-100 " alt="..." style='max-height:250px' >
                                        </div>
                                      </div>
                                </div>
                                <button class="carousel-control-prev" type="button" :data-target="'#slide'+ room.id" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" :data-target="'#slide'+ room.id" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </button>
                              </div>

                        <div class="col-lg-3 border ">
                            <div class="row" style='height:200px; background-size: cover' v-bind:style="{ backgroundImage: 'url(' + room.images[0].name + ')' }" >
                            </div>
                        </div>
                        <div class="col-lg-9 ">

                            <div class="row">

                                <div class="col-lg-5 hight border">
                                    <p class="title-des mt-3 "> @{{room.name_ar}} </p>
                                    {{-- <p class="title-des">يشمل الحجز:</p> --}}
                                    <div class="boxes">
                                        <div class="row">
                                            <div class="para col-lg-6 col-3 m-1" v-for='r in room.discount'>
                                                <p class="title-des-left p-1">   خصم @{{r.discount}}%     </p>
                                            </div>
                                        </div>

                                        <ul class="ul">
                                            <button type="button" @click='getSer(room.id)' :value='room.id' class="btn btn-primary mt-3" data-toggle="modal" :data-target="'#'+ 'togle'+room.id">
                                                مميزات الغرفة
                                          </button>
                                                <div class="modal fade" :id="'togle'+room.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach(\App\Models\Admin\NameServices::all() as $main2)
                                                            <li>
                                                                {{$main2->name}}
                                                                <li v-for='ser in room.services'  v-if='ser.name_id === {{$main2->id}}'>
                                                                        @{{ser.name}}
                                                                </li>
                                                                </li>
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
                                        <p class="money"><i class="fa-solid fa-bed"></i>     @{{room.beds}}</p>
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
                                        <p class="title-des">المجموع للإقامة:</p>
                                        <p class="how"  >  @{{daycount *  room.price}} $</p>
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
                                        <button type="submit" @click='sendOrder' class="btn btn-danger mt-2">احجز الان </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row  mx-5">


                        <div class="col-lg-12 ">
                            <div class="row">
                                <div class="col-lg-1 hight  p-1"> <h4> تفاصيل الحجز </h4></div>
                                <div class="col-lg-6 hight ">

                                    <div class="boxes">
                                        <div class="row">
                                            <div class="col-lg-12 col-12 empty">
                                                <label class="" > : عدد الاشخاص  </label>
                                                <input type="text" class="">
                                                <button type="button" class="btn btn-danger  "> + </button>
                                                <button type="button" class="btn btn-danger "> - </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="boxes">
                                        <div class="row">
                                            <div class="col-lg-12 col-12 empty">
                                                <label class="ml-2" > : عدد الايام  </label>
                                                <input type="text" class="">
                                                <button type="button" class="btn btn-danger  "> + </button>
                                                <button type="button" class="btn btn-danger "> - </button>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-lg-3 hight ">
                                    <p class="title-des">المجموع للإقامة:</p>
                                    <div class="boxes">
                                        <p class="how">{{$room->price}} $</p>
                                        <span class="info">
                                            <i class="fa-solid fa-circle-info"></i>
                                            المبلغ الإجمالي ل 1 ليلة (شاملاً ضريبة القيمة المضافة)
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-2 hight ">
                                    <p class="title-des">حجز:</p>
                                    <div class="boxes">
                                        <button type="button" class="btn btn-danger">احجز الان</button>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> --}}



                    <iframe class='mt-5' src='{{$hotel->location}}' width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            </div>
        </div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>

            $(document).ready(function(){
                $('.carousel').carousel()

            })


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
                'erorrs' : []
            },
            methods:{

                getSer: function(e){
                console.log(e);
                },
                getMainServicesRoom:function(){
                },
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
