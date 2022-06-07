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
    <li class="list-group-item" id="name" value="{{$carttaxi->taxi_name}}">اسم سيارة: {{$carttaxi->taxi_name}} </li>
    <li class="list-group-item" id="model" value="{{$carttaxi->model}}"> نوعها: {{$carttaxi->model}}</li>
    <li class="list-group-item" id="price" value="{{$carttaxi->price}}">سعرها :{{$carttaxi->price}}</li>
    <li class="list-group-item" id="phone" value="{{$carttaxi->price}}">رقم التليفون :{{$carttaxi->phone}}</li>
    <li class="list-group-item" id="nationality" value="{{$carttaxi->nationality}}"> جنسية الزبون : {{$carttaxi->nationality}}</li>
    <li class="list-group-item" id="destination" value="{{$carttaxi->destination}}"> الوجهة : {{$carttaxi->destination}}</li>
    <li class="list-group-item" id="datearrive"  value="{{$carttaxi->datearrive}}"> تاريخ الوصول : {{$carttaxi->datearrive}}</li>
    <li class="list-group-item" id="deliveryplace" value="{{$carttaxi->deliveryplace}}"> مكان التوصيل :{{$carttaxi->deliveryplace}}</li>
    @if($carttaxi->chauffeur == 0)
    <li class="list-group-item" id="chauffeur" value="0">   سيارة بدون سائق  </li>
    @else
    <li class="list-group-item"  id="chauffeur" value="1">  سيارة مع سائق  </li>
    @endif
  </ul>
  </ul>
  <div class="card-body">
  <button class="btn btn-warning"> <a  href="" class="confirm-order"   taxi_id="{{$carttaxi->taxi_id}}">تأكيد الحجز </a> </button>
    <a  class="card-link">إلغاء الحجز </a>
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
    </script>
    @endsection