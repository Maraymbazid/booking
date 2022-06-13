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
             <h4 > تأكيد حجز غرفة  </h4>
        </p>

<table style="text-align:center">

    <thead>
        <tr>
        </tr>
    </thead>


    <form method="POST" onsubmit="myFunction()"
        action="{{ route('sotororderhoter' ,  ['hotelId' =>  $order->hotel_id ,'roomId' =>  $order->room_id] ) }}">
        @csrf
        @method('POST')
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>

                </tr>
            </thead>
        <tbody>
            <tr class='text-center border border-light'>
                <td> اسم الفندق </td>
                <td>  {{ $order->hotel_name}}  </td>
            </tr>
            <tr class='text-center border border-light'>
                <td> اسم الغرفة </td>
                <td> {{$order->room_name}} </td>
            </tr>
            <tr class='text-center border border-light'>
                <td> اسم الشخص المعني بالحجز </td>
                <td> {{ $order->name}} <input type="hidden" name="name"  value="{{ $order->name}}"/> </td>
            </tr>
            <tr class='text-center border border-light'>
                <td> تكلفة الاقامة لليوم  </td>
                <td> {{$order->oneday }} </td>
            </tr>
            <tr class='text-center border border-light'>
                <td> التكلفة الاجمالية قبل الخصم  </td>
                <td> {{ $order->price1}} </td>
            </tr>
            <tr class='text-center border border-light'>
                <td> الخصم </td>
                <td>{{$order->discount}} </td>
            </tr>

            <tr class='text-center border border-light'>
                <td>  التكلفة الاجمالية بعد الخصم  </td>
                <td> {{ $order->price2}} </td>
            </tr>

            <tr class='text-center border border-light'>
                <td> رقم الواتساب </td>
                <td> {{$order->whatsapp }} <input type="hidden" name="whatsapp" value="{{$order->whatsapp }} " /> </td>
            </tr>
            <tr class='text-center border border-light'>
                <td> تاريخ الوصول   </td>
                <td>{{$order->arrival }} <input type="hidden" name="arrival" value="{{$order->arrival }} " /> </td>
            </tr>
            <tr class='text-center border border-light'>
                <td> عدد الايام    </td>
                <td> {{$order->daycount }} <input type="hidden" name="daycount" value="{{$order->daycount }} " /> </td>
            </tr>
            <tr class='text-center border border-light'>
                <td>  تاريخ المغادرة     </td>
                <td>{{$order->checkout }} <input type="hidden" name="checkout" value="{{$order->checkout }} " /> </td>
            </tr>
            </tbody>
        </table>
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
