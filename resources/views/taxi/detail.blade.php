@extends('layout.flay')
@section('css')
    <link rel="stylesheet" href="{{ url('assest/front2/css/in.css') }}">
<style>
.option-description{
    max-width: 90%;
    background-color:royalblue;
    margin: 50px;
}


</style>
@endsection
@include('layout.nav')

@section('content')
<div class="title">
     مراجعة الطلب
</div>

      <div class="container">
          <div class="row">
          <p class="option-text" style="text-align:center" >
             <h4 > تأكيد حجز تاكسي  </h4>
        </p>

            <table style="text-align:center">
                        <form method="POST" id="confirmordertaxi">
                            @csrf
                            <tbody>
                                <tr class='text-center border border-light'>
                                    <td>  اسم  التاكسي  </td>
                                    <td>  {{$carttaxi->taxi_name}}  </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> نوع  التاكسي   </td>
                                    <td> {{$carttaxi->model}} </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> السعر        </td>
                                    <td> {{$carttaxi->price}} </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> رقم الواتساب </td>
                                    <td> {{$carttaxi->phone}} <input type="hidden" name="phone" value="{{$carttaxi->phone}}" /> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>  اسم الشخص المعني بالحجز   </td>
                                    <td>{{$carttaxi->customrname}} <input type="hidden" name="customername" value="{{$carttaxi->customrname}}" /> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>  الوجهه     </td>
                                    <td> {{$carttaxi->destination_name}} <input type="hidden" name="destination" value="{{$carttaxi->destination_name}}" /> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>  تاريخ الوصول     </td>
                                    <td>{{$carttaxi->datearrive}} <input type="hidden" name="datearrive" value="{{$carttaxi->datearrive}}" /> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>   مكان التوصيل     </td>
                                    <td>{{$carttaxi->deliveryplace}} <input type="hidden" name="deliveryplace" value="{{$carttaxi->deliveryplace}}" /> </td>
                                </tr>

                                <tr class='text-center border border-light'>
                                    <td>   سيارة مع سائق     </td>
                                    <td> @if($carttaxi->chauffeur == 0) بدون سائق     @else مع سائق    @endif <input type="hidden" name="chauffeur" value="{{$carttaxi->chauffeur}}" /> </td>
                                </tr>
                                <input type="hidden" name="ticket" value="{{ $carttaxi->ticket}}" />
                                <input type="hidden" name="id" value="{{ $carttaxi->taxi_id}}" />
                                <input type="hidden" name="destination_id" value="{{$carttaxi->destination_id}}" />
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan='2'>
                                        <button name="page" value="index" type="submit"
                                            class="btn btn-primary btn-lg btn-block">إكمال الطلب</button>
                                    </td>
                                </tr>
                            </tfoot>

                        </form>
            </table>

    </div>
</div>
@endsection
@section('js')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
        $('#confirmordertaxi').submit(function(e) {
             e.preventDefault();
             let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: "{{route('confirmordertaxi')}}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                    Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.location.href='{{ route('userIndexTax')}}';
                }}
                , error: function (reject) {
                    console.log('no');
                }
            });
        });
    </script>
    @endsection
