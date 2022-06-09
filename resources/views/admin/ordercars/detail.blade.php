@extends('admin.layouts.lay')
@section('title', '  تعديل طلب ')
@section('css')
   <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('assest/admin/plugins/select2/css/select2.min.css') }}">
    <style>
        .col-md-3,
        .col-12 {
            text-align: right;
            margin-top:60%;
        }
        .option-description{
            max-width: 90%;
            margin: 50px;
        }
        <link rel="stylesheet" href="sweetalert2.min.css">
      <link rel="stylesheet" href="{{ url('assest/front2/css/in.css') }}">
    </style>
    <script src="sweetalert2.min.js"></script>
 
@endsection
@section('content')


            <div class="option container">

                <div class="option-description">
                    <p class="option-text">

                    </p>

                    <table>
                        <h4 class='text-center'>  تفاصيل الحجز   </h4>
                        <thead>
                            <tr>
                            </tr>
                        </thead>


                        <form method="POST">
                            @csrf
                            @method('POST')
                            <tbody>
                                <tr class='text-center border border-light'>
                                    <td>  رقم الطلب </td>
                                    <td>  {{ $order->Num}}  </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>  اسم السيارة </td>
                                    <td> {{$order->car->name}} </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>   نوع السيارة </td>
                                    <td> {{$order->car->model}} </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td> اسم الشخص المعني بالحجز </td>
                                    <td> Ahmed Adawe </td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>   سعر قبل الخصم  </td>
                                    <td> {{$order->price }} </td>
                                </tr>

                                <tr class='text-center border border-light'>
                                    <td> سعر بعد الخصم </td>
                                    <td>{{$order->price}} </td>
                                </tr>

                                <tr class='text-center border border-light'>
                                    <td>  عدد الايام  </td>
                                    <td> {{ $order->numberdays}} </td>
                                </tr>

                                <tr class='text-center border border-light'>
                                    <td> رقم الواتساب </td>
                                    <td> {{$order->number }}</td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>  جنسية الزبون   </td>
                                    <td>{{$order->nationality }}</td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>  مكان التسليم    </td>
                                    <td> {{$order->deliveryplace }}</td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>   مكان الاستلام     </td>
                                    <td>{{$order->receivingplace }}</td>
                                </tr>
                                <tr class='text-center border border-light'>
                                    <td>    تاريخ الاستلام     </td>
                                    <td>{{$order->date }}  </td>
                                </tr>
                            </tbody>
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
