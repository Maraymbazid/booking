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
<div class="card" style="width: 18rem;">
  <img class="card-img-top">
  <div class="card-body">
    <h5 class="card-title">تفاصيل حجز</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"  id="name" value="{{$cartcar->car_name}}">اسم سيارة: {{  $cartcar->car_name }} </li>
    <li class="list-group-item"  id="model" value="{{$cartcar->modal}}"> نوعها: {{  $cartcar->modal }}</li>
    <li class="list-group-item"  id="price" value="{{$cartcar->price}}">سعرها :{{ $cartcar->price}}</li>
    <li class="list-group-item"  id="nationality" value="{{$cartcar->nationality}}"> جنسية الزبون : {{  $cartcar->nationality}}</li>
    <li class="list-group-item"  id="deliveryplace"value="{{$cartcar->deliveryplace}}"> مكان التسليم : {{ $cartcar->deliveryplace}}</li>
    <li class="list-group-item"  id="receivingplace"value="{{$cartcar->receivingplace}}"> مكان الاستلام :{{ $cartcar->receivingplace}}</li>
    <li class="list-group-item"  id="date" value="{{$cartcar->date}}"> تاريخ الاستلام : {{  $cartcar->date}}</li>
    <li class="list-group-item"  id="numberdays" value="{{$cartcar->numberdays}}">  عدد الايام : {{  $cartcar->numberdays}}</li>
    <li class="list-group-item"  id="number" value="{{$cartcar->number}}">   رقم التليفون : {{  $cartcar->number}}</li>
  </ul>
  <div class="card-body">
  <button class="btn btn-warning"> <a  href="" class="confirm-order"   car_id="{{$cartcar->car_id}}">تأكيد الحجز </a> </button>
  <button class="btn btn-danger"> <a  class="card-link">إلغاء الحجز </a> </button>
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
        $(document).on('click', '.confirm-order', function (e) {
            e.preventDefault();
             var car_id = $(this).attr('car_id');
             var nationality=document.getElementById("nationality").getAttribute('value');
             var deliveryplace=document.getElementById("deliveryplace").getAttribute('value');
             var receivingplace=document.getElementById("receivingplace").getAttribute('value');
             var date=document.getElementById("date").getAttribute('value');
             var numberdays=document.getElementById("numberdays").getAttribute('value');
             var number=document.getElementById("number").getAttribute('value'); 
            $.ajax({
                type: 'post',
                url: "{{route('confirmordercar')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :car_id,
                    'nationality':nationality,
                    'deliveryplace':deliveryplace,
                    'receivingplace':receivingplace,
                    'date':date,
                    'numberdays':numberdays,
                    'number':number,
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
                    window.location.href='{{ route('userIndexCar')}}';
                }}
                , error: function (reject) {
                    console.log('no'); 
                }
            });
           // console.log(apartement_id);
        });
    </script>
    @endsection