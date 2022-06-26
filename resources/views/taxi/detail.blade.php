
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
            <h2 style="text-align:center;
                        text-align: center;
                        margin: 27px 0;
                        background-color: #dae8ed;
                        padding: 25px;"> تأكيد حجز تاكسي
            </h2>
    <div class="container">
        <div class="row">
            <table class="table" style=" text-align:center;font-weight: bolder;">
                <form method="POST" onsubmit="myFunction()" id='confirmordertaxi'>
                    @csrf
                    @method('POST')
                        <tbody style="text-align:center;font-white" >
                            <tr>
                                <td>  اسم  التاكسي  </td>
                                    <td>  {{$carttaxi->taxi_name}}  </td>
                            </tr>
                            <tr>
                                <td> نوع  التاكسي   </td>
                                <td> {{$carttaxi->model}} </td>
                            </tr>
                            @if ($carttaxi->pr !==  null )
                            <tr>
                                <td>    كود الخصم     </td>
                                <input type="hidden" name="promo" value="{{$carttaxi->pr}}" /> </td>
                                <td> {{$carttaxi->pr}} </td>
                            </tr>
                            @endif
                            @if ($carttaxi->discount > 0 )
                            <tr>
                                <td>    الخصم     </td>
                                <td> {{$carttaxi->discount}} </td>
                            </tr>
                            @endif
                            <tr>
                                <td>      الاجمالي   </td>
                                <td> {{$carttaxi->finallPrice}} </td>
                            </tr>
                            <tr>
                                <td> رقم الواتساب </td>
                                <td> {{$carttaxi->phone}} <input type="hidden" name="phone" value="{{$carttaxi->phone}}" /> </td>
                            </tr>
                            <tr>
                                <td>  اسم الشخص المعني بالحجز   </td>
                                <td>{{$carttaxi->customrname}} <input type="hidden" name="customername" value="{{$carttaxi->customrname}}" /> </td>
                            </tr>
                            <tr>

                                <td>  الوجهه     </td>
                                <td> {{$carttaxi->destination_name}} <input type="hidden" name="destination" value="{{$carttaxi->destination_name}}" /> </td>
                            </tr>
                            <tr>
                                <td>  تاريخ الوصول     </td>
                                <td>{{$carttaxi->datearrive}} <input type="hidden" name="datearrive" value="{{$carttaxi->datearrive}}" /> </td>
                            </tr>

                            <tr>
                                <td>   مكان التوصيل     </td>
                                <td>{{$carttaxi->deliveryplace}} <input type="hidden" name="deliveryplace" value="{{$carttaxi->deliveryplace}}" /> </td>
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
                        window.location.href='{{ route('userTaxiOrder')}}';
                }}
                , error: function (reject) {
                    console.log('no');
                }
            });
        });
    </script>
    @endsection

