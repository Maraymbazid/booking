@extends('admin.layouts.lay')
@section('title', ' إضافة فندق ')
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
                <h2 class="text-center display-4">اضافة فندق
                </h2>

                <hr>
                <span id='sucess_msg'> </span>

                <form method="POST" enctype="multipart/form-data" id='edithotel' >
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                                <input type="hidden" name='hotelId' v-model="hotelId" />
                                {{-- name  --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>اسم الفندق</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" v-model='name_ar' id='name_ar' name='name_ar'  class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                {{-- desc  --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>نبذه عن الفندق </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" v-model="description_ar" name='description_ar' id="description_ar"
                                                class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                    {{-- status  --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>الحالة</label>
                                        <select v-model="status" name='status' id="select2" class="form-control" style="width: 100%;">
                                            <option  value="1"> تنشيط</option>
                                            <option  value="0"> تعطيل</option>
                                        </select>
                                        <span id='status_error'> </span>
                                    </div>
                                </div>
                                    {{-- gov  --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> محافظة </label>
                                        <div class="input-group input-group-lg">
                                            <select  class="form-control" id="gouvernement_id"
                                                v-model="gouvernement" name='gouvernement'>
                                                <option value="">إختار محافظة </option>
                                                @if ($allgouvernements && $allgouvernements->count() > 0)
                                                    @foreach ($allgouvernements as $allgouvernement)
                                                        <option value="{{ $allgouvernement->id }}">
                                                            {{ $allgouvernement->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='gouvernement_id_error'> </span>
                                    </div>
                                </div>
                                {{-- image  --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>صورة الفندق </label>
                                        <div class="input-group input-group-lg">
                                            <input type="file"  name="image" id="image" class="form-control form-control-lg"
                                                style="padding-bottom: 45px;" placeholder="" areia-describedby="helper">
                                        </div>
                                    </div>
                                </div>
                                {{-- cover  --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>صورة الغلاف </label>
                                        <div class="input-group input-group-lg">
                                            <input type="file"  name="cover" id="cover" class="form-control form-control-lg"
                                                style="padding-bottom: 45px;" placeholder="" areia-describedby="helper">
                                        </div>
                                    </div>
                                </div>
                                {{-- sort --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label >  التقيم </label>
                                        <div class="input-group input-group-lg">
                                            <input type="number" v-model="sort" name='sort' id="sort" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                </div>
                                {{-- title --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for='title' >  العنوان </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" v-model='title'  name='title' id="title" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                </div>
                                {{-- location --}}
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label>اللوكيشن </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" v-model='location' id='location' name='location'  class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                {{-- serviceses --}}
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>اختر خدمة </label>
                                        <select v-model="status" id="allserv" data-dependent="services" class="form-control roles" style="width: 100%;">
                                            <option  value=""> اختر خدمة</option>
                                            @foreach(\App\Models\MainServicesHotel::all() as $services)
                                            <option  value="{{ $services->id}}"> {{$services->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> اختر خدمة </label>
                                        <select id="services" v-model='subId' @change='addnewSub'  class="form-control " style="width: 100%;">
                                            <option>أختر خدمة فرعية </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                </div>

                                <div class='col-12 ' v-for='(subservice , index ) in  subservices'>
                                <div class='col-3 mt-1 p-1' >
                                    <select disabled   class="form-control " style="width: 100%;">
                                        <option> @{{subservice.name}} </option>
                                    </select>
                                </div>
                                <div class='col-3'>  <span @click='deletesubservice(subservice)'> delete  </span> </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <button name="page" @click='sendData' value="index" type="submit"
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
        edithotel = new Vue({
            'el' : '#edithotel',
            'data' : {
            'id' : JSON.parse('{!!    $arr !!}'),
            'name_ar':'',
            'description_ar':'',
            'status' : '',
            'gouvernement':'',
            'subservices' : [],
            'sort': '',
            'subId' : '',
            'userNamePr' : '',
            'test' : '',
            'location' : '',
            'title' : '',
            'edit_id':'',
            'hotelId':''
            },
            methods:{
                ///edit page
                setData:function(){
                    this.hotelId = this.id[0].id,
                    this.name_ar = this.id[0].name_ar,
                    this.description_ar = this.id[0].description_ar,
                    this.status = this.id[0].status,
                    this.gouvernement = this.id[0].gouvernement,
                    this.location = this.id[0].location,
                    this.sort = this.id[0].sort,
                    this.title = this.id[0].title
                },
                getSubServices_adata:function(){
                    url = '{{ route('getSubsByHotelId', ':id')}}',
                    url = url.replace(':id' , this.id[0].id)
                    this.$http.get(url).then(response => {
                        // get body data
                        console.log(response.data['sub'])
                                this.subservices = response.data['sub']
                        // this.jobs = response.data;
                    }, response => {
                        // error callback
                    })

                },
                addnewSub:function(){
                    if (this.subId == '')
                        return;
                    this.userNamePr = this.getSubservice(this.subId)
                },
                getSubservice:function(id){
                    values = {
                        'subId' : this.subId,
                        'hotel_id' : this.id[0].id,
                    }
                    $.ajax({
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        url: '{{ route('storeSub') }}',
                        data: values,
                        success: function(res) {

                            swal({
                                title:  res.msg,
                                type: 'success',
                                confirmButtonText: 'done',
                                });
                        },
                        error: function(res) {
                            var response = $.parseJSON(res.responseText);
                            $.each(response.errors, function(name, msg) {
                                swal({
                                     title:  msg[0],
                                     type: 'warning',
                                     confirmButtonText: 'error',
                                     });
                            });
                            return 0;
                        }
                    } );
                    this.getSubServices_adata();
                },
                deletesubservice: function(subservice) {
                    url = '{{ route('deletSub', ':id')}}',
                    url = url.replace(':id' , subservice.id)
                    this.$http.get(url).then(response => {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'deleted_done',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }, response => {
                        // error callback
                    })
                    this. getSubServices_adata();
                },
                resetForm :function(){

                    this.name_ar = '',
                    this.description_ar = '',
                    this.status = '',
                    this.gouvernement = '',
                    this.subservices = '',
                    this.sort = ''
                },
                validation:function(){
                        console.log('TETS');
                },
                json_test:function(){
                 this.test =  JSON.parse(JSON.stringify(this.subservices))
                },
                sendData:function(e){
                    e.preventDefault();
                    $.ajaxSetup({
                            headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                    const formData = new FormData(document.getElementById("edithotel"));
                    $.ajax({
                        // console.log(url),
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        url: "{{ route('updateHotel') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
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
            },
            created(){
                this.setData();
                this.getSubServices_adata();
            }
        });
        function validationArabic(event) {
            var value = String.fromCharCode(event.which);
            var regex = /^[\u0621-\u064A\s]+$/gmu;
            return regex.test(value);
        }
        $('#name_ar').bind('keypress', validationArabic);
        $('#description_ar').bind('keypress', validationArabic);
        //save data
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.roles').change(function() {
            if ($(this).val() != '') {
                var select = $(this).attr("id"); //id
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                $.ajax({
                    url: "{{ route('getSubByMainId') }}",
                    method: "POST",
                    data: {
                        'id': value,
                        'dependent': dependent
                    },
                    success: function(result) {
                        $('#' + dependent).html(result);
                    }
                })
            }
        });
        // save data
        // $('#addgame').submit(function(e) {
        //     e.preventDefault();
        //     let formData = new FormData(this);
        //     // let sub = JSON.parse('test', true);//#endreg
        //     console.log(JSON.stringify(hotels.subservices))
        //     formData.append('subserv', JSON.stringify(hotels.subservices) );
        //     formData.append('status', hotels.status );
        //     console.log(formData)
        //     $.ajax({
        //         type: 'POST',
        //         enctype: 'multipart/form-data',
        //         url: `{{ route('storeHotel') }}`,
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: (response) => {
        //             if (response) {
        //                 this.reset();
        //                 Swal.fire({
        //                     position: 'top-center',
        //                     icon: 'success',
        //                     title: response.msg,
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 })
        //                 $('#sucess_msg').text(response.msg);
        //             }
        //         },
        //         error: function(reject) {

        //             console.log('error');
        //         }
        //     });
        // });
    </script>
@endsection
