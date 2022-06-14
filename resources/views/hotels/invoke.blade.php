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
                        padding: 25px;"> تأكيد حجز غرفة  
            </h2>
    <div class="container">
        <div class="row">
            <table class="table" style=" text-align:center;font-weight: bolder;">
                <form method="POST" onsubmit="myFunction()"
                    action="{{ route('sotororderhoter' ,  ['hotelId' =>  $order->hotel_id ,'roomId' =>  $order->room_id] ) }}">
                    @csrf
                    @method('POST')
                        
                        <tbody style="text-align:center;font-white" >
                            <tr>
                                <td> اسم الفندق </td>
                                <td>  {{ $order->hotel_name}}  </td>
                            </tr>
                            <tr>
                                <td> اسم الغرفة </td>
                                <td> {{$order->room_name}} </td>
                            </tr>
                            <tr>
                                <td> اسم الشخص المعني بالحجز </td>
                                <td> {{ $order->name}} <input type="hidden" name="name"  value="{{ $order->name}}"/> </td>
                            </tr>
                            <tr>
                                <td> تكلفة الاقامة لليوم  </td>
                                <td> {{$order->oneday }} </td>
                            </tr>
                            <tr>
                                <td> التكلفة الاجمالية قبل الخصم  </td>
                                <td> {{ $order->price1}} </td>
                            </tr>
                            <tr>
                                <td> الخصم </td>
                                <td>{{$order->discount}} </td>
                            </tr>

                            <tr>
                                <td>  التكلفة الاجمالية بعد الخصم  </td>
                                <td> {{ $order->price2}} </td>
                            </tr>

                            <tr>
                                <td> رقم الواتساب </td>
                                <td> {{$order->whatsapp }} <input type="hidden" name="whatsapp" value="{{$order->whatsapp }} " /> </td>
                            </tr>
                            <tr>
                                <td> تاريخ الوصول   </td>
                                <td>{{$order->arrival }} <input type="hidden" name="arrival" value="{{$order->arrival }} " /> </td>
                            </tr>
                            <tr class='text-center  border-light'>
                                <td> عدد الايام    </td>
                                <td> {{$order->daycount }} <input type="hidden" name="daycount" value="{{$order->daycount }} " /> </td>
                            </tr>
                            <tr class='text-center  border-light'>
                                <td>  تاريخ المغادرة     </td>
                                <td>{{$order->checkout }} <input type="hidden" name="checkout" value="{{$order->checkout }} " /> </td>
                            </tr>
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
    <script>
        function myFunction() {
            $(':button').prop('disabled', true);
        }
    </script>

@endsection
