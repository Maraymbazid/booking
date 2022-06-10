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
    <li class="list-group-item"  id="name" value="{{$cartvilla->villa_name}}"> اسم الشقة: {{ $cartvilla->villa_name }} </li>
    <li class="list-group-item"  id="price" value="{{$cartvilla->price}}">سعرها :{{ $cartvilla->price}}</li>
    <li class="list-group-item"  id="nationality" value="{{$cartvilla->nationality}}"> جنسية الزبون : {{  $cartvilla->nationality}}</li>
    <li class="list-group-item"  id="begindate"value="{{$cartvilla->begindate}}">  تاريخ القدوم : {{$cartvilla->begindate}}</li>
    <li class="list-group-item"  id="enddate"value="{{$cartvilla->enddate}}">  تاريخ الخروج :{{ $cartvilla->enddate }}</li>
    <li class="list-group-item"  id="numberdays" value="{{$cartvilla->numberdays}}">  عدد الايام : {{$cartvilla->numberdays}}</li>
    <li class="list-group-item"  id="persones" value="{{$cartvilla->personnes}}">   عدد الاشخاص : {{$cartvilla->personnes}}</li>
    <li class="list-group-item"  id="number" value="{{$cartvilla->number}}">   رقم التليفون : {{$cartvilla->number}}</li>
  </ul>
  <div class="card-body">
  <button class="btn btn-warning"> <a  href="" class="confirm-order"   villa_id="{{ $cartvilla->villa_id}}">تأكيد الحجز </a> </button>
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
             var villa_id = $(this).attr('villa_id');
             var nationality=document.getElementById("nationality").getAttribute('value');
             var begindate=document.getElementById("begindate").getAttribute('value');
             var enddate=document.getElementById("enddate").getAttribute('value');
             var personnes=document.getElementById("persones").getAttribute('value');
             var numberdays=document.getElementById("numberdays").getAttribute('value');
             var number=document.getElementById("number").getAttribute('value'); 
            $.ajax({
                type: 'post',
                url: "{{route('confirmordervilla')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id' :villa_id,
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
                    window.location.href='{{ route('userIndexVilla')}}';
                }}
                , error: function (reject) {
                    console.log('no'); 
                }
            });
           // console.log(apartement_id);
        });
    </script>
    @endsection