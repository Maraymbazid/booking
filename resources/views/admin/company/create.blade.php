@extends('admin.layouts.lay')
@section('title','dashboard')
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        left: 0;
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
        left: 6px;
        bottom: 5px;
        width: 6px;
        height: 6px;
        border: solid white;
        border-width: 4px 4px 4px 4px;
      }
    </style>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" id='createhotel'>
                <h6 class="text-center display-4">اضافة شركة </h6>

                <form method="POST" enctype="multipart/form-data" id='addcom' >
                    @csrf
                    <div class="row">
                        <div class="col-md-11 offset-md-1">

                                {{-- name  --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>اسم الشركة</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" v-model='name' id='name' name='name'  class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                {{-- desc  --}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <button name="page" value="index" @click='saveData' type="submit"
                                                class="btn btn-primary btn-lg btn-block">إضافة</button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <button type="reset" class="btn btn-danger btn-lg btn-block">Cancel</button>
                                        </div>
                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.6.1/vue-resource.min.js"></script>
    <script>
        company = new Vue({
            'el': '#addcom',
            'data' : {
                'name' : '',
                'error' : []
            },
            methods :{
                falidation: function(item, val) {
                    if (item == '') {
                        this.error.push({
                            'err' : 'err'
                        });
                        swal({
                            title: val,
                            type: 'warning',
                            confirmButtonText: 'ok',
                        });
                        return false
                    }
                },
                saveData: function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                            headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                    });
                    this.falidation(this.name , ' لا يمكن ترك الاسم فارغا ')
                    if (this.error.length != 0) {
                        return false
                    }
                    Data = {
                        'name' : this.name,
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('companyStore') }}',
                        data: Data,
                        success: function(res) {
                            swal({
                                title:  res.msg,
                                type: 'success',
                                confirmButtonText: 'ok',
                                });
                        },
                        error: function(res) {
                            var response = $.parseJSON(res.responseText);
                            $.each(response.errors, function(name, msg) {
                                swal({
                                        title:  msg[0],
                                        type: 'warning',
                                        confirmButtonText: 'ok',
                                        });
                                    });
                            return 0;
                        }
                    })
                }
            }
        });

    </script>


@endsection
