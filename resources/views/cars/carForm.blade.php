@extends('layout.flay')
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
@include('layout.nav')
<div class="section">
    <div class="moving-image"   style="background-image: url({{$car->image}});"></div>
</div>
@section('content')
@include('layout.nav2')
<div class="title">
    {{$car->name}}
</div>
      <div class="container">
                {{-- @if (session()->has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session()->get('success') }}
                </div>
                @elseif (session()->has('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session()->get('error') }}
                </div>
                @endif --}}

                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12" >
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">السيارة</th>
                                    <th scope="col">الموديل  </th>
                                    <th scope="col">سعر اليوم </th>
                                    @if($car->company)
                                    <th scope="col"> شركة </th>
                                    @endif
                                    @if($car->discount)
                                    <th scope="col"> الخصم </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td data-label="اسم السيارة">{{$car->name}}</td>
                                        <td data-label="موديل السيارة">
                                            {{$car->model}}
                                        </td>
                                        <td data-label="السعر"> {{$car->price}} </td>
                                        @if($car->company)
                                        <td>{{$car->company->name}}  </td>
                                        @endif
                                        @if($car->discount)

                                        <td> <ul>
                                            @foreach($car->discount as $discount)
                                                    <li>  %{{$discount->rate}}</li>
                                            @endforeach
                                            </ul>
                                        </td>


                                        @endif
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>

                    <div class="row mt-5">
                    <div class="col">
                        <form method="post" action="{{route('checkordercar')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$car->id}}">
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">موقع إستلام السياره </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="receivingplace"  name="receivingplace"  placeholder="موقع استلام السياره ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">موقع تسليم السياره </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="deliveryplace"  name="deliveryplace"  placeholder="موقع تسليم السياره ">
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  المده </label>
                                <div class="col-md-10 col-12">
                                  <input type="number" class="form-control" id="numberdays"  name="numberdays" placeholder="  من فضلك ادخل عدد الايام ">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  تاريخ الاستلام </label>
                                <div class="col-lg-10 col-12">
                                  <input type="date" class="form-control" id="date"  name="date" placeholder="  من فضلك حدد ميعاد استلام السيارة">
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="place" class="col-sm-2 col-form-label">  رقم التليفون </label>
                                <div class="col-lg-10 col-12">
                                     <input type="number" class="form-control" id="number" name="number" placeholder=" من فضلك ادخل رقم واتساب للتواصل ">
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
