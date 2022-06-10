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
    <li class="list-group-item"  id="name" value="{{$cartapart->apart_name}}"> اسم الشقة: {{ $cartapart->apart_name }} </li>
    <li class="list-group-item"  id="price" value="{{$cartapart->price}}">سعرها :{{ $cartapart->price}}</li>
    <li class="list-group-item"  id="nationality" value="{{$cartapart->nationality}}"> جنسية الزبون : {{  $cartapart->nationality}}</li>
    <li class="list-group-item"  id="begindate"value="{{$cartapart->begindate}}">  تاريخ القدوم : {{$cartapart->begindate}}</li>
    <li class="list-group-item"  id="enddate"value="{{$cartapart->enddate}}">  تاريخ الخروج :{{ $cartapart->enddate }}</li>
    <li class="list-group-item"  id="numberdays" value="{{$cartapart->numberdays}}">  عدد الايام : {{$cartapart->numberdays}}</li>
    <li class="list-group-item"  id="persones" value="{{$cartapart->personnes}}">   عدد الاشخاص : {{$cartapart->personnes}}</li>
    <li class="list-group-item"  id="number" value="{{$cartapart->number}}">   رقم التليفون : {{$cartapart->number}}</li>
  </ul>
  <div class="card-body">
  <button class="btn btn-warning"> <a  href="" class="confirm-order"   car_id="{{ $cartapart->apart_id}}">تأكيد الحجز </a> </button>
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
             var begindate=document.getElementById("begindate").getAttribute('value');
             var enddate=document.getElementById("enddate").getAttribute('value');
             var personnes=document.getElementById("persones").getAttribute('value');
             var numberdays=document.getElementById("numberdays").getAttribute('value');
             var number=document.getElementById("number").getAttribute('value'); 
            $.ajax({
                type: 'post',
                url: "{{route('confirmorderapart')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :car_id,
                    'nationality':nationality,
                    'begindate':begindate,
                    'enddate':enddate,
                    'personnes':personnes,
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
                    window.location.href='{{ route('userIndexApartement')}}';
                }}
                , error: function (reject) {
                    console.log('no'); 
                }
            });
           // console.log(apartement_id);
        });
    </script>
    @endsection