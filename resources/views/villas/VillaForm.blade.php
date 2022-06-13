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
                <img src="{{$villa->image}}" width="100%" ;
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
                            <th scope="col">الشقة</th>
                            <th scope="col">سعر اليوم </th>
                            @if($villa->discount)
                            @foreach($villa->discount as $discount)
                            <th scope="col"> الخصم </th>
                            @endforeach
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <form method="post" onsubmit="myFunction()"
                            {{-- action="{{ route('ordercheck', ['one' =>  encrypt(), 'tow' =>  encrypt()]) }}" --}}
                            enctype="multipart/form-data">
                            @csrf
                            <tr>
                                <td data-label="اسم السيارة">{{$villa->name_ar}}</td>
                                <td data-label="السعر"> {{$villa->price}} </td>
                                @if($villa->discount)
                                @foreach($villa->discount as $discount)
                                <td> %{{$discount->rate}} </td>
                                @endforeach
                                @endif
                            </tr>
                        </form>
                    </tbody>
                </table>
                <div class="container">
                    <div class="row mt-5">
                    <div class="col">
                        <form method="post" action="{{route('checkordervilla')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$villa->id}}">
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">تاريخ القدوم  </label>
                                <div class="col-md-10 col-12">
                                  <input type="date" class="form-control" id="begindate"  name="begindate"  placeholder="تاريخ القدوم ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">تاريخ الخروج  </label>
                                <div class="col-md-10 col-12">
                                  <input type="date" class="form-control" id="enddate"  name="enddate"  placeholder="تاريخ الخروج ">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  المده </label>
                                <div class="col-md-10 col-12">
                                  <input type="number" class="form-control" id="numberdays"  name="numberdays" placeholder="  من فضلك ادخل عدد الايام ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  رقم التليفون </label>
                                <div class="col-lg-10 col-12">
                                     <input type="number" class="form-control" id="number" name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label"> عدد الأشخاص   </label>
                                <div class="col-lg-10 col-12">
                                     <input type="number" class="form-control" id="persones" name="persones" placeholder=" من فضلك ادخل   عدد الأشخاص  ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  اسم الشخص المعني بالحجز </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="customrname"  name="customrname" placeholder="من فضلك ادخل اسم الشخص الذي يتم الحجز باسمه">
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
