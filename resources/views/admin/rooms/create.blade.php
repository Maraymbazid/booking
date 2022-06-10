@extends('admin.layouts.lay')
@section('title', ' إضافة غرفة ')
@section('css')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="{{ url('assest/admin/plugins/select2/css/select2.min.css') }}">
    <style>
        .col-md-3,
        .col-12 {
            text-align: right;
        }
        .script {
        display: block;
        position: relative;
        padding-left: 45px;
        margin-bottom: 15px;
        cursor: pointer;
        font-size: 20px;
      }
      /* Hide the default checkbox */
      input[type=checkbox] {
        visibility: hidden;
      }
      /* creating a custom checkbox based on demand */
      .w3docs {
        position: absolute;
        top: 0;
        left: 28px;
        height: 25px;
        width: 25px;
        background-color: #DCDCDC;

      }
      /* specify the background color to be shown when hovering over checkbox */
      .script:hover input ~ .w3docs {
        background-color: white;
      }
      /* specify the background color to be shown when checkbox is active */
      .script input:active ~ .w3docs {
        background-color: white;
      }
      /* specify the background color to be shown when checkbox is checked */
      .script input:checked ~ .w3docs {
        background-color: green;
      }
      /* checkmark to be shown in checkbox */
      /* It is not be shown when not checked */
      .w3docs:after {
        content: "";
        position: absolute;
        display: none;
      }
      /* display checkmark when checked */
      .script input:checked ~ .w3docs:after {
        display: block;
      }
      /* styling the checkmark using webkit */
      /* creating a square to be the sign of checkmark */
      .script .w3docs:after {
        left: 10px;
        bottom: 5px;
        width: 6px;
        height: 6px;
        border: solid white;
        border-width: 4px 4px 4px 4px;
      }
    </style>
    </style>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
@endsection
@section('content')

    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <h2 class="text-center display-4">اضافة غرفة
                </h2>

                <hr>
                <span id='sucess_msg'> </span>

                <form method="POST" enctype="multipart/form-data" id='addroom' >
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> اسم الغرفة</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="name_ar" id="name_ar"
                                                class="form-control form-control-lg" placeholder=""
                                                areia-describedby="helper" value="{{ old('name_ar') }}">                                        </div>
                                       </div>
                                       <span class="invalid-feedback" role="alert" id='name_ar_error'> </span>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>  عدد الاطفال </label>
                                        <div class="input-group input-group-lg">
                                            <input type="number" name="children" id=""
                                                class="form-control form-control-lg" min="0" max="10"
                                                areia-describedby="helper" value="">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='children_error'> </span>
                                    </div>
                                </div>
                                   <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>  عدد السرائر </label>
                                        <div class="input-group input-group-lg">
                                            <input type="number" name="beds" id=""
                                                class="form-control form-control-lg" min="0" max="10"
                                                areia-describedby="helper" value="">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='children_error'> </span>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>   عدد البالغين </label>
                                        <div class="input-group input-group-lg">
                                        <input type="number" name="adults" id=""
                                                class="form-control form-control-lg" min="0" max="10"
                                                areia-describedby="helper" value="">
                                        </div>
                                        <span id='adults_error' role="alert" id='children_error' class="invalid-feedback"> </span>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>الانترنيت</label>
                                        <select name="internet" id="internet" class="form-control" style="width: 100%;">
                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1"> متوفر</option>
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">غير متوفر</option>
                                        </select>
                                    </div>
                                    <span id='status_error' class="invalid-feedback" role="alert" id='children_error'> </span>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>  الحجم </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="area" id="area" class="form-control form-control-lg"
                                                placeholder="" areia-describedby="helper" value="{{ old('sort') }}">
                                        </div>
                                        <span id='area_error' class="invalid-feedback" role="alert" id='children_error'> </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> الفندق </label>
                                        <div class="input-group input-group-lg">
                                            <select _ngcontent-c9="" class="form-control" id="hotel_id"
                                                name="hotel_id">
                                                <option value="">إختار الفندق </option>
                                                @if ($hotels && $hotels->count() > 0)
                                                    @foreach ($hotels as $hotel)
                                                        <option value="{{ $hotel->id }}">
                                                            {{ $hotel->name_ar }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='hotel_id_error' class="invalid-feedback"> </span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> السعر </label>
                                        <div class="input-group input-group-lg">
                                        <input type="text" name="price" id="price" class="form-control form-control-lg"
                                                placeholder="" areia-describedby="helper" value="">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='price_error'> </span>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>صور الغرفة </label>
                                        <div class="input-group input-group-lg">
                                            <input type="file" name="images[]" multiple id="" class="form-control form-control-lg"
                                                style="padding-bottom: 45px;" placeholder="" areia-describedby="helper">
                                        </div>
                                        <span id='image_error' role="alert" id='price_error' class="invalid-feedback"> </span>
                                    </div>
                                 </div>
                                 <div class="col-md-4 col-12"> </div>
                                 @foreach($NamesServices as $name)
                                 @if(isset($services))
                                 <label style="color:black; font-size:18px; margin-right:20px;"> {{$name->name}}  </label>
                                 <div class="col-md-12 col-12"> </div>
                                                @foreach($services as $service)
                                                @if($service->name_id == $name->id)
                                            <div class="row">
                                                <div class="form-group" style="">
                                                        <div class="" style="font-size:19.5px;">
                                                        <label class="script" style="color:black;margin-right:109px;">{{$service->name}}
                                                        <input type="checkbox" name="services[]" value="{{ $service->id}}" multiple>
                                                        <span class="w3docs"></span> <br>
                                                        </label>
                                                        </div>
                                               </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            <div class="col-md-12 col-12"> </div>
                                            @endif
                                            @endforeach


                             <span class="invalid-feedback" role="alert" id='services_error'> </span>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <button name="page" value="index" type="submit"
                                            class="btn btn-primary btn-lg btn-block">إضافة</button>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-danger btn-lg btn-block">Cancel</button>
                                    </div>
                                </div>
                            </div>
                </form>

            </div>
        </section>
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
    <script>
        function validationArabic(event) {
            var value = String.fromCharCode(event.which);
            var regex = /^[\u0621-\u064A\s]+$/gmu;
            return regex.test(value);
        }
        $('#name_ar').bind('keypress', validationArabic);
        //$('#description_ar').bind('keypress', validationArabic);
        // // filter english
        // function validationEnglish(event) {
        //     var value = String.fromCharCode(event.which);
        //     var regex = /^[a-z ]+[a-z0-9 ]*$/i;
        //     return regex.test(value);
        // }
        // $('#description_en').bind('keypress', validationEnglish);
        // $('#name_en').bind('keypress', validationEnglish);

        //save data
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // save data
        $('#addroom').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#license_name_error').text('');

            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{ route('storeroom')}}`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    })
                }
            });
        });
    </script>
@endsection
