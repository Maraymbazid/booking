@extends('admin.layouts.dashboard')
@section('title','شقق' )
@section('css')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="{{ url('assest/admin/plugins/select2/css/select2.min.css') }}">
    <style>
        .col-md-3,
        .col-12 {
            text-align: right;
        }

    </style>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
@endsection
@section('content')

    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <h2 class="text-center display-4">اضافق
                </h2>

                <hr>
                <span id='sucess_msg'> </span>

                <form method="POST" enctype="multipart/form-data" id='addgame'>
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>اسم الفندق</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="name_ar" id="name_ar"
                                                class="form-control form-control-lg" placeholder="name_ar"
                                                areia-describedby="helper" value="{{ old('name_ar') }}">
                                            <span id='name_ar_error'> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> اسم الفندق بالانجليزية</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="name_en" id="name_en"
                                                class="form-control form-control-lg" placeholder="name_en"
                                                areia-describedby="helper" value="{{ old('name_en') }}">
                                            <span id='name_en_error'> </span>
                                        </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>نبذه عن الفندق </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="description_ar" id="description_ar"
                                                class="form-control form-control-lg" placeholder="description_ar"
                                                areia-describedby="helper" value="{{ old('description_ar') }}">
                                            <span id='description_ar_error'> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>نبذه عن الفندق باللغة الانجليزية </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="description_en" id="description_en"
                                                class="form-control form-control-lg" placeholder="description_en"
                                                areia-describedby="helper" value="{{ old('description_en') }}">
                                            <span id='description_en_error'> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>الحالة</label>
                                        <select name="status" id="select2" class="select2" style="width: 100%;">
                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1"> تنشيط</option>
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">تعطيل</option>
                                        </select>
                                        <span id='status_error'> </span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>صورة الفندق </label>
                                        <div class="input-group input-group-lg">
                                            <input type="file" name="image" id="" class="form-control form-control-lg"
                                                style="padding-bottom: 45px;" placeholder="" areia-describedby="helper">
                                            <span id='image_error'> </span>
                                        </div>
                                    </div>
                                    <span id='image_error'> </span>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                       <label> gouvernements </label>
                                        <div class="input-group input-group-lg">
                                        <select _ngcontent-c9="" class="form-control" id="gouvernement_id" name="gouvernement">
                                @if($allgouvernements && $allgouvernements -> count() > 0)
                                    @foreach($allgouvernements as $allgouvernement)
                                        <option 
                                            value="{{$allgouvernement -> id }}">
                                            {{$allgouvernement -> name}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                                            <span id='gouvernement_id_error'> </span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button name="addapartement" value="index" type="submit"
                                    class="btn btn-primary btn-lg btn-block">إضافة</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                </form>

            </div>
        </section>
    </div>
@endsection
@section('js')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script>
            function validationArabic(event) {
                var value = String.fromCharCode(event.which);
                var regex = /^[\u0621-\u064A\s]+$/gmu;
                return regex.test(value);
            }
            $('#name_ar').bind('keypress', validationArabic);
            $('#description_ar').bind('keypress', validationArabic);
            // filter english
            function validationEnglish(event) {
                var value = String.fromCharCode(event.which);
                var regex = /^[a-z ]+[a-z0-9 ]*$/i;
                return regex.test(value);
            }
            $('#description_en').bind('keypress', validationEnglish);
            $('#name_en').bind('keypress', validationEnglish);

       // save data
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // save data
        $('#addgame').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#license_name_error').text('');

            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{ route('storeapartement') }}`,
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
                        $('#sucess_msg').text(response.msg);
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
