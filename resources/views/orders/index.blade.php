@extends('layout.flay')
@section('css')
 <meta http-equiv="refresh" content="30" />
<style>
    .table-responsive-stack tr {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
}


.table-responsive-stack td,
.table-responsive-stack th {
   display:block;
/*
   flex-grow | flex-shrink | flex-basis   */
   -ms-flex: 1 1 auto;
    flex: 1 1 auto;
}

.table-responsive-stack .table-responsive-stack-thead {
   font-weight: bold;
}

@media screen and (max-width: 768px) {
   .table-responsive-stack tr {
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
          -ms-flex-direction: column;
              flex-direction: column;
      border-bottom: 3px solid #ccc;
      display:block;

   }
   /*  IE9 FIX   */
   .table-responsive-stack td {
      float: left\9;
      width:100%;
   }
}


</style>
@endsection

@include('layout.nav')

@section('content')



    <div class="container">
        <div class="row">
            @if (session()->has('ordersucess'))
            <div class="alert alert-success mt-5 " role="alert">
                {{ session()->get('ordersucess') }}
            </div>
            @endif
        </div>
    <h3 class="mayati-title">
            حجز الفنادق
        </h3>

            <div class="cards ">
                <div class="card-header" style="text-align: center;">
                    <i class="fa fa-table"></i> المعلومات
                </div>
                <div class="card-body">

            <table class="table table-bordered table-striped table-responsive-stack" id="tableOne" style="text-align:center">
            <thead class="thead-dark">
                <tr>
                    <th>  الاسم   </th>
                    <th>   الرقم المرجعي    </th>
                    <th>   رقم الواتساب   </th>
                    <th>   عدد الايام    </th>
                    <th>     حالة الطلب     </th>
                    <th>     تاريخ الطلب      </th>
                    <th>     تفاصيل </th>
                </tr>
            </thead>
            <tbody>

         @foreach ($orders as $order)
            <tr>
                <td> {{ $order->user_name }}</td>
                <td> {{ $order->order_number }}</td>
                <td> {{ $order->whatsapp }}</td>
                <td> {{ $order->daycount }}</td>
                <td> @if($order->status == '0' )
                    جارى المراجعة
                    @elseif ($order->status == 1)
                    تم  قبول الطلب
                    @elseif ($order->status == 2)
                        تم إالغاء الطلب
                    @else
                    هناك خطأ ما ونحاول التواصل معك
                    @endif
                    </td>
                <td> {{ $order->created_at }}</td>

                <td>   <button class="btn btn-primary">
                    <a href="{{ route('singlehotelOrder', $order->id) }}" >
                        <span style="color: #fff;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        </span>

                    </a>
                </button></td>
            </tr>
        @endforeach
        </tbody>
   </table>
                </div>
            </div>

    </div>



    @endsection

    @section('js')


<script type="text/javascript">


$(document).ready(function() {


// inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
$('.table-responsive-stack').each(function (i) {
   var id = $(this).attr('id');
   //alert(id);
   $(this).find("th").each(function(i) {
      $('#'+id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+             $(this).text() + ':</span> ');
      $('.table-responsive-stack-thead').hide();

   });



});





$( '.table-responsive-stack' ).each(function() {
var thCount = $(this).find("th").length;
var rowGrow = 100 / thCount + '%';
//console.log(rowGrow);
$(this).find("th, td").css('flex-basis', rowGrow);
});




function flexTable(){
if ($(window).width() < 768) {

$(".table-responsive-stack").each(function (i) {
   $(this).find(".table-responsive-stack-thead").show();
   $(this).find('thead').hide();
});


// window is less than 768px
} else {


$(".table-responsive-stack").each(function (i) {
   $(this).find(".table-responsive-stack-thead").hide();
   $(this).find('thead').show();
});



}
// flextable
}

flexTable();

window.onresize = function(event) {
 flexTable();
};






// document ready
});




</script>


@endsection
