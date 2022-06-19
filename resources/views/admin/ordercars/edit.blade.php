@extends('admin.layouts.lay')
@section('title', '  تعديل طلب ')
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
                <h2 class="text-center display-4">  تعديل  طلب
                </h2>
                <hr>
                <span id='sucess_msg'> </span>

                <form method="POST" enctype="multipart/form-data" action="{{route('updateorder')}}" id="updateordercar">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">

                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                     <label>   ملاحظات </label>
                                        <div class="input-group input-group-lg">
                                        <textarea id="w3review" name="note" rows="4" cols="200" class="form-control form-control-lg">
                                        </textarea>
                                        <input type="hidden" value="{{$order->id}}" name="id">
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='note_error' style="">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                        <select _ngcontent-c9="" class="form-control" id="status_id" name="status">
                                            <option value=""> اختار الحالة </option>
                                            <option value="1">  قيد التنفيذ </option>
                                            <option value="2">  تم القبول </option>
                                            <option value="3" >  انتظر مكالمة للقبول</option>
                                            <option value="4" >   مرفوض  </option>
                                        </select>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <button name="page" value="index" type="submit"
                                    class="btn btn-primary btn-lg btn-block">تعديل</button>
                                    </div>
                                </div>
    </div> </div> </div>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#updateordercar').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{route('updateorder')}}`,
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
                        window.location.href='{{ route('allorderscars')}}';
                    }
                },
                error: function(reject) {
                    // var response = $.parseJSON(reject.responseText);
                    // $.each(response.errors, function(key, val) {
                    //     $("#" + key + "_error").text(val[0]);
                    // })
                }
            });
        });
       
    </script>
@endsection
