@extends('layout.lay')
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
                action="{{ route('confirmorder' ,  $carttaxi->taxi_id ) }}">
                @csrf
                @method('POST')
                <tbody>
                    <tr class='text-center border border-light'>
                        <td>  اسم السياره  </td>
                        <td>  {{$carttaxi->taxi_name}}  </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td> نوع السياره   </td>
                        <td> {{$carttaxi->model}} </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td> السعر فى اليوم      </td>
                        <td> {{$carttaxi->price}} </td>
                    </tr>
                    {{-- <tr class='text-center border border-light'>
                        <td> تكلفة الاقامة لليوم  </td>
                        <td> {{$order->oneday }} </td>
                    </tr> --}}

                    {{-- <tr class='text-center border border-light'>
                        <td> الخصم </td>
                        <td>{{$order->discount}} </td>
                    </tr> --}}

                    {{-- <tr class='text-center border border-light'>
                        <td> التكلفة الاجمالية  </td>
                        <td> {{ $order->price}} </td>
                    </tr> --}}

                    <tr class='text-center border border-light'>
                        <td> رقم الواتساب </td>
                        <td> {{$carttaxi->phone}} <input type="hidden" name="phone" value="{{$carttaxi->phone}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>  الجنسية   </td>
                        <td>{{$carttaxi->nationality}} <input type="hidden" name="nationality" value="{{$carttaxi->nationality}}" /> </td>
                    </tr>
                    <tr class='text-center border border-light'>
                        <td>  الوجهه     </td>
                        <td> {{$carttaxi->destination}} <input type="hidden" name="destination" value="{{$carttaxi->destination}}" /> </td>
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
{{-- <script>
        $(document).on('click', '.confirm-order', function (e) {
             e.preventDefault();
             var taxi_id = $(this).attr('taxi_id');
             var nationality=document.getElementById("nationality").getAttribute('value');
             var deliveryplace=document.getElementById("deliveryplace").getAttribute('value');
             var destination=document.getElementById("destination").getAttribute('value');
             var datearrive=document.getElementById("datearrive").getAttribute('value');
             var phone=document.getElementById("phone").getAttribute('value');
             var chauffeur=document.getElementById("chauffeur").getAttribute('value');
             var ticket ="{{$carttaxi->ticket}}";
            $.ajax({
                type: 'post',
                url: "{{route('confirmorder')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :taxi_id,
                    'nationality':nationality,
                    'deliveryplace':deliveryplace,
                    'destination':destination,
                    'datearrive':datearrive,
                    'phone':phone,
                    'chauffeur':chauffeur,
                    'ticket':ticket,

                },
                success: (response) => {
                    if (response) {
                    Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                }}
                , error: function (reject) {
                    console.log('no');
                }
            });
        });
    </script> --}}
    @endsection
