
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
                        padding: 25px;"> تأكيد حجز السياره
            </h2>
    <div class="container">
        <div class="row">
            <table class="table" style=" text-align:center;font-weight: bolder;">
                <form method="POST" onsubmit="myFunction()" id='confirmordercar'>
                    @csrf
                    @method('POST')
                        <tbody style="text-align:center;font-white" >
                            <tr>
                                <td>  اسم السياره  </td>
                                <td>  {{$cartcar->car_name}}  </td>
                            </tr>
                            <tr>
                                <td> نوع السياره   </td>
                                <td> {{$cartcar->modal}} </td>
                            </tr>
                            <tr>
                                <td> السعر فى اليوم      </td>
                                <td> {{$cartcar->mainPrice}} $</td>
                            </tr>

                            @if($cartcar->discount > 0 )
                            <tr>
                                <td> السعر قبل الخصم       </td>
                                <td> {{$cartcar->beforedis}} $</td>
                            </tr>
                            <td>  الخصم        </td>
                            <td> {{$cartcar->discount}} $</td>
                            @endif
                            <tr>
                                <td>  السعر الاجمالي       </td>
                                <td> {{$cartcar->price}} $</td>
                            </tr>
                            <tr>
                                <td>  اسم الشخص المعني بالحجز   </td>
                                <td>{{$cartcar->customrname}} <input type="hidden" name="customrname" value="{{$cartcar->customrname}}" /> </td>
                            </tr>
                            <tr>
                                <td> رقم الواتساب </td>
                                <td> {{$cartcar->number}} <input type="hidden" name="number" value="{{$cartcar->number}}" /> </td>
                            </tr>
                            <tr>
                                <td>  موقع إستلام السياره     </td>
                                <td> {{ $cartcar->receivingplace}} <input type="hidden" name="receivingplace" value="{{ $cartcar->receivingplace}}" /> </td>
                            </tr>
                            <tr>
                                <td>   موقع تسليم السياره     </td>
                        <td>{{$cartcar->deliveryplace}} <input type="hidden" name="deliveryplace" value="{{$cartcar->deliveryplace}}" /> </td>
                            </tr>

                            <tr>
                                <td>    تاريخ الاستلام     </td>
                                <td>{{$cartcar->date}} <input type="hidden" name="date" value="{{$cartcar->date}}" /> </td>
                            </tr>
                            <tr>
                                <td>   عدد الايام   </td>
                                <td> {{$cartcar->numberdays}} <input type="hidden" name="numberdays" value="{{$cartcar->numberdays}}" /> </td>
                            </tr>
                            <input type="hidden" name="id" value="{{$cartcar->car_id}}" />

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
         $('#confirmordercar').submit(function(e) {
             e.preventDefault();
             let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: "{{route('confirmordercar')}}",
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
                        window.location.href='{{ route('userIndexCar')}}';
                }}
                , error: function (reject) {
                    console.log('no');
                }
            });
        });
    </script>
    @endsection

