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
    <h3 class="mayati-title">
           حجز الشقق
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
                    <th>   رقم الطلب   </th>
                    <th>   رقم الواتساب   </th>
                    <th>   عدد الايام    </th>
                    <th>    تاريخ الطلب    </th>
                    <th>     حالة الطلب     </th>
                    <th>     تفاصيل </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($apparts as $appart)
                    <tr>
                        <td> {{ $appart->customrname }}</td>
                        <td> {{ $appart->Num }}    </td>
                        <td> {{$appart->phone }} </td>
                        <td> {{ $appart->numerdays }}</td>
                        <td> {{ $appart->created_at }}</td>
                        {{-- <td> {{ $taxi->taxi->model }}</td> --}}
                        <td> @if($appart->status == '0' )
                            جارى المراجعة
                            @elseif ($appart->status == 1)
                            تم  قبول الطلب
                            @elseif ($appart->status == 2)
                                تم إالغاء الطلب
                            @else
                            هناك خطأ ما ونحاول التواصل معك
                            @endif
                            </td>
                        <td>   <button class="btn btn-primary">
                            <a href="{{ route('singleApartOrder', $appart->id) }}" >
                                <span style="color: #fff;">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </a>
                        </button></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
                    @if ($apparts->hasPages())

                    <nav>
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($apparts->onFirstPage())
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                            @else
                                <li class="page-item ">
                                    <a class="page-link" href=" {{ $apparts->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>
                            @endif


                            {{-- Next Page Link --}}
                            @if ($apparts->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $apparts->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true"
                                    aria-label="@lang('pagination.next')">
                                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                    @endif
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


    {{-- @if ($order->status == 0)
    <span style="color: orange;"><i class="fas fa-clock"></i></span>
@elseif ($order->status == 1)
    <span style="color: green;"><i class="fas fa-check-circle "></i></span>
@elseif ($order->status == 2)
    <span style="color: red;"><i class="far fa-times-circle"></i></span>
@endif --}}
