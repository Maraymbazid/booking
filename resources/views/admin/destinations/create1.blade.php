@extends('admin.layouts.lay')
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
                <h2 class="text-center display-4">  إضافة محافظة
                </h2>
                <hr>
                <span id='sucess_msg'> </span>

                <form method="POST" enctype="multipart/form-data" id="adddestination">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                            <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label> محافظة </label>
                                        <div class="input-group input-group-lg">
                                        <select _ngcontent-c9="" class="form-control" id="gouvernement_id" name="gouvernement_id">
                                            <option value="">إختار محافظة </option>
                                        @if($allgouvernements && $allgouvernements -> count() > 0)
                                            @foreach($allgouvernements as $allgouvernement)
                                        <option
                                            value="{{$allgouvernement -> id }}">
                                            {{$allgouvernement -> name}}
                                        </option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                                <span class="invalid-feedback" role="alert" id='gouvernement_id_error'> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>  اسم الواجهة </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="name" id="name"
                                                class="form-control form-control-lg" placeholder=""
                                                areia-describedby="helper" value="{{ old('description_ar') }}">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='name_error'> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>  السعر </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="price" id="price"
                                                class="form-control form-control-lg" placeholder=""
                                                areia-describedby="helper" value="{{ old('description_ar') }}">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='price_error'> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                </div>
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
        $('#name').bind('keypress', validationArabic);
        $('#adddestination').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{ route('storedestination') }}`,
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
                        //$('#sucess_msg').text(response.msg);
                    }
                },
                error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(name, msg) {
                       $('#' + name + '_error').text(msg[0]);
                       //console.log('#' + name);
                    });
                }
            });
        });
    </script>
@endsection
