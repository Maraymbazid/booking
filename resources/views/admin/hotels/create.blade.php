@extends('admin.layouts.lay')
@section('title', ' إضافة فندق ')
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
                <h2 class="text-center display-4">اضافة فندق
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
                                            {{-- <div class="alert alert-danger mt-3">{{ $message }}</div> --}}
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
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>ترتيب الفندق فى الظهور</label>
                                        <div class="input-group input-group-lg">
                                            <input type="number" name="sort" id="sort" class="form-control form-control-lg"
                                                placeholder="sort" areia-describedby="helper" value="{{ old('sort') }}">
                                            <span id='sort_error'> </span>
                                        </div>
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

                                </div>
                                <hr>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <button name="page" value="index" type="submit"
                                    class="btn btn-primary btn-lg btn-block">إضافة</button>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <button type="reset"  class="btn btn-danger btn-lg btn-block">Cancel</button>
                                    </div>
                                </div>
                            </div>
                </form>

            </div>
        </section>
    </div>
@endsection
@section('js')

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

        //save data
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // save data
        $('#addgame').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#license_name_error').text('');

            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{ route('storeHotel') }}`,
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
                    $.each(response.errors, function(name, msg) {
                        $('# ' + name + '_error').text(msg);
                    });
                }
            });
        });
    </script>
@endsection
