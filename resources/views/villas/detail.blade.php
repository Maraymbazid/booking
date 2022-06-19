
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
                        padding: 25px;"> تأكيد حجز فيلا
            </h2>
    <div class="container">
        <div class="row">

            <table class="table" style=" text-align:center;font-weight: bolder;">
             <form method="POST" id="confirmordervilla">
                @csrf
                <tbody>
                    <tr>
                        <td>   اسم فلة   </td>
                        <td>  {{$cartvilla->villa_name}}  </td>
                    </tr>
                    <tr >
                        <td> السعر فى اليوم      </td>
                        <td> {{$cartvilla->main_price}} </td>
                    </tr>
                    @if($cartvilla->discount < 0 )
                    <tr >
                        <td>  الاجمالي قبل الخصم         </td>
                        <td> {{$cartvilla->pricebefore}} </td>
                    </tr>
                    <tr >
                        <td>    الخصم         </td>
                        <td> {{$cartvilla->discount}} </td>
                    </tr>
                    @endif
                    <tr >
                        <td>  التكلفه الاجمالية       </td>
                        <td> {{$cartvilla->finallPrice}} </td>
                    </tr>
                    <tr >
                        <td>  اسم الشخص المعني بالحجز   </td>
                        <td>{{$cartvilla->customrname}} <input type="hidden" name="customrname" value="{{$cartvilla->customrname}}" /> </td>
                    </tr>
                    <tr>
                        <td> رقم الواتساب </td>
                        <td> {{$cartvilla->number}} <input type="hidden" name="number" value="{{$cartvilla->number}}" /> </td>
                    </tr>

                    <tr >
                        <td>    تاريخ القدوم     </td>
                        <td> {{$cartvilla->begindate}} <input type="hidden" name="begindate" value="{{$cartvilla->begindate}}" /> </td>
                    </tr>
                    <tr >
                        <td>     تاريخ الخروج     </td>
                        <td>{{$cartvilla->enddate}} <input type="hidden" name="enddate" value="{{$cartvilla->enddate}}" /> </td>
                    </tr>
                    <tr >
                        <td>    المده      </td>
                        <td>{{$cartvilla->numberdays}} <input type="hidden" name="numberdays" value="{{$cartvilla->numberdays}}" /> </td>
                    </tr>

                    <tr >
                        <td>   عدد الأشخاص   </td>
                        <td> {{$cartvilla->personnes}} <input type="hidden" name="personnes" value="{{$cartvilla->personnes}}" /> </td>
                    </tr>
                    <input type="hidden" name="id" value="{{$cartvilla->villa_id}}" />
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
        $('#confirmordervilla').submit(function(e) {
             e.preventDefault();
             let formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: "{{route('confirmordervilla')}}",
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
                        window.location.href='{{ route('userIndexVilla')}}';
                }}
                , error: function (reject) {
                    console.log('no');
                }
            });
        });
    </script>
    @endsection
