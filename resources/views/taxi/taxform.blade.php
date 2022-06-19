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
            @foreach ($taxi->images as $i)
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
    {{$taxi->name}}
</div>
      <div class="container">
        <div class="container">
            <div class="row mt-5" >
                <div class="col-lg-12 ">
                    <div class="row">
                        <div class="col-lg-12 hight borderr border">
                            <p class="title-desS mt-2 ">  </p>
                            <p class="title-des">اسم التاكسي  : {{$taxi->name}} </p>
                            <hr>
                            <p class="title-des">الموديل :  {{$taxi->model}}</p>
                            <hr>
                            <p class="title-des"> سعر الرحله  :  {{$taxi->price}}$</p>
                        </div>

                    </div>
                </div>
            </div>
            <h3 class="mayati-title mt-2">
                الحجز
            </h3>
                        <form method="post" action="{{route('checkordertaxi')}}" enctype="multipart/form-data">
                            <div class="row mb-5 form">
                            @csrf
                            <input type="hidden" name="id" value="{{$taxi->id}}">
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 "> موقع  الاستلام :</label>
                                <input type="text" class="form-control" id="deliveryplace"  name="deliveryplace" placeholder="موقع استلام السياره " >
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 "> اسم الشخص المعني بالحجز   :</label>
                                <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه" >
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">  تاريخ الوصول </label>
                                <input type="date" class="form-control" id="datearrive" name="datearrive" placeholder="  من فضلك حدد ميعاد الوصول">
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">   رقم التليفون </label>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                            </div>
                            <div class="col-md-12 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">  الواجهة  </label>
                                <select _ngcontent-c9="" class="form-control destinations" id="destination" name="destination" data-dependent="price">
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

                            <div class="col-md-12 col-12 " id="price" name="price">
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">   صورة التذكرة  </label>
                                <input type="file" class="form-control" id="ticket" name="ticket" placeholder=" من فضلك قم بإضافة صورة تذكرتك" >
                            </div>
                            <div class="col-md-6 col-12 yas">
                                <label  class="form-group text-capitalize m-1 ">  معها سائق    </label>
                                    <select id="chauffeur" name="chauffeur" class="form-control">
                                        <option selected>هل تريد سائق مع السياره أم لا </option>
                                        <option value="1"> نعم </option>
                                        <option value="0"> لا  </option>
                                    </select>
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
                                <button type="submit" class="btn btn-primary btn-lg btn-block">احجز الان</button>
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
</script>
<script>

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
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
