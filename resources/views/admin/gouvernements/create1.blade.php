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

                <form method="POST" enctype="multipart/form-data" id='addgov'>
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>اسم الفندق</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="name" id="name"
                                                class="form-control form-control-lg" placeholder="name"
                                                areia-describedby="helper" value="{{ old('name') }}">
                                            <span id='name_ar_error'> </span>
                                            {{-- <div class="alert alert-danger mt-3">{{ $message }}</div> --}}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <br>
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
                                <hr>


                            </div>
                </form>

            </div>
        </section>
    </div>
@endsection
@section('js')

    <script>


        //save data
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // save data
        $('#addgov').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{ route('storegouvernement') }}`,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        this.reset();

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
