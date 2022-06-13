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


@section('pagetitle' )  {{$car->name}} @endsection
@section('background' ) style="background-image: url({{$car->image}});" @endsection
@section('content')


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
                    <div class="row">
                        <div class="col-12">


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
                                    @foreach($car->discount as $discount)
                                    <th scope="col"> الخصم </th>
                                    @endforeach
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
                                        @foreach($car->discount as $discount)
                                        <td> %{{$discount->rate}} </td>
                                        @endforeach
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
                                <label for="place" class="col-sm-2 col-form-label">  جنسية الزبون  </label>
                                <div class="col-md-10 col-12">
                                  <input type="text" class="form-control" id="nationality" name="nationality" placeholder="  من فضلك ادخل جنسيتك ">
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
