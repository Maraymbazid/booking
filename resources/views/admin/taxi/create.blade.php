@extends('admin.layouts.lay')
@section('title','تاكسي المطار')
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
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid" id='createhotel'>
                    <h2 class="text-center display-4">اضافة تاكسي مطار
                    </h2>

                    <hr>
                    <span id='sucess_msg'> </span>

                <form method="POST" enctype="multipart/form-data" id='addcar' >
                    @csrf
                    <div class="row">
                                {{-- name  --}}
                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label>اسم  سياره </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" v-model='name' id='name' name='name'  class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                {{-- desc  --}}
                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label> صوره   </label>
                                        <div class="input-group input-group-lg">
                                            <input type="file"  name='image'  @change="fileChange1" ref="file1"  class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label> صور الغلاف </label>
                                        <div class="input-group input-group-lg">
                                            <input type="file" name="images[]"  class="form-control form-control-lg"
                                                style="padding-bottom: 45px;"  multiple  @change="fileChange2" ref="file2" >
                                        </div>
                                        <span class="invalid-feedback" role="alert" id='image_error'> </span>
                                    </div>
                                </div>
                                {{-- end image  --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label> الموديل   </label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" v-model='model' name='model'  class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                {{-- end model  --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label> السعر   </label>
                                        <div class="input-group input-group-lg">
                                            <input type="float" v-model='price' name='price'  class="form-control form-control-lg"  >
                                        </div>
                                    </div>
                                </div>
                                {{-- end price  --}}
                                <div class="col-6">
                                    <div class="form-group">
                                        <label> الشركة </label>
                                        <div class="input-group input-group-lg">
                                            <select  class="form-control"
                                               name='company_id'>
                                                <option value="NULL">إختار شركة </option>
                                                    @foreach (\App\Models\Company::all() as $com)
                                                        <option value="{{ $com->id }}">
                                                            {{ $com->name }}
                                                        </option>
                                                    @endforeach

                                            </select>
                                        </div>

                                    </div>
                                </div>
                                {{-- end comany  --}}
                                <div class="col-6 mt-5">
                                    <div class="form-group">
                                        <button name="page" value="index" @click='saveData' type="submit"
                                            class="btn btn-primary btn-lg btn-block">إضافة</button>
                                    </div>
                                </div>
                                <div class="col-6 mt-5">
                                    <div class="form-group">
                                        <button type="reset" class="btn btn-danger btn-lg btn-block">Cancel</button>
                                    </div>
                                </div>


                        </div>
                </form>

            </div>

        </section>
    </div>
</div>
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

<script>
        addtaxi = new Vue({
            'el': '#addcar',
            'data' : {
                'name' : '',
                'model': '',
                'file1' : '',
                'file2' : '',
                'price': '',
                'comID': '',
                'error' : []
            },
            methods :{
                fileChange1(event) {
                      this.file1 = this.$refs.file1.files.length;
                },
                fileChange2(event) {
                      this.file2 = this.$refs.file2.files.length;
                },
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
                    this.error = [],

                    this.falidation(this.price , 'لا يمكن ترك السعر فارغا  ')
                    this.falidation(this.model , 'لا يمكن ترك الموديل فارغا')
                    this.falidation(this.file2 , ' صور الغلاف مطلوبه')
                    this.falidation(this.file1 , ' صورة السياره مطلوبه')
                    this.falidation(this.name , 'لا يمكن ترك الاسم فارغا ')
                    if (this.error.length != 0) {
                        return false
                    }
                        let formData = new FormData(document.getElementById("addcar"));
                        axios.post('{{ route('storeTaxi')}}', formData).then(response => {
                            document.getElementById("addcar").reset();
                            swal({
                                    title:  response.data.msg,
                                    type: 'success',
                                    confirmButtonText: 'موافق',
                                });
                        }).catch(response => {
                            console.log(response)
                        })
                }
            }
        });

    </script>


@endsection
