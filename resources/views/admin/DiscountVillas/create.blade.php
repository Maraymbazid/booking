@extends('admin.layouts.lay')
@section('title', ' إضافة خصم ')
@section('css')
   <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <h2 class="text-center display-4">  إضافة خصم
                </h2>
                <hr>
                <span id='sucess_msg'> </span>

                <form method="POST" enctype="multipart/form-data" id="adddiscountvilla">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>  عدد الايام</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="number_days" id="number_days"
                                                class="form-control form-control-lg" placeholder="name"
                                                areia-describedby="helper" value="{{ old('name') }}">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='number_days_error' style="">
                                            <h1></h1>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>  نسبة الخصم</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" name="rate" id="rate"
                                                class="form-control form-control-lg" placeholder="name"
                                                areia-describedby="helper" value="{{ old('name') }}">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='rate_error' style="">
                                            <h1></h1>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <select _ngcontent-c9="" class="form-control gouvernements" id="gouvernement_id" name="gouvernement_id" data-dependent="gouvernements">
                                                <option value="">  اختر محافظة </option>
                                                    @if($allgouvernements && $allgouvernements -> count() > 0)
                                                        @foreach($allgouvernements as $gouvernement)
                                                        <option
                                                            value="{{$gouvernement-> id }}">
                                                            {{$gouvernement->name}}
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
                                    <div class="input-group input-group-lg">
                                        <select id="gouvernements"  class="form-control " style="width: 100%;" name="villa_id" >
                                            <option>    </option>
                                        </select>
                                    </div>
                                    <span class="invalid-feedback" role="alert" id='villa_id_error'> </span>
                                    </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>
 <script>
        // function validationArabic(event) {
        //     var value = String.fromCharCode(event.which);
        //     var regex = /^[\u0621-\u064A\s]+$/gmu;
        //     return regex.test(value);
        // }
        // $('#name').bind('keypress', validationArabic);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#adddiscountvilla').submit(function(e) {
            e.preventDefault();
             let formData = new FormData(this);
             $('#number_days_error').text('');
             $('#rate_error').text('');
            $('#gouvernement_id_error').text('');
             $('#villa_id_error').text('');
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{ route('storediscountvilla') }}`,
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
                        //$("#" + key + "_error").text(val[0]);
                        swal({
                                title: val[0],
                                type: 'warning',
                                confirmButtonText: 'error',
                            });
                    })
                }
            });
        });
        $('.gouvernements').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getVilla') }}",
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
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         'Content-Type' : "application/x-www-form-urlencoded"
        //     }
        // });
        // DATA = { AgentId=11859
        // SecretKey=slh9uoqzcmkdsdaf
        // ServiceId=195
        // Phone=057-2686379
        // CustomerPhone="" }
        // $('#formId').change(function() {
        //     e.preventDefault();
        //         $.ajax({
        //             type: 'POST',
        //             url: "https://mogapay.org:443/api/v2/InqueryMobServices/GetInvoce?shhipping_val=",
        //             data: DATA,
        //             success: function(result) {
        //                 $('#' + elementid).html(result);
        //             },
        //             error: function (reject) {
        //                console.log('error');
        //             }
        //         });
        // });
    </script>
@endsection
