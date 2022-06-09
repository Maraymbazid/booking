@extends('admin.layouts.lay')
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
@section('content')


            <div class="option">

                <div class="option-description">
                    <p class="option-text">

                    </p>

                    <table>
                        <h4 class='text-center'> تأكيد حجز غرفة  </h4>
                        <thead>
                            <tr>
                            </tr>
                        </thead>


                        <form method="POST" onsubmit="myFunction()"
                           >
                            @csrf
                            @method('POST')
                            <tbody>
                                <tr class='text-center border border-light'>
                                    <td> اسم الفندق </td>
                                    <td>   $order->hotel_name  </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> اسم الغرفة </td>
                                    <td> $order->room_name</td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> اسم الشخص المعني بالحجز </td>
                                    <td>  $order->name <input type="hidden" name="name"  value=""/> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> تكلفة الاقامة لليوم  </td>
                                    <td> $order->oneday  </td>
                                </tr>

                                <tr class='text-center border border-light'>
                                    <td> الخصم </td>
                                    <td>$order->discount </td>
                                </tr>

                                <tr class='text-center border border-light'>
                                    <td> التكلفة الاجمالية  </td>
                                    <td>  $order->price </td>
                                </tr>

                                <tr class='text-center border border-light'>
                                    <td> رقم الواتساب </td>
                                    <td> $order->whatsapp  <input type="hidden" name="whatsapp" value="" /> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> تاريخ الوصول   </td>
                                    <td>$order->arrival  <input type="hidden" name="arrival" value="" /> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> عدد الايام    </td>
                                    <td> $order->daycount  <input type="hidden" name="daycount" value="" /> </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>  تاريخ المغادرة     </td>
                                    <td>$order->checkout  <input type="hidden" name="checkout" value="" /> </td>
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