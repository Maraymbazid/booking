
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
@include('layout.nav')
<div class="section">
    <div class="moving-image"   style="background-image: url({{$taxi->image}});"></div>
</div>
@section('content')
@include('layout.nav2')
<div class="title">
    {{$taxi->name}}
</div>
      <div class="container">



        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12" >
                <table>
                    <thead>
                        <tr>
                            <th scope="col">السيارة</th>
                            <th scope="col">الموديل  </th>
                            <th scope="col"> شركة </th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="post" onsubmit="myFunction()"
                            {{-- action="{{ route('ordercheck', ['one' =>  encrypt(), 'tow' =>  encrypt()]) }}" --}}
                            enctype="multipart/form-data">
                            @csrf
                            <tr>
                                <td data-label="اسم السيارة">{{$taxi->name}}</td>
                                <td data-label="موديل السيارة">
                                    {{$taxi->model}}
                                </td>
                                <td>{{$taxi->company->name}}  </td>

                            </tr>
                        </form>
                    </tbody>
                </table>
                <div class="container">
                    <div class="row mt-5">
                    <div class="col">
                        <form method="post" action="{{route('checkordertaxi')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$taxi->id}}">
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">موقع إستلام السياره </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="deliveryplace"  name="deliveryplace" placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  اسم الشخص المعني بالحجز </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  تاريخ الوصول </label>
                                <div class="col-lg-10 col-12">
                                  <input type="date" class="form-control" id="datearrive" name="datearrive" placeholder="  من فضلك حدد ميعاد الوصول">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  رقم التليفون </label>
                                <div class="col-lg-10 col-12">
                                     <input type="number" class="form-control" id="phone" name="phone" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  الواجهة  </label>
                                <div class="col-lg-10 col-12">
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
                            </div>
                            <div class="form-group row mb-2" id="price" name="price">

                                </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  صورة التذكرة  </label>
                                <div class="col-lg-10 col-12">
                                     <input type="file" class="form-control" id="ticket" name="ticket" placeholder=" من فضلك قم بإضافة صورة تذكرتك" >
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  معها سائق    </label>
                                <div class="col-lg-10 col-12">
                                    <select id="chauffeur" name="chauffeur" class="form-control">
                                        <option selected>هل تريد سائق مع السياره أم لا </option>
                                        <option value="1"> نعم </option>
                                        <option value="0"> لا  </option>
                                    </select>
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
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
 $('.destinations').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getpricedestination') }}",
                    data: {
                        'id': value,
                        'dependent': dependent
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
