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
                <h6 class="text-center display-4"> تعديل برمو </h6>

                <form method="POST" enctype="multipart/form-data" id='updatepromo' >
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> الاسم</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text"  id='name' name='name'  class="form-control form-control-lg" value="{{$promo->name}}" >
                                            <input type="hidden" name="id" value="{{$promo->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> تاريخ البدء</label>
                                        <div class="input-group input-group-lg">
                                            <input type="date"  id='begindate' name='begindate'  class="form-control form-control-lg" value="{{$promo->begindate}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> تاريخ النهاية</label>
                                        <div class="input-group input-group-lg">
                                            <input type="date"  id='enddate' name='enddate'  class="form-control form-control-lg"  value="{{$promo->enddate}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                    <label>الحالة</label>
                                        <select name="status" id="select2"  style="" class="form-control form-control-lg">
                                            @if($promo->status == 0)
                                            <option  value="0" selected>تعطيل</option>
                                            <option  value="1"> تنشيط</option>
                                            @else
                                            <option  value="1" selected> تنشيط</option>
                                            <option  value="0">تعطيل</option>
                                            @endif
                                        </select>
                                        <div class="input-group input-group-lg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>  عدد الاشخاص </label>
                                        <div class="input-group input-group-lg">
                                            <input type="number"  id='personnes' name='personnes'  class="form-control form-control-lg" min="1"  value="{{$promo->personnes}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label> نسبة الخصم</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text"  id='discount' name='discount'  class="form-control form-control-lg" value="{{$promo->discount}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                    <label> اختار تاكسي </label>
                                        <div class="input-group input-group-lg">
                                                <select _ngcontent-c9="" class="form-control" id="taxi_id" name="taxi_id">
                                                    <option value=""> اختار تاكسي </option>
                                                @if($alltaxis && $alltaxis-> count() > 0)
                                                    @foreach($alltaxis as $taxi)
                                                    @if($taxi->id == $promo->taxi_id)
                                                <option
                                                    value="{{$taxi->id }}" selected>
                                                    {{$taxi->name}}
                                                </option>
                                                @else
                                                <option
                                                    value="{{$taxi->id }}">
                                                    {{$taxi->name}}
                                                </option>
                                                @endif
                                                @endforeach
                                            @endif
                                            </select>
                                    </div>
                                 </div>
                                </div>
                                {{-- desc  --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <button name="page" value="index" @click='saveData' type="submit"
                                                class="btn btn-primary btn-lg btn-block">تعديل</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
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
 $('#updatepromo').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: `{{ route('updatepromo') }}`,
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
                        window.location.href='{{ route('promoindex')}}';
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        //$("#" + key + "_error").text(val[0]);
                    })
                }
            });
        });



</script>

@endsection
