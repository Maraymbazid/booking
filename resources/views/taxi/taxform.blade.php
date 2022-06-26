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
                <div id="car1" class="carousel " data-ride="carousel">
                    <ol class="carousel-indicators" >
                        @foreach ($taxi->images as $i)
                        <li  data-target="#car1"   class='adaw @if( $loop->first == 1 ) active @endif'  data-slide-to="{{$i}}" > </li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($taxi->images as $i)
                        <div class="carousel-item  @if( $loop->first == 1 ) active @endif "  >
                            <div class="sosy"  style="background-image: url({{ url("/") . "/assets/admin/img/taxi/covers/" . $i->image}});" >
                            </div>
                        </div>
                        @endforeach>
                    </div>
                </div>

            </section>
@endsection







@section('content')
@include('layout.nav2')
<div class="title">
    {{$taxi->name}}
</div>
      <div class="container">
        <div class="container">
            <div class="row mt-5" >
                <div class="col-12" >
                    <p style="text-align:center;cursor: pointer; color:red; font-size:18px ">
                         <a style="margin-top:10px" type="button"  value='{{$taxi->id}}'  data-toggle="modal" data-target="#carImages">
                        <i class="far fa-images"></i> المزيد من الصور
                        </a>
                          <div class="modal fade" id="carImages" tabindex="-1"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                     <div class="modal-content " style="text-align:center">
                                        <p style="margin-top:10px">
                                            <i class="far fa-images"></i>  صور التاكسي
                                        </p>
                                        <div id="slideroom{{$taxi->id}}" class="carousel " data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($taxi->images as $i)
                                            <li   data-target="#slideroom{{$taxi->id}}"   class='adaw @if( $loop->first == 1 ) active @endif'  data-slide-to="{{ $loop->index }}" > </li>
                                            @endforeach

                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach ($taxi->images as $i)
                                            <div class="carousel-item  @if( $loop->first == 1 ) active @endif "  >
                                                <div class="sosy"  style="background-image: url({{ url("/") .  "/assets/admin/img/taxi/covers/" . $i->image}});" >
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                    </p>
                </div>
                <div class="col-lg-12 ">
                    <div class="row">
                        <div class="col-lg-12 hight borderr border">
                            <p class="title-desS mt-2 ">  </p>
                            <p class="title-des">اسم التاكسي  : {{$taxi->name}} </p>
                            <hr>
                            <p class="title-des">الموديل :  {{$taxi->model}}</p>
                            <hr>
                            <p class="title-des"> سعر الرحله  : حسب الواجهة</p>
                        </div>

                    </div>
                </div>
            </div>
            <h3 class="mayati-title mt-2">
                الحجز
            </h3>
                        <form method="post" id='taxForm' action="{{route('checkordertaxi')}}" enctype="multipart/form-data">
                            <div class="row mb-5 form">
                            @csrf
                            <input type="hidden" name="id" value="{{$taxi->id}}">
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 "> موقع  الاستلام :</label>
                                <input type="text" class="form-control" id="deliveryplace" v-model='deliveryplace'  name="deliveryplace" placeholder="موقع استلام السياره " >
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 "> اسم الشخص المعني بالحجز   :</label>
                                <input type="text" class="form-control" id="customrname" v-model='customrname' name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه" >
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">  تاريخ الوصول </label>
                                <input type="date" class="form-control" v-model='datearrive' id="datearrive" name="datearrive" placeholder="  من فضلك حدد ميعاد الوصول">
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">   رقم التليفون </label>
                                <input type="number" class="form-control" v-model='phone' id="phone" name="phone" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">  الواجهة  </label>
                                <select _ngcontent-c9="" class="form-control destinations" id="destination" v-model='destination' name="destination" data-dependent="price">
                                            <option value=""> اختار الواجهة من فضلك </option>
                                        @if($alldestinations && $alldestinations -> count() > 0)
                                            @foreach($alldestinations as $destination)
                                        <option
                                            value="{{$destination-> id }}">
                                            {{$destination-> name}} ------------------  محافظة {{$destination->gouvernement->name}}
                                        </option>
                                        @endforeach
                                    @endif
                                    </select>
                            </div>

                            <div class="col-md-6 col-12 yas" id="price" name="price">
                            </div>
                            <div class="col-md-12 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">   صورة التذكرة  </label>
                                <input type="file" class="form-control" id="ticket" @change="fileChange1" ref="image" name="ticket" placeholder=" من فضلك قم بإضافة صورة تذكرتك" >
                            </div>

                            <div class="col-md-12 col-12 ">
                                @if (session()->has('promomsg'))
                                <div class="alert alert-danger mt-5 " role="alert">
                                    {{ session()->get('promomsg') }}
                                </div>
                                @endif
                                <label  class="form-group text-capitalize m-1 ">   كود خصم  </label>
                                <input type="text" class="form-control"  name="promo" placeholder="كود خصم إن وجد ">

                            </div>

                            <div class="col-md-12 col-12 yas">
                                <button type="submit" @click='sendOrder' class="btn btn-primary btn-lg btn-block">احجز الان</button>
                            </div>

                        </div>
                        </form>
        </div>
        </div>



@endsection
@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>
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

    taxForm = new Vue({
            'el' : '#taxForm',
            'data' : {
                'numberdays' : '',
                'datearrive' : '',
                'customrname' : '',
                'phone' : '',
                'deliveryplace' : '',
                'receivingplace' : '',
                'destination' : '',

                'image' : '',
                'file1' : '',
                'erorrs' : []
            },
            methods :{
                fileChange1(event) {
                      this.file1 = this.$refs.image.files.length;
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

                    this.validation(this.file1 , '  صورة التذكرة من فضلك  ')
                    this.validation(this.destination , ' من فضلك اختر وجهه ')
                    this.validation(this.phone , 'رقم الواتساب  او التليجرام مطلوب ')
                    this.validation(this.datearrive , '  التاريخ  مطلوب ')
                    this.validation(this.customrname , 'الاسم مطلوب ')
                    this.validation(this.deliveryplace , '  موقع استلام التاكسي مطلوب ')
                    if (this.erorrs.length != 0) {
                        e.preventDefault();
                    }
                }
            }
        });



 $('.destinations').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getpricedestination') }}",
                    data: {
                        'id': value,
                        'dependent': dependent,
                        '_token': "{{csrf_token()}}",
                    },
                    success: function(result) {
                        $('#' + dependent).html(result);
                    },
                    error: function (reject) {
                       console.log('error');
                    }

                });
            }
        });
</script>
@endsection
