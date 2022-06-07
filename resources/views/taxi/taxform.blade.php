@extends('layout.lay')
@section('css')
<style>
    input {

        outline: none !important;
        text-align: center;
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: 1px solid #222;

    }

</style>
@endsection
@section('content')


        <div class="option pb-5">
            <div class="image-option-games">
                <img src="{{$tax->image}}" width="100%" ;
                    style="border-radius: 25px 25px 0px 0px;">
            </div>
            <div class="option-description">
                <p class="option-text"> </p>
                @if (session()->has('status'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session()->get('status') }}
                </div>
                @elseif (session()->has('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session()->get('error') }}
                </div>
                @endif
                <hr>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">السيارة</th>
                            <th scope="col">الموديل  </th>
                            <th scope="col">سعر اليوم </th>
                            <th scope="col"> شركة </th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="post" onsubmit="myFunction()"
                            {{-- action="{{ route('ordercheck', ['one' =>  encrypt(), 'tow' =>  encrypt()]) }}" --}}
                            enctype="multipart/form-data">
                            @csrf
                            <tr>
                                <td data-label="اسم السيارة">{{$tax->name}}</td>
                                <td data-label="موديل السيارة">
                                    {{$tax->model}}
                                </td>
                                <td data-label="السعر"> {{$tax->price}} </td>
                                <td>{{$tax->company}}  </td>
                                {{-- <td><a style="color: #fff;" href="#"> <button name="page" value="index"
                                            class="btn btn-primary rounded form-control"> شراء
                                        </button></a></td> --}}
                            </tr>
                        </form>
                    </tbody>
                </table>
                <div class="container">
                    <div class="row mt-5">
                    <div class="col">
                        <form method="post" action="{{route('checkorder')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$tax->id}}">
                            <input type="hidden" name="price" value="{{$tax->price}}">
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">موقع إستلام السياره </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="deliveryplace"  name="deliveryplace" placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  الجنسية </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="nationality"  name="nationality" placeholder="  من فضلك ادخل جنسيتك ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  تاريخ الوصول </label>
                                <div class="col-lg-10 col-12">
                                  <input type="date" class="form-control" id="datearrive" name="datearrive" placeholder="  من فضلك حدد ميعاد الوصول">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  رقم التليفون </label>
                                <div class="col-lg-10 col-12">
                                     <input type="number" class="form-control" id="phone" name="phone" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  الواجهة  </label>
                                <div class="col-lg-10 col-12">
                                     <input type="text" class="form-control" id="destination" name="destination" placeholder=" من فضلك أدخل وجهتك  ">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  صورة التذكرة  </label>
                                <div class="col-lg-10 col-12">
                                     <input type="file" class="form-control" id="ticket" name="ticket" placeholder=" من فضلك قم بإضافة صورة تذكرتك" >
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  معها سائق    </label>
                                <div class="col-lg-10 col-12">
                                    <select id="chauffeur" name="chauffeur" class="form-control">
                                        <option selected>هل تريد سائق مع السياره أم لا </option>
                                        <option value="1"> نعم </option>
                                        <option value="0"> لا  </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">       </label>
                                <div class="col-lg-10 col-12 p-2">
                                       <button type="sumbit" class="btn btn-primary p-1 form-control" > أطلب الان  </button>
                                </div>
                            </div>


                          </form>
                    </div>
                </div>

                </div>
            </div>
        </div>


@endsection
@section('js')
<script>
    function myFunction() {
            $(':button').prop('disabled', true);
        }
</script>

@endsection
