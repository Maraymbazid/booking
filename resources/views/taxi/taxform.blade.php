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
                @if (session()->has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session()->get('success') }}
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
                            <th scope="col">الخدمة</th>
                            <th scope="col">السعر </th>
                            <th scope="col">الرقم</th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <form method="post" onsubmit="myFunction()"
                            {{-- action="{{ route('ordercheck', ['one' =>  encrypt(), 'tow' =>  encrypt()]) }}" --}}
                            enctype="multipart/form-data">
                            @csrf
                            <tr>
                                <td data-label="Services">{{$tax->name}}</td>
                                <td data-label="Buying">
                                </td>
                                <td data-label="game_id"><input name='game_id' type='text'></td>
                                <td></td>
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
                        <form>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">موقع إستلام السياره </label>
                                <div class="col-10">
                                  <input type="text" class="form-control" id="place" placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  الجنسية </label>
                                <div class="col-10">
                                  <input type="text" class="form-control" id="place" placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  تاريخ الوصول </label>
                                <div class="col-8">
                                  <input type="date" class="form-control" id="place" placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  رقم التليفون </label>
                                <div class="col-8">
                                     <input type="text" class="form-control" id="place" placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  الواجهة  </label>
                                <div class="col-8">
                                     <input type="text" class="form-control" id="place" placeholder="موقع استلام السياره ">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  صورة التذكرة  </label>
                                <div class="col-8">
                                     <input type="text" class="form-control" id="place" placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pb-5 mt-2">
                                <div >
                                     <button type="sumbit" class="btn btn-primary p-1" > أطلب الان  </button>
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
