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
                        padding: 25px;"> تأكيد حجز قاعة اجتماعات
            </h2>
            @if($cart->numberDays !== null)
            <h6 style="text-align:center;
            text-align: center;
            background-color: #dae8ed;
            padding: 25px;">      السعر الاجمالي يحسب على عدد يوم واحد فقط وسيتم التواصل علي رقم  <span style="color:red;"> {{$cart->number }} </span> لتحديد  باقي الايام 
            </h6>
            @endif
    <div class="container">
        <div class="row">
            <table class="table" style=" text-align:center;font-weight: bolder;">
                <form method="POST" onsubmit="myFunction()"
                    action="{{ route('meetsaveOrder') }}">
                    @csrf
                    @method('POST')
                        <tbody style="text-align:center;font-white" >
                            <tr>
                                <td> اسم القاعه </td>
                                <td>  {{ $cart->meetingName}} <input type="hidden" name="id"  value="{{ $cart->room_id}}"/>  </td>
                            </tr>
                            <tr>
                                <td> اسم الشخص المعني بالحجز </td>
                                <td> {{ $cart->customerName}} <input type="hidden" name="customername"  value="{{ $cart->customerName}}"/> </td>
                            </tr>
                            <tr>
                                <td>   عدد الاشخاص    </td>
                                <td> {{ $cart->persones}} <input type="hidden" name="persones"  value="{{ $cart->persones}}"/> </td>
                            </tr>

                            <tr>
                                <td> رقم الواتساب </td>
                                <td> {{$cart->number }} <input type="hidden" name="number" value="{{$cart->number }} " /> </td>
                            </tr>
                            <tr>
                                <td>  تاريخ الحجز     </td>
                                <td>{{$cart->date }} <input type="hidden" name="date" value="{{$cart->date }} " /> </td>
                            </tr>
                            <tr>
                                <td>  بداية الوقت      </td>
                                <td>{{$cart->start_time }} <input type="hidden" name="start_time" value="{{$cart->start_time }} " /> </td>
                            </tr>
                            <tr>
                                <td>  عدد الساعات       </td>
                                <td>{{$cart->hours }} <input type="hidden" name="hours" value="{{$cart->hours }} " /> </td>
                            </tr>
                            <tr>
                                <td>  نهاية الوقت   </td>
                                <td>{{$cart->end_time }} <input type="hidden" name="end_time" value="{{$cart->end_time }} " /> </td>
                            </tr>
                            @if($cart->numberDays !== null)
                            <tr>
                                <td>   عدد الايام   </td>
                                <td>{{$cart->numberDays }} <input type="hidden" name="numberdays" value="{{$cart->numberDays }} " /> </td>
                            </tr>
                            @endif
                            <tr>
                                <td>  السعر للساعه   </td>
                                <td> {{$cart->mainPrice }} </td>
                            </tr>
                            @if($cart->discount > 0 )
                            <tr>
                                <td> السعر قبل الخصم       </td>
                                <td> {{$cart->beforeDis}} $</td>
                            </tr>
                            <td>  الخصم   </td>
                            <td> {{$cart->discount}} $</td>
                            @endif
                            <tr>
                                <td> التكلفة الاجمالية    </td>
                                <td> {{ $cart->price}} </td>
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
